# TrustJobs Uganda - Deployment Guide

## 🚀 Deployment Steps

### 1. Environment Setup
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Configure database in .env file
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=trustjobs_uganda
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 2. Database Setup
```bash
# Run migrations
php artisan migrate

# Run seeders (IMPORTANT!)
php artisan db:seed
```

### 3. Storage Setup
```bash
# Create storage link
php artisan storage:link

# Set proper permissions
chmod -R 775 storage bootstrap/cache
```

### 4. Frontend Assets
```bash
# Install dependencies
npm install

# Build assets
npm run build
```

## 📊 Seeder Data

The application comes with comprehensive seeders that provide:

### **Skill Categories** (13 categories)
- Agriculture & Agro-enterprise 🌾
- Construction & Trades 🏗️
- Transport & Auto 🚗
- Hospitality & Tourism 🏨
- Retail & Services 🛍️
- Domestic & Care Work 🏠
- Beauty & Wellness 💇‍♀️
- Security & Safety 🛡️
- ICT & Digital Basics 💻
- Creative & Media 🎨
- Manufacturing & Crafts 🔨
- Health & Community 🏥
- Education Support 📚

### **Skills** (100+ skills)
Each category contains multiple relevant skills for the Ugandan job market.

### **Languages** (13 languages)
- English, Luganda, Swahili, Runyankore-Rukiga, Runyoro-Rutooro
- Acholi, Lango, Ateso, Karamojong, Alur, Lugbara, Madi, Rukonzo

### **Default Users**
- **Admin**: admin@trustjobs.com / password
- **Employer**: employer@trustjobs.com / password  
- **Worker**: worker@trustjobs.com / password

## 🔄 Seeder Commands

### Run All Seeders
```bash
php artisan db:seed
```

### Run Individual Seeders
```bash
# Skill categories
php artisan db:seed --class=SkillCategorySeeder

# Skills
php artisan db:seed --class=SkillSeeder

# Languages
php artisan db:seed --class=LanguageSeeder
```

### Reset and Reseed
```bash
# Clear database and run all seeders
php artisan migrate:fresh --seed
```

## 🛠️ Additional Setup

### Queue Workers (if using queues)
```bash
# Start queue worker
php artisan queue:work

# Or for production with supervisor
php artisan queue:work --daemon
```

### Cache Configuration
```bash
# Clear and cache config
php artisan config:cache

# Clear and cache routes
php artisan route:cache

# Clear and cache views
php artisan view:cache
```

### Production Optimizations
```bash
# Optimize for production
php artisan optimize

# Clear all caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

## 🔐 Security Checklist

- [ ] Change default admin password
- [ ] Set proper file permissions
- [ ] Configure HTTPS
- [ ] Set up proper environment variables
- [ ] Configure backup strategy
- [ ] Set up monitoring/logging

## 📝 Notes

- The seeders provide comprehensive data for the Ugandan job market
- All skills are categorized and relevant to local employment
- Languages cover major Ugandan languages
- Default users are created for testing purposes
- Remember to change default passwords in production

## 🆘 Troubleshooting

If you encounter issues:

1. **Seeder errors**: Check database connection and permissions
2. **Missing data**: Ensure all seeders ran successfully
3. **Permission errors**: Set proper file permissions
4. **Asset issues**: Rebuild frontend assets with `npm run build`
