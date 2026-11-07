<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProducerProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_producer_can_view_their_own_product(): void
    {
        $producer = User::factory()->create(['role' => 'producteur']);
        $product = Product::create([
            'user_id' => $producer->id,
            'title' => 'Pastèque',
        ]);

        $this->actingAs($producer)
            ->get(route('producer.products.show', $product))
            ->assertOk()
            ->assertSee('Pastèque');
    }

    public function test_producer_cannot_view_another_producers_product(): void
    {
        $producer = User::factory()->create(['role' => 'producteur']);
        $otherProducer = User::factory()->create(['role' => 'producteur']);
        $product = Product::create([
            'user_id' => $otherProducer->id,
            'title' => 'Pastèque',
        ]);

        $this->actingAs($producer)
            ->get(route('producer.products.show', $product))
            ->assertForbidden();
    }
}
