<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('item_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('reference_no');
            $table->integer('item_id');
            $table->string('transaction_type');
            $table->integer('quantity');
            $table->float('unit_price');
            $table->date('date');
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
        Schema::connection('mysql')->dropIfExists('item_transactions');
    }
}
