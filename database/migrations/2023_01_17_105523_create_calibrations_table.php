<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalibrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calibrations', function (Blueprint $table) {
            $table->id();
            $table->dateTime('startDate')->nullable();
            $table->dateTime('endDate')->nullable();
            $table->time('time')->nullable(); //andere variable?
            $table->foreignId('werf_id');
            $table->float('min')->nullable();
            $table->float('max')->nullable();
            //Foreign keys --> moet nog aangepast worden
            $table->foreign('werf_id')->references('id')->on('werves')->onDelete('cascade')->onUpdate('cascade');
        });

        // 1 werf = 1 calibration

        DB::table('calibrations')->insert(
            [
                [
                    'startDate' => '2023-01-16',
                    'endDate' => '2023-04-22',
                    'time' => 10,
                    'werf_id' => 1,
                    'min' => 3,
                    'max' => 10
                ],
            ]
        );

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calibrations');
    }
}
