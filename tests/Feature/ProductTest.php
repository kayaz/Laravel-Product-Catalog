<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Http\Response;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
    }

    // Sprawdzamy czy jest strona z katalogiem produktow
    public function testCatalog()
    {
        $response = $this->get(route('product.index'));

        $response->assertStatus(200);
        $response->assertViewIs('index.index');
    }

    // Sprawdzamy czy działa strona 404 jesli produktu nie ma w katalogu
    public function testProduct()
    {
        $response = $this->get(route('product.show', ['slug' => 'na-pewno-nie-ma-takiego-produktu']));
        $response->assertStatus(404);
    }

    // Sprawdzamy czy mozna dodac produkt bez nazwy
    public function testNoName()
    {
        $response = $this->actingAs($this->user)
            ->postJson(route('product.store'), [
                'price' => $this->faker->numberBetween(1, 50),
                'description' => $this->faker->text($maxNbChars = 200)
            ]);

        $response->assertStatus(
            Response::HTTP_UNPROCESSABLE_ENTITY
        );

        $response->assertJsonValidationErrors('name');
    }

    // Sprawdzamy czy mozna dodac produkt bez ceny
    public function testNoPrice()
    {
        $response = $this->actingAs($this->user)
            ->postJson(route('product.store'), [
                'name' => $this->faker->name,
                'description' => $this->faker->text($maxNbChars = 200)
            ]);

        $response->assertStatus(
            Response::HTTP_UNPROCESSABLE_ENTITY
        );

        $response->assertJsonValidationErrors('price');
    }

    // Sprawdzamy czy mozna dodac produkt bez opisu
    public function testNoDescription()
    {
        $response = $this->actingAs($this->user)
            ->postJson(route('product.store'), [
                'name' => $this->faker->name,
                'price' => $this->faker->numberBetween(1, 50)
            ]);

        $response->assertStatus(
            Response::HTTP_UNPROCESSABLE_ENTITY
        );

        $response->assertJsonValidationErrors('description');
    }
}
