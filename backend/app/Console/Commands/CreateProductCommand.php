<?php

namespace App\Console\Commands;

use App\Repositories\ParentCategoryRepository;
use App\Repositories\ProductRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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

    public function __construct(ProductRepository $productRepository, ParentCategoryRepository $parentCategoryRepository)
    {
        parent::__construct();

        $this->productRepository = $productRepository;
        $this->parentCategoriesRepository = $parentCategoryRepository;
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
                "price" => $this->ask('Write product price'),
                "image" => $this->ask('write image path'),
            ];

            if (!file_exists($data['image'])) {
                $this->error('File does not exist at the specified path.');
                return 1;
            }

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

            $validateData = Validator::make($data, [
                'name' => ['required', 'min:3', 'max:25'],
                'description' => ['required', 'min:3', 'max:255'],
                'price' => ['required', 'numeric'],
                'image' => ['file', 'image', 'mimes:jpg,png,jpeg', 'max:2048'],
                'category_id' => ['required', 'integer'],
            ]);

            if ($validateData->fails()) {
                $this->error('Validation failed:');
                foreach ($validateData->errors()->all() as $message) {
                    $this->error($message);
                }
            } else {
                if ($this->productRepository->create($data)) {
                    Storage::putFileAs('images/products', $data['image'], basename($data['image']));
                    $this->info('post created successfully');
                }
            }
        } catch (\Exception $e) {
            $this->error('post couldn\'t be created, please make sure you filled all prompts');
            Log::error($e->getMessage());
        }
    }
}
