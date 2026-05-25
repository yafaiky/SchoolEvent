<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // =====================================================
        // AKUN ADMIN
        // URL Login  : /login
        // Email      : admin@schoolevent.id
        // Password   : admin123
        // =====================================================
        User::create([
            'name'     => 'Administrator',
            'email'    => 'admin@schoolevent.id',
            'password' => Hash::make('admin123'),
            'role'     => 'admin',
            'email_verified_at' => now(),
        ]);

        // =====================================================
        // AKUN USER BIASA
        // URL Login  : /login
        // Email      : user@schoolevent.id
        // Password   : user123
        // =====================================================
        User::create([
            'name'     => 'Budi Santoso',
            'email'    => 'user@schoolevent.id',
            'password' => Hash::make('user123'),
            'role'     => 'user',
            'email_verified_at' => now(),
        ]);

        $this->command->info('✅ Seeder selesai! 2 akun berhasil dibuat:');
        $this->command->table(
            ['Role', 'Nama', 'Email', 'Password'],
            [
                ['Admin', 'Administrator', 'admin@schoolevent.id', 'admin123'],
                ['User',  'Budi Santoso',  'user@schoolevent.id',  'user123'],
            ]
        );
    }
}
