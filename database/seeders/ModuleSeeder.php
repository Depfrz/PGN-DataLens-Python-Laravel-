<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Module;
use App\Models\User;
use App\Models\ModuleAccess;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Create Dummy Modules
        $modules = [
            [
                'name' => 'HCM SIP-PGN',
                'slug' => 'hcm-sip-pgn',
                'description' => 'Sistem manajemen sumber daya manusia.',
                'url' => '#',
                'icon' => null,
            ],
            [
                'name' => 'Project Management Office',
                'slug' => 'pmo',
                'description' => 'Sistem pemantauan proyek.',
                'url' => '#',
                'icon' => null,
            ],
            [
                'name' => 'Procurement System',
                'slug' => 'procurement',
                'description' => 'Sistem pengadaan barang dan jasa.',
                'url' => '#',
                'icon' => null,
            ],
        ];

        foreach ($modules as $mod) {
            Module::firstOrCreate(['slug' => $mod['slug']], $mod);
        }

        // 2. Assign Access to Dummy Users (if they exist)
        
        // User (Read Only, Specific Module)
        $user = User::where('email', 'user@pgn.co.id')->first();
        $hcmModule = Module::where('slug', 'hcm-sip-pgn')->first();
        
        if ($user && $hcmModule) {
            ModuleAccess::updateOrCreate(
                ['user_id' => $user->id, 'module_id' => $hcmModule->id],
                [
                    'can_read' => true,
                    'can_write' => false,
                    'can_delete' => false,
                ]
            );
        }

        // SuperUser (Read/Write, Specific Module)
        $superUser = User::where('email', 'staff@pgn.co.id')->first();
        $pmoModule = Module::where('slug', 'pmo')->first();

        if ($superUser && $pmoModule) {
            ModuleAccess::updateOrCreate(
                ['user_id' => $superUser->id, 'module_id' => $pmoModule->id],
                [
                    'can_read' => true,
                    'can_write' => true, // Can input
                    'can_delete' => false,
                ]
            );
        }
    }
}
