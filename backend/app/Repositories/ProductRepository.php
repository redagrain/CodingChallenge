<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Support\Collection;

class ProductRepository
{
    public function find(int $id): Product
    {
        return Product::find($id);
    }
    public function getAllWithRelations(): Collection
    {
        return Product::with('categories')->get();
    }
    public function create(array $data = []): Product
    {
        return Product::create($data);
    }
}
