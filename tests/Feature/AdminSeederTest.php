<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\AdminSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use RuntimeException;
use Tests\TestCase;

class AdminSeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_is_created_with_configured_credentials(): void
    {
        config([
            'admin.email' => 'admin@example.com',
            'admin.password' => 'a-unique-password-123',
        ]);

        $this->seed(AdminSeeder::class);

        $admin = User::where('email', 'admin@example.com')->firstOrFail();

        $this->assertSame('admin', $admin->role);
        $this->assertTrue(Hash::check('a-unique-password-123', $admin->password));
    }

    public function test_admin_seeder_rejects_missing_credentials(): void
    {
        config([
            'admin.email' => null,
            'admin.password' => null,
        ]);

        $this->expectException(RuntimeException::class);

        $this->seed(AdminSeeder::class);
    }
}
