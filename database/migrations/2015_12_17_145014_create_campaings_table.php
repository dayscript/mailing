<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampaingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaings', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->string('title');
            $table->string('subject');
            $table->string('image');
            $table->string('url');
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('campaing_contact', function(Blueprint $table)
        {
            $table->integer('campaing_id')->unsigned()->index();
            $table->integer('contact_id')->unsigned()->index();
            $table->timestamps();
            $table->foreign('campaing_id')->references('id')->on('campaings')->onDelete('cascade');
            $table->foreign('contact_id')->references('id')->on('contacts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('campaings');
        Schema::drop('campaing_contact');
    }
}
