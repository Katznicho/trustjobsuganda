<?php

namespace Database\Seeders;

use App\Models\Skill;
use App\Models\SkillCategory;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $skills = [
            'Agriculture & Agro-enterprise' => [
                'Crop farming (maize, beans, cassava, matooke/bananas, rice, vegetables)',
                'Poultry rearing (broilers, layers)',
                'Goat rearing',
                'Cattle rearing (dairy)',
                'Pig keeping',
                'Fish farming (aquaculture)',
                'Beekeeping',
                'Post-harvest handling & storage',
                'Agro produce marketing/aggregation',
                'Seedling nursery management',
                'Coffee handling (picking, drying, grading)',
                'Irrigation setup (basic)',
                'Organic composting & soil health',
                'Agri-processing (sunflower oil pressing, milling assistant)',
            ],
            'Construction & Trades' => [
                'Masonry/Bricklaying',
                'Carpentry & Joinery',
                'Plumbing (basic installation & repairs)',
                'Electrical installation (domestic, basic)',
                'Welding & Metal fabrication',
                'Painting & Decorating',
                'Tiling',
                'Roofing (iron sheets/tiles)',
                'Ceiling & Gypsum',
                'Pavers & Cabro laying',
                'Site helper/Casual laborer',
                'Borehole/handpump maintenance (basic)',
            ],
            'Transport & Auto' => [
                'Motorcycle riding (boda)',
                'Driving (Car—Class B, Light truck—Class CM/CH)',
                'Delivery/Dispatch rider',
                'Vehicle mechanic (basic)',
                'Auto-electrician (basic)',
                'Tyre services (puncture repair, balancing)',
                'Logistics assistant/Loader',
            ],
            'Hospitality & Tourism' => [
                'Cooking (local foods)',
                'Catering',
                'Baking/Pastry',
                'Barista (basic)',
                'Bartending',
                'Housekeeping/Room attendant',
                'Front desk/Reception (basic)',
                'Waiter/Waitress',
                'Events Usher',
                'Tour guiding (basic)',
                'Ticketing (basic)',
            ],
            'Retail & Services' => [
                'Shop attendant',
                'Cashier/POS operation',
                'Merchandising & Shelf stocking',
                'Market vendor operations',
                'Mobile Money agent operations',
                'Inventory/Store assistant',
                'Customer care (basic)',
                'Phone accessories & SIM registration agent (compliant)',
            ],
            'Domestic & Care Work' => [
                'Home cleaning',
                'Laundry/Ironing',
                'Cook (home)',
                'Nanny/Childcare',
                'Elderly care assistant',
                'Gardener/Compound maintenance',
                'Pet care (basic)',
                'House manager (basic)',
            ],
            'Beauty & Wellness' => [
                'Hairdressing (female)',
                'Barbering (male)',
                'Braiding/Weaving',
                'Dreadlocks maintenance',
                'Makeup artist',
                'Nail technician',
                'Massage therapist (basic)',
                'Cosmetology (general)',
            ],
            'Security & Safety' => [
                'Security guard',
                'Access control',
                'CCTV monitoring (basic)',
                'Bouncer/Doorman',
                'Fire safety (basic)',
                'First aid (basic)',
            ],
            'ICT & Digital Basics' => [
                'Smartphone literacy & data use',
                'Typing & Data entry',
                'Microsoft Office (Word/Excel)',
                'Social media page handling (basic)',
                'Basic graphic design (Canva)',
                'Computer maintenance (basic)',
                'Phone repair (basic)',
                'POS system operation',
                'Digital photo printing kiosk (basic)',
            ],
            'Creative & Media' => [
                'Photography',
                'Videography (basic)',
                'Photo/Video editing (basic)',
                'DJ/MC (events)',
                'Event decoration',
                'Tents/Chairs setup',
                'Public address (sound setup, basic)',
            ],
            'Manufacturing & Crafts' => [
                'Tailoring & Garment repair',
                'Knitting/Crochet',
                'Leather works/Shoemaking repair',
                'Handcrafts (baskets, mats, beads)',
                'Soap & detergent making (small-scale)',
                'Briquettes/Improved cookstoves making',
            ],
            'Health & Community' => [
                'Community mobilizer/Enumerator',
                'Caregiver/Home-based care assistant (non-clinical)',
                'WASH promoter (basic)',
                'First aid (basic)',
            ],
            'Education Support' => [
                'Early childhood caregiver/Assistant',
                'Private tutoring (primary subjects)',
                'Adult literacy facilitator (basic)',
            ],
        ];

        foreach ($skills as $categoryName => $skillNames) {
            $category = SkillCategory::where('name', $categoryName)->first();
            
            if ($category) {
                foreach ($skillNames as $skillName) {
                    Skill::create([
                        'name' => $skillName,
                        'category_id' => $category->id,
                        'description' => $skillName,
                    ]);
                }
            }
        }
    }
}
