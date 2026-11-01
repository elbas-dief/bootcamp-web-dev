<?php

namespace Tests\Feature;

use App\Models\categories;
use App\Models\Category;
use App\Models\products;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductApiTest extends TestCase
{
    use RefreshDatabase;    

    public function test_get_products_berhasil_dengan_token(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'sanctum')->getJson('api/products');

        $response->assertStatus(200)->assertJsonStructure(['data']);
    }
    
    public function test_get_products_tanpa_token_ditolak(): void
    {
        $response = $this->getJson('/api/products');

        $response->assertStatus(401)->assertJson([
            'message' => 'Token tidak ditemukan atau tidak valid. Silahkan login terlebih dahulu.'
        ]);
    }

    public function test_get_products_mengembalikan_daftar_produk_beserta_kategori(): void
    {
        $user = User::factory()->create(); //Ada di Model user, di use HasFactory
        $category = categories::factory()->create();
        products::factory()->count(3)->create([
            'category_id' => $category->id
        ]);

        $response = $this->actingAs($user, 'sanctum')
            ->getJson('/api/products');
        
        $response->assertStatus(200)
            ->assertJsonCount(3, 'data')
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'name', 'price', 'stock', 'category'],
                ],
            ]);
    }

    public function test_user_biasa_tidak_bisa_membuat_produk():void
    {
        $user = User::factory()->create(['role' => 'user']);
        $category = categories::factory('CategoryFactory')->create();

        $response = $this->actingAs($user, 'sanctum')
            ->postJson('/api/products', [
                'category_id' => $category->id,
                'name' => 'Laptop',
                'price' => 6000000,
                'stock' => 10,
            ]);
        
        $response->assertStatus(403)
            ->assertJson(['message' => 'Akses ditolak.']);
    }

    public function test_admin_bisa_membuat_produk(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $category = categories::factory()->create();

        $response = $this->actingAs($admin, 'sanctum')
            ->postJson('/api/products', [
                'category_id' => $category->id,
                'name' => 'Laptop',
                'price' => 3000000,
                'stock' => 10,
            ]);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'message',
                'data' => ['id', 'name', 'price', 'stock', 'category'],
            ]);
    }
}
