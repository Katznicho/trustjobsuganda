<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $languages = [
            ['name' => 'English', 'code' => 'en'],
            ['name' => 'Luganda', 'code' => 'lg'],
            ['name' => 'Swahili', 'code' => 'sw'],
            ['name' => 'Runyankore-Rukiga', 'code' => 'nyn'],
            ['name' => 'Runyoro-Rutooro', 'code' => 'nyo'],
            ['name' => 'Acholi', 'code' => 'ach'],
            ['name' => 'Lango', 'code' => 'laj'],
            ['name' => 'Ateso', 'code' => 'teo'],
            ['name' => 'Karamojong', 'code' => 'kdj'],
            ['name' => 'Alur', 'code' => 'alz'],
            ['name' => 'Lugbara', 'code' => 'luc'],
            ['name' => 'Madi', 'code' => 'grq'],
            ['name' => 'Rukonzo', 'code' => 'koo'],
        ];

        foreach ($languages as $language) {
            Language::create($language);
        }
    }
}
