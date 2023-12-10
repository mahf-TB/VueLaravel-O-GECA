<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistrictesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('districtes', function (Blueprint $table) {
            $table->string('districte_code',50)->primary();
            $table->string('districte_libelle');
            $table->string('code_region',50);
            $table->foreign('code_region')->references('region_code')->on('regions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('districtes');
    }
}
