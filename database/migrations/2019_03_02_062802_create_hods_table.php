<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hods', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('hod_id');
            $table->string('hod_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->bigInteger('hod_co_no');
            $table->string('hod_department');
            $table->integer('hod_col_id');
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
        Schema::dropIfExists('hods');
    }
}
