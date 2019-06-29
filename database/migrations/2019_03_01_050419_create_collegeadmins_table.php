<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCollegeadminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collegeadmins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('image');
            $table->integer('col_code');
            $table->string('col_name');
            $table->string('col_address');
            $table->string('col_city');
            $table->bigInteger('col_con_no');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('col_admin_name');
            $table->string('col_principal_name');
            $table->string('admin_con_no');
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
        Schema::dropIfExists('collegeadmins');
    }
}
