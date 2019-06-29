<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventcodinatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventcodinators', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('event_name');
            $table->integer('event_id');
            $table->bigInteger('ec_enrollment_no');
            $table->integer('ec_col_code');
            $table->string('email');
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('eventcodinators');
    }
}
