<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use App\Repositories\CategoryRepository;

class ProductyCategoryService
{
    protected $productRepository;
    protected $categoryRepository;

    public function __construct(ProductRepository $productRepository, CategoryRepository $categoryRepository)
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function syncProductCategories(int $productId, int $categoryId)
    {
        $product = $this->productRepository->find($productId);
        if ($product) {
            $product->categories()->sync([$categoryId]);
        }
    }
}
