<?php

use Illuminate\Database\Seeder;
use App\Models\ItemCategory;

class ItemCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$data = [
    		'Real Estate',
			'Transport',
			'Electronics',
			'Household Appliances',
			'Everything for home',
			'Clothing and Fashion',
			'Children\'s world',
			'Culture and Hobby',
			'Animals and plants',
			'Tools and Materials',
    	];
    	foreach ($data as $category) {
    		ItemCategory::create([
    			'name' => $category,
    		]);
    	}
    }
}
