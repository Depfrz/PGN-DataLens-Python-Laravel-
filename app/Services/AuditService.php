<?php

namespace App\Services;

use App\Models\AuditLog;
use App\Models\User;
use App\Notifications\SystemNotification;
use Illuminate\Support\Facades\Notification;

class AuditService
{
    public static function log($user, $action, $module, $description)
    {
        // 1. Create Audit Log
        AuditLog::create([
            'user_id' => $user->id,
            'action' => $action,
            'module' => $module,
            'description' => $description,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        // 2. Send Notification
        // User yang melakukan aksi selalu dapat notifikasi (sebagai konfirmasi/history pribadi)
        $user->notify(new SystemNotification($action, $module, $description, $user->name));

        // Admin & Supervisor dapat notifikasi untuk aksi user LAIN
        // Ambil semua Admin & Supervisor KECUALI user yang sedang melakukan aksi
        $admins = User::role(['Admin', 'Supervisor'])
            ->where('id', '!=', $user->id)
            ->get();

        if ($admins->count() > 0) {
            Notification::send($admins, new SystemNotification($action, $module, "User {$user->name}: {$description}", $user->name));
        }
    }
}
