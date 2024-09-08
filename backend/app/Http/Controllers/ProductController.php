<?php

namespace App\Http\Controllers;

use App\Repositories\ParentCategoryRepository;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    protected $productRepository;
    protected $parentCategoryRepository;

    public function __construct(ProductRepository $productRepository, ParentCategoryRepository $parentCategoryRepository)
    {
        $this->productRepository = $productRepository;
        $this->parentCategoryRepository = $parentCategoryRepository;
    }


    public function index()
    {
        try {
            $products = $this->productRepository->getAllWithRelations(['categories.parentCategories']);
            return response()->json($products, 200);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'Failed to fetch products'], 500);
        }
    }


    public function create()
    {
        try {
            $categories = $this->parentCategoryRepository->getAllWithRelations(['categories']);
            return response()->json($categories, 200);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'Failed to fetch categories'], 500);
        }
    }

    public function store(Request $request)
    {
        $data = $request->all();
        try {
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('images/products', 'public');
                $data['image'] = $imagePath;
            }
            $this->productRepository->create($data);
            return response()->json(['message' => 'Product Created Successfully'], 200);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'Failed to create product'], 500);
        }
    }
}
