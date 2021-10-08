<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('labels', function (Blueprint $table) {
            $table->id();
            $table->string('item_description');
            $table->string('patient_name');
            $table->date('order_date');
            $table->string('dispensing_note_no');
            $table->integer('dose_quantity');
            $table->string('uom_dosage_code');
            $table->string('instruction');
            $table->string('frequency');
            $table->string('duration');
            $table->integer('quantity');
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
        Schema::connection('mysql')->dropIfExists('labels');
    }
}
