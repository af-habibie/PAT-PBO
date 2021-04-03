<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        date_default_timezone_set('Asia/Jakarta');
        
        Category::create([
            'title' => 'World', 
            'slug' => 'world',
            ]);
        Category::create([
            'title' => 'Business',
            'slug' => 'business',
            ]);
        Category::create([
            'title' => 'Gaming', 
            'slug' => 'gaming',
            ]);
    }
}
