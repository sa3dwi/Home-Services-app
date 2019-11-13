<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection($this->connection)->table('worker', function(Blueprint $collection)
        {
            $collection->increments('id')->index();
            $collection->string('title')->index();
            $collection->string('email')->unique()->nullable();
            $collection->string('worker_token')->unique();
            $collection->string('tele')->index();
            $collection->string('lang')->index();
            $collection->string('gender');
            $collection->string('city_id');
            $collection->string('address');
            $collection->string('map_location_lon');
            $collection->string('map_location_lat');
            /**/
            $collection->string('service_id')->index();
            $collection->string('worker_name')->index();
            $collection->string('worker_pic');
            $collection->string('worker_iqama_id');
            $collection->string('worker_iqama_pic');
            $collection->string('worker_nationality');
            /**/
            $collection->string('active');
            $collection->string('rate');
            $collection->timestamps();
            $collection->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection($this->connection)->table('worker', function(Blueprint $collection)
        {
            $collection->drop('worker');
        });
    }
}
