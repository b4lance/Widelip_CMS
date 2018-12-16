<?php

use Faker\Generator as Faker;

$factory->define(App\Publicist::class, function (Faker $faker) {
	$title=$faker->sentence(5);
    return [
        'user_id'=>rand(1,30),
        'name'=>$faker->name,
        'lastname'=>$faker->name,
        'college'=>$title,
        'biography'=>$faker->text(500),
        'file'=>$faker->imageUrl($width=1200 ,$heigth= 400),
        'status'=>$faker->randomElement(['ACTIVE','INACTIVE']),
    ];
});
