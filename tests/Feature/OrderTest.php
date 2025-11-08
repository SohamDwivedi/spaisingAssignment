<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CartItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $token;

    protected function setUp(): void
    {
        parent::setUp();

        // Seed default data
        $this->artisan('db:seed');

        // Create a sample user
        $this->user = User::factory()->create([
            'email' => 'orderuser@example.com',
            'password' => bcrypt('password123'),
        ]);

        // Simulate login to get token
        $response = $this->postJson('/api/auth/login', [
            'email' => 'orderuser@example.com',
            'password' => 'password123',
        ]);

        $this->token = $response->json('token');
    }

    #[Test]
    public function user_can_checkout_successfully()
    {
        $product = Product::factory()->create([
            'stock' => 5,
            'price' => 100,
        ]);

        // Add product to cart
        CartItem::create([
            'user_id' => $this->user->id,
            'product_id' => $product->id,
            'quantity' => 2,
        ]);

        $response = $this->withHeader('Authorization', "Bearer {$this->token}")
                         ->postJson('/api/checkout');

        $response->assertStatus(200)
                 ->assertJsonStructure(['message', 'order']);

        $this->assertDatabaseHas('orders', ['user_id' => $this->user->id]);
        $this->assertDatabaseHas('order_items', ['product_id' => $product->id]);

        $product->refresh();
        $this->assertEquals(3, $product->stock); // Stock reduced correctly
    }

    #[Test]
    public function checkout_fails_when_stock_is_insufficient()
    {
        $product = Product::factory()->create([
            'stock' => 1,
            'price' => 50,
        ]);

        CartItem::create([
            'user_id' => $this->user->id,
            'product_id' => $product->id,
            'quantity' => 3,
        ]);

        $response = $this->withHeader('Authorization', "Bearer {$this->token}")
                         ->postJson('/api/checkout');

        $response->assertStatus(400)
                 ->assertJson([
                     'error' => "Insufficient stock for {$product->name}",
                 ]);
    }
}
