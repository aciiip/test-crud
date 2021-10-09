<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateLabelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->table('labels', function (Blueprint $table) {
            $table->dropColumn('dose_quantity');
            $table->dropColumn('uom_dosage_code');
            $table->dropColumn('instruction');
            $table->dropColumn('frequency');
            $table->string('prescription_instruction')->after('quantity');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql')->table('labels', function (Blueprint $table) {
            $table->dropColumn('prescription_instruction');
            $table->string('frequency')->after('quantity');
            $table->string('instruction')->after('quantity');
            $table->string('uom_dosage_code')->after('quantity');
            $table->integer('dose_quantity')->after('quantity');
        });
    }
}
