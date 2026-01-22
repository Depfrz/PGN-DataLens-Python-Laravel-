<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Module;
use App\Models\User;
use App\Models\ModuleAccess;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Fix 'Buku Saku' Module (The one that appears on the Dashboard)
        // We ensure a module named "Buku Saku" exists and links to the dashboard.
        $bukuSaku = Module::updateOrCreate(
            ['name' => 'Buku Saku'],
            [
                'slug' => 'buku-saku', 
                'url' => '/buku-saku', 
                'icon' => 'book',      
                'group' => 'Buku Saku',
                'status' => true,
                'description' => 'Akses fitur Buku Saku, Dokumen, dan lainnya.'
            ]
        );

        // 2. Fix 'Beranda' (Sub-module of Buku Saku)
        Module::updateOrCreate(
            ['name' => 'Beranda'],
            [
                'slug' => 'buku-saku-beranda',
                'url' => '/buku-saku',
                'icon' => 'home',
                'group' => 'Buku Saku',
                'status' => true,
            ]
        );

        // 3. Fix other Buku Saku Sub-modules
        $subModules = [
            ['name' => 'Dokumen Favorit', 'url' => '/buku-saku/favorites', 'icon' => 'star'],
            ['name' => 'Riwayat Dokumen', 'url' => '/buku-saku/history', 'icon' => 'clock'],
            ['name' => 'Pengecekan File', 'url' => '/buku-saku/approval', 'icon' => 'check-circle'],
            ['name' => 'Upload Dokumen', 'url' => '/buku-saku/upload', 'icon' => 'upload'],
        ];

        foreach ($subModules as $sub) {
            Module::updateOrCreate(
                ['name' => $sub['name']],
                [
                    'slug' => \Illuminate\Support\Str::slug($sub['name']),
                    'url' => $sub['url'],
                    'icon' => $sub['icon'],
                    'group' => 'Buku Saku',
                    'status' => true,
                ]
            );
        }

        // 4. Fix 'List Pengawasan'
        Module::updateOrCreate(
            ['name' => 'List Pengawasan'],
            [
                'slug' => 'list-pengawasan',
                'url' => '/list-pengawasan',
                'icon' => 'clipboard-list',
                'group' => 'List Pengawasan',
                'status' => true,
                'description' => 'Sistem List Pengawasan'
            ]
        );

        // 5. Ensure all existing users with 'Admin' role have access to these modules
        // This prevents the "blank dashboard" issue for admins.
        $admins = User::role('Admin')->get();
        // Also include the specific admin email if not caught by role
        $specificAdmin = User::where('email', 'admin@pgn.co.id')->first();
        if ($specificAdmin && !$admins->contains($specificAdmin->id)) {
            $admins->push($specificAdmin);
        }

        $modulesToAssign = ['Buku Saku', 'List Pengawasan', 'Beranda', 'Dokumen Favorit', 'Riwayat Dokumen', 'Pengecekan File', 'Upload Dokumen'];
        
        foreach ($admins as $admin) {
            foreach ($modulesToAssign as $mName) {
                $mod = Module::where('name', $mName)->first();
                if ($mod) {
                    ModuleAccess::firstOrCreate(
                        ['user_id' => $admin->id, 'module_id' => $mod->id],
                        [
                            'can_read' => true, 
                            'can_write' => true, 
                            'can_delete' => true,
                            'show_on_dashboard' => in_array($mName, ['Buku Saku', 'List Pengawasan'])
                        ]
                    );
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No reverse action needed usually for data fixes, 
        // or we could delete the modules but that might be destructive.
    }
};
