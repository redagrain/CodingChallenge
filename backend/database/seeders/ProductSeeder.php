<?php

namespace Database\Seeders;

use App\Repositories\ProductRepository;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    protected $productRepository;

    public function __construct()
    {
        $this->productRepository = new ProductRepository();
    }
    public function run(): void
    {
        $products = [
            ['name' => 'The Great Gatsby', 'price' => 19.99, 'description' => 'A classic novel by F. Scott Fitzgerald', 'category_id' => 1],
            ['name' => 'The Catcher in the Rye', 'price' => 18.25, 'description' => 'A coming-of-age novel by J.D. Salinger', 'category_id' => 1],
            ['name' => 'Men\'s T-shirt', 'price' => 12.99, 'description' => '100% cotton T-shirt, available in multiple colors', 'category_id' => 5],
            ['name' => 'Men\'s Jeans', 'price' => 39.99, 'description' => 'Slim-fit denim jeans with stretch fabric', 'category_id' => 6],
        ];

        foreach ($products as $product) {
            $this->productRepository->create($product);
        }
    }
}
