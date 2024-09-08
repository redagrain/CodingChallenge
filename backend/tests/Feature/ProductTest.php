<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    public function test_create_product(): void
    {
        $data = [
            'name' => 'Rich Dad Poor Dad',
            'description' => 'Rich Dad Poor Dad is a 1997 book written by Robert T. Kiyosaki and Sharon Lechter.',
            'price' => 100.50,
            'image' => UploadedFile::fake()->image('product.jpg'),
            'category_id' => 1
        ];

        $this->postJson('/api/store', $data);
        $this->assertDatabaseHas('products', ["name" => 'Rich Dad Poor Dad']);
    }
}
