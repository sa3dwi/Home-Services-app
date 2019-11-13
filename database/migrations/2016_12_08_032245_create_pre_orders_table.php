<?php

use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreOrdersTable extends Migration
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
        Schema::connection($this->connection)->table('pre_orders', function(Blueprint $collection)
        {
            $collection->string('order_id');
            $collection->string('customer_id');
            $collection->string('worker_id');
            $collection->string('accept');
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
        Schema::connection($this->connection)->table('pre_orders', function(Blueprint $collection)
        {
            $collection->drop('pre_orders');
        });
    }
}
