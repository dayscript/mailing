<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToCampaingsContactTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('campaing_contact', function (Blueprint $table) {
            $table->string('status')->nullable()->default('')->after('contact_id');
            $table->boolean('open')->nullable()->default(false)->after('contact_id');
            $table->boolean('click')->nullable()->default(false)->after('contact_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('campaing_contact', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('open');
            $table->dropColumn('click');
        });
    }
}
