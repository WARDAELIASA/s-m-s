<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\School;
class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        School::create([
            'name' => 'Example School 1',
            'address' => '123 Main St',
            'email' => 'asd@gmail.com',
            'phone' => '0727262662',
            'location' =>'dar es salaam',
        ]);

        School::create([
            'name' => 'Example School 2',
            'address' => '456 Oak Ave',
            'email' => 'asd@gmail.com',
            'phone' => '0727262662',
            'location' =>'dar es salaam',
        ]);

    }
}
