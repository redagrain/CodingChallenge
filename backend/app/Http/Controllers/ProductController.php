<?php

namespace App\Http\Controllers;

use CategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use ProductRepository;

class ProductController extends Controller
{
    protected $productRepository;
    protected $categoriesRepository;

    public function __construct(){
        $this->productRepository = new ProductRepository();
        $this->categoriesRepository = new CategoryRepository();
    }


    public function index(){
        try {
            $products = $this->productRepository->getAllWithRelations(['categories']);
            return response()->json($products, 200);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }


    public function create(){
        try {
            $categories = $this->categoriesRepository->getAllWithRelations(['categories']);
            return response()->json($categories, 200);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    public function store(Request $request){
        try {
            $data = $request->all();
            $this->productRepository->create($data);
            return response()->json(['message' => 'Product Created Successfully'], 200);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
