<?php

use Illuminate\Database\Seeder;

class PublicistsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         factory(App\Publicist::class,30)->create();
    }
}

