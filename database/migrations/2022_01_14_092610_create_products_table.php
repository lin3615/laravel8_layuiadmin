<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title')->nullable()->index('title');
			$table->string('keywords')->nullable();
			$table->text('description')->nullable();
			$table->integer('category_id')->nullable()->index('category_id')->comment('category_id');
			$table->text('content')->nullable();
			$table->string('thumb')->nullable()->comment('缩略图');
			$table->boolean('flag')->nullable()->default(1)->index('flag')->comment('flag');
			$table->string('author', 50)->nullable()->index('author');
			$table->timestamps(10);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('products');
	}

}
