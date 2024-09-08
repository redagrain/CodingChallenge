<?php

namespace App\Models;

use App\Models\ParentCategory;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function products(){
        return $this->belongsToMany(Product::class, 'products_categories');
    }

    public function parentCategories(){
        return $this->belongsTo(ParentCategory::class);
    }
}
