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
            $table->bigIncrements('id');
            $table->bigInteger('event_id');
            $table->bigInteger('enrollment_no');
            $table->string('email')->nullable();
            $table->boolean('present')->default('0');
            $table->float('round1score')->default('0');
            $table->float('round2score')->default('0');
            $table->float('round3score')->default('0');
            $table->boolean('addedinround2')->default('0');
            $table->boolean('addedinround3')->default('0');
            $table->boolean('participetedround1')->default('0');
            $table->boolean('participetedround2')->default('0');
            $table->boolean('participetedround3')->default('0');
            $table->integer('winner')->nullable();
            $table->bigInteger('team_id')->default('0');
            $table->boolean('register')->default('0');
            $table->boolean('leader')->default('0');
            $table->boolean('accept')->default('0');
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
        Schema::dropIfExists('participants');
    }
}
