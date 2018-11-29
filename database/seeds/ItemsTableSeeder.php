<?php

use Illuminate\Database\Seeder;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('items')->insert([
        	'title' => 'lorem',
			'content' => 'lorem',
			'thumbnail' => 'lorem',
			'created_at' => now(),
			'updated_at' => now(),
        ]);
    }
}
