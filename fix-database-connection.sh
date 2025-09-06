#!/bin/bash

# Script to fix database connection issues on the server
# This script will help diagnose and fix database connection problems

echo "=== Database Connection Diagnostic Script ==="

# Set deployment directory
DEPLOY_DIR="/home/u367101322/domains/jobtrust.space/public_html"

# Change to deployment directory
cd "$DEPLOY_DIR" || { echo "Failed to change directory to $DEPLOY_DIR"; exit 1; }

echo "Current directory: $(pwd)"

# Check if .env exists
if [ -f ".env" ]; then
    echo "✅ .env file exists"
    
    # Check database configuration (without showing sensitive data)
    echo "📋 Database configuration check:"
    echo "DB_CONNECTION: $(grep '^DB_CONNECTION=' .env | cut -d'=' -f2)"
    echo "DB_HOST: $(grep '^DB_HOST=' .env | cut -d'=' -f2)"
    echo "DB_PORT: $(grep '^DB_PORT=' .env | cut -d'=' -f2)"
    echo "DB_DATABASE: $(grep '^DB_DATABASE=' .env | cut -d'=' -f2)"
    echo "DB_USERNAME: $(grep '^DB_USERNAME=' .env | cut -d'=' -f2)"
    echo "DB_PASSWORD: [HIDDEN]"
    
    # Test basic database connection
    echo "🔍 Testing database connection..."
    php artisan tinker --execute="
        try {
            \$pdo = DB::connection()->getPdo();
            echo '✅ Database connection successful!' . PHP_EOL;
            echo 'Database: ' . DB::connection()->getDatabaseName() . PHP_EOL;
        } catch (Exception \$e) {
            echo '❌ Database connection failed: ' . \$e->getMessage() . PHP_EOL;
        }
    "
    
    # Test if we can create a simple table
    echo "🔍 Testing table creation..."
    php artisan tinker --execute="
        try {
            DB::statement('CREATE TABLE IF NOT EXISTS test_connection (id INT PRIMARY KEY)');
            echo '✅ Table creation test successful!' . PHP_EOL;
            DB::statement('DROP TABLE IF EXISTS test_connection');
        } catch (Exception \$e) {
            echo '❌ Table creation test failed: ' . \$e->getMessage() . PHP_EOL;
        }
    "
    
else
    echo "❌ .env file not found!"
    echo "Please ensure the .env file exists with proper database configuration."
    exit 1
fi

echo ""
echo "=== Common Database Issues & Solutions ==="
echo "1. Check if database credentials are correct"
echo "2. Verify database server is running"
echo "3. Check if database user has proper permissions"
echo "4. Ensure database exists on the server"
echo "5. Check firewall/network connectivity"
echo ""
echo "=== Next Steps ==="
echo "If database connection is working, run:"
echo "php artisan migrate:fresh --force --verbose"
echo "php artisan db:seed --force --verbose"
