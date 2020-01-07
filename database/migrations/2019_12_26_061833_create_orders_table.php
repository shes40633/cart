<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('order_no');

            $table->string('recipient_name');
            $table->string('recipient_phone');
            $table->string('recipient_cellphone');
            $table->string('recipient_adress');
            $table->string('recipient_email');
            $table->string('invoice');
            $table->string('input_time');
            $table->string('status')->default('新訂單');
            $table->string('recipient_remark')->nullable();
            $table->string('totalprice');

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
        Schema::dropIfExists('orders');
    }
}
