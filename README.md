# Coding Challenge Software Engineer

## Automating of build of frontend and backend

**Note**: You should have PowerShell installed and the necessary permissions, then run the following script:

```bash
./start_app.ps1
```

Otherwise run the following commands manually to start the application:

## Install laravel

```bash
cd ./backend
composer install
```

Please make in mind that some commands will not work in diffrent envirements

For macOS/linux

```bash
cp .env.example .env
```

for windows

```bash
copy .env.example .env
Copy-Item .env.example .env
```

for windows (PowerShell)

```bash
Copy-Item .env.example .env
```

### migarte database and seed

```bash
php artisan migrate --seed
```

### start backend server

```bash
php artisan serve
```

Note: make sure the backend server is running on : **http://127.0.0.1:8000**

### Install Vue.js

```bash
cd ../frontend
npm install
```

### Run frontend server

```bash
npm run dev
```
