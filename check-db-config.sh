#!/bin/bash

# Quick database configuration checker
# Run this on your server to check database settings

echo "=== Database Configuration Checker ==="

# Check .env file
if [ -f ".env" ]; then
    echo "✅ .env file found"
    
    # Extract database settings
    DB_CONNECTION=$(grep '^DB_CONNECTION=' .env | cut -d'=' -f2)
    DB_HOST=$(grep '^DB_HOST=' .env | cut -d'=' -f2)
    DB_PORT=$(grep '^DB_PORT=' .env | cut -d'=' -f2)
    DB_DATABASE=$(grep '^DB_DATABASE=' .env | cut -d'=' -f2)
    DB_USERNAME=$(grep '^DB_USERNAME=' .env | cut -d'=' -f2)
    DB_PASSWORD=$(grep '^DB_PASSWORD=' .env | cut -d'=' -f2)
    
    echo "Database Configuration:"
    echo "  Connection: $DB_CONNECTION"
    echo "  Host: $DB_HOST"
    echo "  Port: $DB_PORT"
    echo "  Database: $DB_DATABASE"
    echo "  Username: $DB_USERNAME"
    echo "  Password: [HIDDEN]"
    
    # Test connection
    echo ""
    echo "Testing connection..."
    php artisan tinker --execute="
        try {
            \$pdo = DB::connection()->getPdo();
            echo '✅ SUCCESS: Database connection working!' . PHP_EOL;
        } catch (Exception \$e) {
            echo '❌ ERROR: ' . \$e->getMessage() . PHP_EOL;
        }
    "
    
else
    echo "❌ .env file not found!"
fi
