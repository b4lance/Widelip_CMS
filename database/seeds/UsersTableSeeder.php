<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class,29)->create();

        App\User::create([
            'name'=>'Kevin Rondón',
            'last_name'=>'Kevin Rondón',
            'username'=>'b4lance',
            'email'=>'leonciorequena1995@gmail.com',
            'password'=>'1234',
            'confirmed'=>'1',
            'role'=>'ADMIN',
            'status'=>'ACTIVE'
        ]);
    }
}
