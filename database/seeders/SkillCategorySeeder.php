<?php

namespace Database\Seeders;

use App\Models\SkillCategory;
use Illuminate\Database\Seeder;

class SkillCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Agriculture & Agro-enterprise', 'icon' => '🌾', 'description' => 'Farming, livestock, and agricultural services'],
            ['name' => 'Construction & Trades', 'icon' => '🏗️', 'description' => 'Building, masonry, carpentry, and related trades'],
            ['name' => 'Transport & Auto', 'icon' => '🚗', 'description' => 'Driving, mechanics, and transportation services'],
            ['name' => 'Hospitality & Tourism', 'icon' => '🏨', 'description' => 'Hotels, restaurants, and tourism services'],
            ['name' => 'Retail & Services', 'icon' => '🛍️', 'description' => 'Shop work, customer service, and retail operations'],
            ['name' => 'Domestic & Care Work', 'icon' => '🏠', 'description' => 'Housekeeping, childcare, and domestic services'],
            ['name' => 'Beauty & Wellness', 'icon' => '💇‍♀️', 'description' => 'Hair styling, beauty treatments, and wellness services'],
            ['name' => 'Security & Safety', 'icon' => '🛡️', 'description' => 'Security services and safety-related work'],
            ['name' => 'ICT & Digital Basics', 'icon' => '💻', 'description' => 'Computer skills, data entry, and digital services'],
            ['name' => 'Creative & Media', 'icon' => '🎨', 'description' => 'Photography, events, and creative services'],
            ['name' => 'Manufacturing & Crafts', 'icon' => '🔨', 'description' => 'Tailoring, crafts, and manufacturing work'],
            ['name' => 'Health & Community', 'icon' => '🏥', 'description' => 'Healthcare support and community services'],
            ['name' => 'Education Support', 'icon' => '📚', 'description' => 'Teaching assistance and educational support'],
        ];

        foreach ($categories as $category) {
            SkillCategory::create($category);
        }
    }
}
