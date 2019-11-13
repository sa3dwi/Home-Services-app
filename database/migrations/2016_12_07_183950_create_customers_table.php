<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * The name of the database connection to use.
     *
     * @var string
     */
    protected $connection = 'mongodb';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection($this->connection)->table('customers', function(Blueprint $collection)
        {
            $collection->string('name')->index();
            $collection->string('email')->unique();
            $collection->string('username')->unique();
            $collection->string('password');
            $collection->string('tele');
            $collection->string('address');
            $collection->string('map_location');
            $collection->string('city_id');
            $collection->timestamp();
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
        Schema::connection($this->connection)->table('customers', function(Blueprint $collection)
        {
            $collection->drop('customers');
        });
    }

}
