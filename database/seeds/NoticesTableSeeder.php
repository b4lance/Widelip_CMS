<?php

use Illuminate\Database\Seeder;

class NoticesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         factory(App\Notice::class,300)->create()->each(function(App\Notice $notice){
            $notice->tags()->attach([
                rand(1,5),
                rand(6,14),
                rand(15,20)
            ]);
        });
    }
}
