<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = FakerFactory::create();
        DB::table('subscriptions')->insert([
            [
            'name' => 'Basic',
            'description' => $faker->paragraph(),
            'price' => 6000,
            ],
            [
                'name' => 'Standard',
                'description' => $faker->paragraph(),
                'price' => 7500,
            ],
            [
                'name' => 'Premium',
                'description' => $faker->paragraph(),
                'price' => 9000,
            ]
        ]);
        //
    }
}
