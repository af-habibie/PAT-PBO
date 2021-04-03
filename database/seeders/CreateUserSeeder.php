<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'alfatichfairuzhabibie@gmail.com',
            'is_admin' => '1',
            'password' => bcrypt('12345678'),
        ]);
        User::create([
            'name' => 'Habibie',
            'email' => 'fairuz0926@gmail.com',
            'is_admin' => '0',
            'password' => bcrypt('12345678'),
        ]);
    }
}
