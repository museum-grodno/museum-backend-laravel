<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestsTourInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests_tour_info', function (Blueprint $table) {
            $table->increments('rq_id');
            $table->date('rq_date_info');
            $table->time('rq_time_start');
            $table->integer('rq_object_id');
            $table->integer('rq_count_customers');
            $table->boolean('rq_is_excursions')->default(false);
            $table->text('rq_organisation_name');
            $table->text('rq_organisation_address');
            $table->string('rq_organisation_unp',10);
            $table->text('rq_organisation_rs');
            $table->text('rq_organisation_contacts');
            $table->string('rq_organisation_email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requests_tour_info');
    }
}
