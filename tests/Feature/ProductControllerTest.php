<?php

use App\Models\Product;
use Illuminate\Http\Response;

it('can add a product', function () {
    $product = Product::factory()->makeOne();

    login()->post('/api/product', [
        'name' => $product->name,
        'price' => $product->price,
        'slug' => $product->slug,
    ])->assertStatus(Response::HTTP_CREATED);
});

it('can list all products', function() {
   $products = Product::factory()->count(5)->create();

   $this->get('/api/product')->assertStatus(Response::HTTP_OK)
       ->assertJson([
           'message' => 'success',
           'products' => $products->toArray()
       ]);
});

