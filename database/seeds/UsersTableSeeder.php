<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserDetails;

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
            'admin' => 1,
        ]);
		factory(User::class, 30)->create()->each(function($user) {
            $details = factory(UserDetails::class)->make();
            $user->details()->update($details->getAttributes());
        });
    }
}
