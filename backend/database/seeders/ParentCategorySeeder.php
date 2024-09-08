<?php

namespace Database\Seeders;

use App\Repositories\ParentCategoryRepository;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class ParentCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    protected $parentCategoriesRepository;

    public function __construct()
    {
        $this->parentCategoriesRepository = new ParentCategoryRepository();
    }
    public function run(): void
    {
        $parentCategories = [
            ['name' => 'Books'],
            ['name' => 'Clothing'],
        ];

        foreach ($parentCategories as $parentCategory) {
            $this->parentCategoriesRepository->create($parentCategory);
        }
    }
}
