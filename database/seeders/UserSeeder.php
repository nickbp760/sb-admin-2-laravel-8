<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name'      => 'Gereja Immanuel',
                'email'     => 'gerejaku@gmail.com',
                'password'  => Hash::make('password'),
                'role'      => 'admin',
            ],
            [
                'name'      => 'Niko',
                'email'     => 'niko@gmail.com',
                'password'  => Hash::make('password'),
                'role'      => 'admin',
            ],
            [
                'name'      => 'Chika Fujiwara',
                'email'     => 'chika@gmail.com',
                'password'  => Hash::make('password'),
                'role'      => 'user',
            ],
            [
                'name'      => 'Kotone',
                'email'     => 'kotone@gmail.com',
                'password'  => Hash::make('password'),
                'role'      => 'user',
            ],
        ]);
    }
}
