# TrustJobs Deployment Configuration

## 🔧 GitHub Secrets Required

You need to set up the following secrets in your GitHub repository:

### **Repository Settings → Secrets and variables → Actions**

1. **FTP_SERVER**: Your Hostinger server hostname
   - Example: `srv123.hstgr.io`

2. **FTP_USERNAME**: Your Hostinger username
   - Example: `u367101322`

3. **FTP_PASSWORD**: Your Hostinger password
   - Your Hostinger account password

## 🚀 How to Set Up Secrets

1. Go to your GitHub repository
2. Click **Settings** tab
3. Click **Secrets and variables** → **Actions**
4. Click **New repository secret**
5. Add each secret with the exact names above

## 📁 Server Directory Structure

The deployment will use this path:
```
/home/u367101322/domains/jobtrust.space/public_html
```

## 🔄 Deployment Process

The GitHub Actions workflow will:

1. **Checkout** code from main branch
2. **Setup PHP 8.3** with required extensions
3. **Install Composer** dependencies
4. **Setup Node.js** and build frontend assets
5. **Deploy** files via SSH/rsync
6. **Run migrations** and seeders
7. **Optimize** Laravel for production
8. **Verify** deployment

## ⚠️ Important Notes

### **Before First Deployment:**

1. **Create `.env` file** on your server with:
   ```env
   APP_NAME="TrustJobs Uganda"
   APP_ENV=production
   APP_KEY=base64:your-key-here
   APP_DEBUG=false
   APP_URL=https://jobtrust.space
   
   DB_CONNECTION=mysql
   DB_HOST=localhost
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_database_user
   DB_PASSWORD=your_database_password
   ```

2. **Generate APP_KEY**:
   ```bash
   php artisan key:generate
   ```

3. **Set proper permissions**:
   ```bash
   chmod -R 755 storage bootstrap/cache
   chown -R u367101322:u367101322 storage bootstrap/cache
   ```

### **Files Excluded from Deployment:**

- `.env` (sensitive configuration)
- `.htaccess` (server-specific)
- `node_modules/` (built during deployment)
- `vendor/` (installed during deployment)
- `storage/logs/*` (runtime logs)
- `tests/` (development files)
- `.github/` (CI/CD files)

### **Automatic Tasks:**

- ✅ **Migrations**: Run automatically
- ✅ **Seeders**: Run only if database is empty
- ✅ **Asset Building**: Frontend assets built during deployment
- ✅ **Cache Optimization**: Laravel caches optimized
- ✅ **Storage Link**: Created automatically
- ✅ **Permissions**: Set automatically

## 🐛 Troubleshooting

### **Common Issues:**

1. **SSH Connection Failed**:
   - Check FTP_SERVER, FTP_USERNAME, FTP_PASSWORD secrets
   - Verify SSH access on Hostinger

2. **Migration Errors**:
   - Check database credentials in `.env`
   - Ensure database exists and is accessible

3. **Permission Errors**:
   - Check file ownership and permissions
   - Ensure storage and cache directories are writable

4. **Asset Build Errors**:
   - Check Node.js version compatibility
   - Verify npm dependencies

### **Manual Commands (if needed):**

```bash
# On your server
cd /home/u367101322/domains/jobtrust.space/public_html

# Run migrations
php artisan migrate --force

# Run seeders
php artisan db:seed --force

# Clear caches
php artisan optimize:clear

# Build assets (if needed)
npm install && npm run build
```

## 📞 Support

If you encounter issues:
1. Check GitHub Actions logs for detailed error messages
2. Verify all secrets are correctly set
3. Ensure server has required PHP extensions
4. Check database connectivity
