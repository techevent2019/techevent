<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('stu_name');
            $table->bigInteger('stu_enrollment_no')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->bigInteger('stu_con_no');
            $table->string('stu_department');
            $table->integer('stu_col_code');
            $table->string('stu_col_name');
            $table->integer('stu_sem');
            $table->string('stu_gender');
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
        Schema::dropIfExists('students');
    }
}
