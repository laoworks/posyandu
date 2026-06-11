<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $this->renameRole('admin', 'kader');
        $this->renameRole('bidan', 'bidan_desa');
        Role::firstOrCreate(['name' => 'orang_tua']);
    }

    private function renameRole(string $oldName, string $newName): void
    {
        $newRole = Role::where('name', $newName)->first();
        $oldRole = Role::where('name', $oldName)->first();

        if ($oldRole && ! $newRole) {
            $oldRole->update(['name' => $newName]);

            return;
        }

        if ($newRole && $oldRole && $newRole->id !== $oldRole->id) {
            foreach ($oldRole->users as $user) {
                $user->assignRole($newRole);
            }

            $oldRole->delete();

            return;
        }

        Role::firstOrCreate(['name' => $newName]);
    }
}
