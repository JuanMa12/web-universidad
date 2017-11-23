<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('participants', function (Blueprint $table) {
          $table->increments('id');
          $table->string('uuid', 255)->index();
          $table->string('name');
          $table->string('years');
          $table->string('gender');
          $table->string('document')->nullable();
          $table->enum('active' , ['0' , '1'])->default('0');
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
      Schema::drop('participants');
    }
}
