<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSampleLogTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
    Schema::connection('dbSampleLog')->create('sampleLog', function($table)
    {
        $table->increments('id');
        $table->string('message');
    });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
    Schema::connection('dbSampleLog')->drop('sampleLog');
	}

}
