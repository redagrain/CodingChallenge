<?php
namespace App\Repositories;

use App\Models\Category;
use App\Repositories\BaseRepository;

class CategoryRepository extends BaseRepository{

    public function __construct(){
        parent::__construct(new Category);
    }

}