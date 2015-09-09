<?php

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
            $table->increments('id');
            $table->string('sg_message_id');
            $table->string('email');
            $table->timestamp('time');
            $table->string('category');
            $table->string('event');
            $table->string('url');
            $table->string('asm_group_id');
            $table->string('smtp-id');
            $table->string('useragent');
            $table->string('ip');
            $table->string('status');
            $table->string('reason');
            $table->string('type');
            $table->string('attempt');
            $table->string('response');
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
        Schema::drop('events');
    }
}
