<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'Colocation',
        ]);

        Category::create([
            'name' => 'Covoiturage',
        ]);

        Category::create([
            'name' => 'Vente de meuble',
        ]);

        Category::create([
            'name' => 'Soutien scolaire',
        ]);
    }
}
