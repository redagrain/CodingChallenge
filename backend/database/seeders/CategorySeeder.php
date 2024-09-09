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
            ['name' => 'Books'],
            ['name' => 'Clothing'],
            ['name' => 'History', 'parent_id' => 1],
            ['name' => 'Biography', 'parent_id' => 1],
            ['name' => 'Jackets', 'parent_id' => 2],
            ['name' => 'Trousers', 'parent_id' => 2],
        ];

        foreach ($categories as $category) {
            $this->categoriesRepository->create($category);
        }
    }
}
