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
            $table->time('time')->nullable(); //andere variable?
            $table->float('min')->nullable();
            $table->float('max')->nullable();
            //Foreign keys --> moet nog aangepast worden

        });

        // 1 werf = 1 calibration

        DB::table('calibrations')->insert(
            [
                [
                    'time' => 10,
                    'min' => 3,
                    'max' => 10
                ],
                [
                    'time' => 10,
                    'min' => 5,
                    'max' => 15
                ],
                [
                    'time' => 5,
                    'min' => 1,
                    'max' => 6
                ],
                [
                    'time' => 10,
                    'min' => 6,
                    'max' => 16
                ],
                [
                    'time' => 9,
                    'min' => 10,
                    'max' => 16
                ],
                [
                    'time' => 9,
                    'min' => 6,
                    'max' => 16
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
