<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Task;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Carbon\CarbonPeriod;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $start = now()->startOfMonth()->subMonthsNoOverflow();
        $end = now();
        $period = CarbonPeriod::create($start, '1 day', $end);

        User::factory(5)->create()->each(function ($user) use($period) {
            foreach ($period as $date) {
                $date->hour(rand(0, 23))->minute(rand(0, 6) * 10);

                Task::factory()->create([
                    'user_id' => $user->id,
                    'created_at' => $date,
                    'updated_at' => $date
                ]);
            }
        });


        $this->call(ClassesSeeder::class);
        $this->call(SectionsSeeder::class);
        $this->call(StudentsSeeder::class);
        
        // $categories = Category::factory(10)->create();
        // User::factory(5)
        //     ->has(
        //         Product::factory(30)->state(function () use ($categories) {
        //             return ['category_id' => $categories->random()->id];
        //         })
        //     )
        //     ->create();
    }
}
