<?php

namespace Database\Seeders;

use App\Repositories\ProductRepository;
use App\Services\ProductyCategoryService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    protected $productRepository;
    protected $productyCategoryService;

    public function __construct(ProductRepository $productRepository, ProductyCategoryService $productyCategoryService)
    {
        $this->productyCategoryService = $productyCategoryService;

        $this->productRepository = $productRepository;
    }
    public function run(): void
    {
        $products = [
            ['name' => 'The Great Gatsby', 'price' => 19.49, 'description' => 'A classic novel by F. Scott Fitzgerald', 'category_id' => 3],
            ['name' => 'The Catcher in the Rye', 'price' => 18.25, 'description' => 'A coming-of-age novel by J.D. Salinger', 'category_id' => 4],
            ['name' => 'Men\'s T-shirt', 'price' => 13.29, 'description' => '100% cotton T-shirt, available in multiple colors', 'category_id' => 5],
            ['name' => 'Men\'s Jeans', 'price' => 39.19, 'description' => 'Slim-fit denim jeans with stretch fabric', 'category_id' => 6],
        ];

        foreach ($products as $productData) {
            $product = $this->productRepository->create($productData);
            $this->productyCategoryService->syncProductCategories($product->id, $productData['category_id']);
        }
    }
}
