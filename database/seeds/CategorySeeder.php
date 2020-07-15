<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 5 ; $i++) {
            $new_category = new Category();
            $new_category->name = $faker->unique()->word;
            $new_category->slug = $new_category->name;
            $new_category->save();
        }
    }
}
