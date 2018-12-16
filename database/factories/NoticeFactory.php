<?php

use Faker\Generator as Faker;

$factory->define(App\Notice::class, function (Faker $faker) {
    $title=$faker->sentence(5);
    return [
        'publicist_id'=>rand(1,30),
        'category_id'=>rand(1,20),
        'name'=>$title,
        'slug'=>str_slug($title),
        'excerpt'=>$faker->text(200),
        'body'=>$faker->text(500),
        'file'=>$faker->imageUrl($width=1200 ,$heigth= 400),
        'status'=>$faker->randomElement(['PUBLISHED','DRAFT']),
    ];
});
