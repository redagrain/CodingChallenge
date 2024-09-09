<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use App\Services\ProductyCategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    protected $productRepository;
    protected $categoryRepository;
    protected $productyCategoryService;

    public function __construct(ProductRepository $productRepository, CategoryRepository $categoryRepository, ProductyCategoryService $productyCategoryService)
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
        $this->productyCategoryService = $productyCategoryService;
    }


    public function index(): JsonResponse
    {
        try {
            $products = $this->productRepository->getAllWithRelations();
            return response()->json($products, 200);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'Failed to fetch products'], 500);
        }
    }


    public function create(): JsonResponse
    {
        try {
            $categories = $this->categoryRepository->getAll();
            return response()->json($categories, 200);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'Failed to fetch categories'], 500);
        }
    }

    public function store(ProductRequest $productRequest): JsonResponse
    {
        try {
            $data = $productRequest->validated();
            if ($productRequest->hasFile('image')) {
                $imagePath = $productRequest->file('image')->store('images/products', 'public');
                $data['image'] = $imagePath;
            }
            $product = $this->productRepository->create($data);
            $this->productyCategoryService->syncProductCategories($product->id, $data['category_id']);
            return response()->json(['message' => 'Product Created Successfully'], 200);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'Failed to create product'], 500);
        }
    }
}
