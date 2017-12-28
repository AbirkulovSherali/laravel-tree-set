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
        DB::table('users')->insert([
            'name' => 'Sherali',
            'email' => 'abirkulovs@gmail.com',
            'password' => bcrypt('test')
        ]);

        DB::table('users')->insert([
            'name' => 'Akim',
            'email' => 'akim@gmail.com',
            'password' => bcrypt('test')
        ]);

        DB::table('users')->insert([
            'name' => 'Kirill',
            'email' => 'kirill@gmail.com',
            'password' => bcrypt('test')
        ]);
    }
}
