<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
			'name' => 'Admin',
			'email' => 'admin@laravel.com',
			'password' => bcrypt('secret'),
        ]);
		factory(App\Models\User::class, 30)->create();
    }
}
