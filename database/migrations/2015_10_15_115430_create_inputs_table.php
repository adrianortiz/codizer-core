<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInputsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inputs', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title');
            $table->enum('type_validation', ['val_text', 'val_text_num', 'val_num', 'val_double', 'val_date']);
            $table->enum('type_input', ['input_text', 'input_select']);
            $table->string('description');
            $table->integer('form_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('inputs');
    }
}
