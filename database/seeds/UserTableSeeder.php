<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = new \App\User([
          'name' => 'Ricardo Huerta Dorame',
          'email' => 'rhdorame@gmail.com',
          'password' => bcrypt('password'),
          'admin' => 'si'
        ]);
        $user->save();
    }
}
