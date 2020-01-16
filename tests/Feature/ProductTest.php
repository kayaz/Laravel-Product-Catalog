<?php

namespace Tests\Feature;

use App\Product;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

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

    // Dodamy produkt i sprawdzimy czy pojawi sie w katalogu
    public function testAddProduct()
    {
        // Dodajemy produkt
        $product = Product::create([
            'name' => 'Wypasiony produkt',
            'slug' => 'wypasiony-produkt',
            'price' => '190',
            'photo' => '',
            'description' => 'To jest opis produktu'
        ]);

        // Sprawdzamy czy poprawnie dodał sie
        $response = $this->get('/' . $product->slug);

        // Sprawdźmy że w odpowiedzi znajduje się nazwa produktu
        $response->assertStatus(200)->assertSeeText('Wypasiony produkt');
    }
}
