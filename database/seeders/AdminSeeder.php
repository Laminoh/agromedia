<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use RuntimeException;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $email = config('admin.email');
        $password = config('admin.password');

        if (! is_string($email) || ! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new RuntimeException('Set a valid ADMIN_EMAIL before running AdminSeeder.');
        }

        if (! is_string($password) || strlen($password) < 12) {
            throw new RuntimeException('Set an ADMIN_PASSWORD of at least 12 characters before running AdminSeeder.');
        }

        User::updateOrCreate(['email' => $email], [
            'name' => config('admin.name'),
            'password' => Hash::make($password),
            'role' => 'admin',
            'phone' => '+221 77 000 00 00',
            'location' => 'Dakar',
            'description' => 'Administrateur de la plateforme AGROMEDIA',
            'whatsapp_number' => '+221 77 000 00 00',
        ]);
    }
}
