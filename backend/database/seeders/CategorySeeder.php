<?php

namespace Database\Seeders;

use App\Repositories\CategoryRepository;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    protected $categoriesRepository;

    public function __construct()
    {
        $this->categoriesRepository = new CategoryRepository();
    }
    public function run(): void
    {
        $categories = [
            ['name' => 'History', 'parent_category' => 1],
            ['name' => 'Biography', 'parent_category' => 1],
            ['name' => 'Science', 'parent_category' => 1],
            ['name' => 'Shirts', 'parent_category' => 2],
            ['name' => 'Jackets', 'parent_category' => 2],
            ['name' => 'Trousers', 'parent_category' => 2],
        ];

        foreach ($categories as $category) {
            $this->categoriesRepository->create($category);
        }
    }
}
