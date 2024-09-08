<?php

use App\Models\ParentCategory;
use BaseRepository;

class CategoryRepository extends BaseRepository{

    public function __construct(){
        parent::__construct(new ParentCategory);
    }

}