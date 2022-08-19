<?php

namespace Database\Seeders;

use App\Models\Product;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductTableSeeder extends Seeder
{
    public function run()
    {
        DB::statement("SET foreign_key_checks=0");

        $faker = Factory::create('tr_TR');
        Product::truncate();
        for ($i=0; $i<10; $i++){
            Product::create([
                "title"=>$faker->text(50),
                "price"=>$faker->randomFloat(3,1,10),
                "image"=>"https://picsum.photos/id/".random_int(10,300)."/300/200"
            ]);
        }

        DB::statement("SET foreign_key_checks=1");

    }
}
