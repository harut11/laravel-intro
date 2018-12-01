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
    		'Անշարժ գույք',
			'Տրանսպորտ',
			'Էլեկտրոնիկա',
			'Կենցաղային տեխնիկա',
			'Ամեն ինչ տան համար',
			'Նորաձևություն եւ Ոճ',
			'Մանկական աշխարհ',
			'Մշակույթ և հոբբի',
			'Կենդանիներ և բույսեր',
			'Գործիքներ և նյութեր',
    	];
    	foreach ($data as $category) {
    		ItemCategory::create([
    			'name' => $category,
    		]);
    	}
    }
}
