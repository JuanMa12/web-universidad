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
          $table->string('name_one');
          $table->string('name_two');
          $table->string('lastname_one');
          $table->string('lastname_two');
          $table->string('type');
          $table->string('born');
          $table->string('gender');
          $table->string('deparment')->nullable();
          $table->string('city')->nullable();
          $table->string('type_document')->nullable();
          $table->string('document')->nullable();
          $table->string('school')->nullable();
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
