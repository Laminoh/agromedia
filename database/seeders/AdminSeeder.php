<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name' => 'Administrateur',
            'email' => 'admin@agromedia.sn',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
            'phone' => '+221 77 000 00 00',
            'location' => 'Dakar',
            'description' => 'Administrateur de la plateforme AGROMEDIA',
            'whatsapp_number' => '+221 77 000 00 00',
        ]);
    }
}
