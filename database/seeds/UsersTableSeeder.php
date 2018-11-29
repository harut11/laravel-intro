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
        \DB::table('users')->insert([
        	[
				'name' => 'Admin',
				'email' => 'admin@laravel.com',
				'email_verified_at' => null,
				'password' => bcrypt('secret'),
				'remember_token' => null,
				'created_at' => now(),
				'updated_at' => now(),
	        ],
	        [
				'name' => 'Admin 2',
				'email' => 'admin2@laravel.com',
				'email_verified_at' => null,
				'password' => bcrypt('secret'),
				'remember_token' => null,
				'created_at' => now(),
				'updated_at' => now(),
	        ]
        ]);
    }
}
