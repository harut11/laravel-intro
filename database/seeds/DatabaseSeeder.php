<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \Schema::disableForeignKeyConstraints();
        \DB::table('users')->truncate();
    	\DB::table('user_details')->truncate();
        \DB::table('items')->truncate();
    	\DB::table('item_categories')->truncate();
        $this->call(UsersTableSeeder::class);
        $this->call(ItemCategoriesTableSeeder::class);
        $this->call(ItemsTableSeeder::class);
    }
}
