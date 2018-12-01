<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('icon')->nullable();
            $table->timestamps();
        });
        Schema::table('items', function(Blueprint $table) {
            $table->integer('category_id')->unsigned()->nullable();
            $table->foreign('category_id')->references('id')
                ->on('item_categories')
                ->onUpdate('cascade')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('items', function(Blueprint $table) {
            $table->dropForeign('items_category_id_foreign');
            $table->dropColumn('category_id');
        });
        Schema::dropIfExists('item_categories');
    }
}
