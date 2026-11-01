<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_register_berhasil_dengan_data_valid(): void
    {
        $response = $this->postJson('/api/register', [
            'name'                  => 'Budi',
            'email'                 => 'budi@example.com',
            'password'              => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertStatus(201)->assertJsonStructure([
            'message', 'token', 'user' => ['id', 'name', 'email'],
        ]);
    }

    public function test_register_gagal_jika_email_sudah_dipakai(): void
    {
        User::factory()->create(['email' => 'budi@example.com']);

        $response = $this->postJson('/api/register', [
            'name'                  => 'Budi Lain',
            'email'                 => 'budi@example.com',
            'password'              => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertStatus(422)->assertJsonValidationErrors(['email']);
    }

    public function test_register_gagal_jika_password_tidak_cocok(): void
    {
        $response = $this->postJson('/api/register', [
            'name'                  => 'Budi',
            'email'                 => 'budi@example.com',
            'password'              => 'password123',
            'password_confirmation' => 'salah456',
        ]);

        $response->assertStatus(422)->assertJsonValidationErrors(['password']);
    }

    public function test_register_gagal_jika_field_wajib_tidak_dikirim(): void
    {
        $response = $this->postJson('/api/register', []);

        $response->assertStatus(422)->assertJsonValidationErrors([
            'name',
            'email',
            'password'
            ]);
    }
}
