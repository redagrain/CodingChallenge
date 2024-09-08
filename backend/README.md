# Backend of Coding Challenge

## Used Commands

### Commands to create databse schema

```bash
php artisan make:migration parent_categories   

php artisan make:migration categories

php artisan make:migration products

php artisan make:migration products_categories

php artisan migrate
```

### Commands to create models

```bash
php artisan make:model Product

php artisan make:model ParentCategory

php artisan make:model Category
```

### Commands to create controllers

```bash
php artisan make:controller ProductController

php artisan make:controller CategoryController
```

### Commands to create seeders

```bash
php artisan make:seeder CategorySeeder    

php artisan make:seeder ParentCategorySeeder
```
