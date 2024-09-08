# Install Laravel
Write-Host "Navigating to backend directory..."
Set-Location -Path "./backend"

Write-Host "Installing Composer dependencies..."
composer install

# copying .env.example file 
try {
    Write-Host "Copying .env.example to .env..."
    cp .env.example .env
} catch {
    Write-Host "An error occurred, please copy .env.example file manually "
}

# Migrate and seed the database
Write-Host "Migrating and seeding the database..."
php artisan migrate --seed

# Start Laravel backend server
Write-Host "Starting Laravel backend server..."
php artisan serve

Write-Host "Make sure the backend server is running on: http://127.0.0.1:8000"

# Install Vue.js

Write-Host "Navigating to frontend directory..."
Set-Location -Path "../frontend"

Write-Host "Installing npm dependencies..."
npm install

# Run frontend server
Write-Host "Running frontend development server..."
npm run dev
