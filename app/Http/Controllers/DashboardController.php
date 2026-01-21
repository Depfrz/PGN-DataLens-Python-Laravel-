<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Built-in features to exclude from the main dashboard grid as they are in the sidebar
        $excludedModules = ['Dashboard', 'Integrasi Sistem', 'Management User', 'Data History', 'History'];

        $search = trim((string) $request->query('search', ''));

        if ($user->hasRole(['Supervisor', 'Admin'])) {
            $query = Module::where('status', true)->whereNotIn('name', $excludedModules);

            if ($search !== '') {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('description', 'like', '%' . $search . '%');
                });
            }

            $modules = $query->get();
            return view('dashboard', compact('modules'));
        }
        
        // Get module IDs from module_access where can_read is true
        $assignedModuleIds = \App\Models\ModuleAccess::where('user_id', $user->id)
            ->where('can_read', true)
            ->pluck('module_id');

        // Check if user has specific access rights configured
        if ($assignedModuleIds->isNotEmpty()) {
            $query = Module::whereIn('id', $assignedModuleIds)
                ->where('status', true)
                ->whereNotIn('name', $excludedModules);

            if ($search !== '') {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('description', 'like', '%' . $search . '%');
                });
            }

            $modules = $query->get();
        } 
        // Fallback for standard users with no configured access (show none)
        else {
            $modules = collect();
        }

        return view('dashboard', compact('modules'));
    }
}
