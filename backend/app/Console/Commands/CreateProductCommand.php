<?php

namespace App\Console\Commands;

use App\Repositories\ParentCategoryRepository;
use App\Repositories\ProductRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CreateProductCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:product';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to create a product from CLI';

    protected $productRepository;
    protected $parentCategoriesRepository;

    public function __construct()
    {
        parent::__construct();
    
        $this->productRepository = new ProductRepository();
        $this->parentCategoriesRepository = new ParentCategoryRepository();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $data = [
                "name" => $this->ask('Write product name'),
                "description" => $this->ask('Write product description'),
                "price" => $this->ask('Write product price')
            ];

            // Get parent categories
            $fetchParentCategories = $this->parentCategoriesRepository->getAllWithRelations(['categories']);

            //convert them to array with only name and id colomuns
            $parentCategories = $fetchParentCategories->pluck('name', 'id')->toArray();

            // prompt a selection of Categories to user
            $parentCategory = $this->choice('Select a Categroy', array_values($parentCategories));

            // get selected category and convert its subcategories to name and id colomuns only
            $getSubCategories = collect($fetchParentCategories)->firstWhere('name', $parentCategory);
            $subCategories = $getSubCategories->categories->pluck('name', 'id')->toArray();

            // prompt a selection of subCategories to user
            $subCategory = $this->choice('Select a Categroy', array_values($subCategories));

            // get id of selected sub category
            $data['category_id'] = array_search($subCategory, $subCategories);

            if ($this->productRepository->create($data)) {
                $this->info('post created successfully');
            }
        } catch (\Exception $e) {
            $this->error('post couldn\'t be created, please make sure you filled all prompts');
            Log::error($e->getMessage());
        }
    }
}
