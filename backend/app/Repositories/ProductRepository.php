<?php

use App\Models\Product;
use BaseRepository;



class ProductRepository extends BaseRepository{

    public function __construct(){
        parent::__construct(new Product);
    }

}