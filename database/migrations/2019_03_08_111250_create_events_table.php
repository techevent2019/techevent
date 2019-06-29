<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('event_name');
            $table->date('event_start_date');
            $table->date('event_end_date');
            $table->time('event_start_time');
            $table->time('event_end_time');
            $table->date('event_last_registration_date');
            $table->string('college_name');
            $table->string('college_address');
            $table->string('event_place');
            $table->integer('col_cod');
            $table->float('evetn_price');
            $table->string('city');
            $table->string('department');
            $table->string('image')->nullable();
            $table->text('description');
            $table->text('team_specification');
            $table->text('general_rules');
            $table->text('judging_criteria');
            $table->text('level_description');
            $table->integer('max_member')->default('1');
            $table->integer('min_member')->default('1');
            $table->text('techfest_name');
            $table->text('level');
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
        Schema::dropIfExists('events');
    }
}
