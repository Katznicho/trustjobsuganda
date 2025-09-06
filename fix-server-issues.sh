#!/bin/bash

# Script to fix server deployment issues
# Run this directly on the server to resolve Laravel and database problems

echo "=== Fixing Server Deployment Issues ==="

# Set deployment directory
DEPLOY_DIR="/home/u367101322/domains/jobtrust.space/public_html"
cd "$DEPLOY_DIR" || { echo "Failed to change directory to $DEPLOY_DIR"; exit 1; }

echo "Current directory: $(pwd)"

# Step 1: Install Composer dependencies
echo "Step 1: Installing Composer dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction

# Step 2: Clear all Laravel caches
echo "Step 2: Clearing Laravel caches..."
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Step 3: Check .env file
echo "Step 3: Checking .env file..."
if [ -f ".env" ]; then
    echo "✅ .env file exists"
    echo "Database configuration:"
    echo "  DB_CONNECTION: $(grep '^DB_CONNECTION=' .env | cut -d'=' -f2)"
    echo "  DB_HOST: $(grep '^DB_HOST=' .env | cut -d'=' -f2)"
    echo "  DB_DATABASE: $(grep '^DB_DATABASE=' .env | cut -d'=' -f2)"
    echo "  DB_USERNAME: $(grep '^DB_USERNAME=' .env | cut -d'=' -f2)"
else
    echo "❌ .env file not found!"
    exit 1
fi

# Step 4: Test Laravel
echo "Step 4: Testing Laravel..."
php artisan --version

# Step 5: Test database connection
echo "Step 5: Testing database connection..."
php artisan tinker --execute="
try {
  \$pdo = DB::connection()->getPdo();
  echo '✅ Database connection successful!';
  echo 'Database: ' . DB::connection()->getDatabaseName();
} catch (Exception \$e) {
  echo '❌ Database connection failed: ' . \$e->getMessage();
}
"

# Step 6: Run migrations
echo "Step 6: Running migrations..."
php artisan migrate:fresh --force --verbose

# Step 7: Run seeders
echo "Step 7: Running seeders..."
php artisan db:seed --force --verbose

# Step 8: Optimize Laravel
echo "Step 8: Optimizing Laravel..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Step 9: Create storage link
echo "Step 9: Creating storage link..."
php artisan storage:link

# Step 10: Final verification
echo "Step 10: Final verification..."
echo "Tables in database:"
php artisan tinker --execute="
use Illuminate\Support\Facades\DB;
\$tables = DB::select('SHOW TABLES');
foreach(\$tables as \$table) {
  foreach(\$table as \$key => \$value) {
    echo \$value . PHP_EOL;
  }
}
"

echo "=== Server Issues Fixed! ==="
