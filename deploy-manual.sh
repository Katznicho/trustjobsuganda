#!/bin/bash

# Manual deployment script for TrustJobs
# This script can be run manually on the server to ensure proper deployment

echo "Starting manual deployment for TrustJobs..."

# Set deployment directory
DEPLOY_DIR="/home/u367101322/domains/jobtrust.space/public_html"

# Change to deployment directory
cd "$DEPLOY_DIR" || { echo "Failed to change directory to $DEPLOY_DIR"; exit 1; }

echo "Current directory: $(pwd)"
echo "Directory contents:"
ls -la

# Check if .env exists
if [ -f ".env" ]; then
    echo ".env file exists"
else
    echo "Error: .env file not found"
    exit 1
fi

# Check PHP version
echo "PHP version:"
php --version

# Check Laravel
echo "Laravel version:"
php artisan --version

# Test database connection
echo "Testing database connection..."
php artisan tinker --execute="DB::connection()->getPdo(); echo 'Database connection successful';" || echo "Database connection failed"

# List current tables
echo "Current tables in database:"
php artisan tinker --execute="use Illuminate\Support\Facades\DB; \$tables = DB::select('SHOW TABLES'); foreach(\$tables as \$table) { foreach(\$table as \$key => \$value) { echo \$value . PHP_EOL; } }"

# Check migration status
echo "Current migration status:"
php artisan migrate:status

# Run fresh migration
echo "Running fresh migration..."
php artisan migrate:fresh --force --verbose

# Run seeders
echo "Running seeders..."
php artisan db:seed --force --verbose

# Clear and cache configurations
echo "Optimizing Laravel..."
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Create storage link
echo "Creating storage link..."
php artisan storage:link

# Final verification
echo "Final verification - tables after migration:"
php artisan tinker --execute="use Illuminate\Support\Facades\DB; \$tables = DB::select('SHOW TABLES'); foreach(\$tables as \$table) { foreach(\$table as \$key => \$value) { echo \$value . PHP_EOL; } }"

echo "Manual deployment completed!"
