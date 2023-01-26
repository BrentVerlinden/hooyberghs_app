<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSensorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sensors', function (Blueprint $table) {
            $table->id();
//            $table->float('water_level')->nullable();
//            $table->timestamp('created_at')->useCurrent();
            $table->string('name')->nullable();
            $table->boolean('error')->nullable();
//            $table->foreignId('pump_id')->nullable();
            $table->foreignId('calibration_id')->nullable();
//            $table->foreign('pump_id')->references('id')->on('pumps')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('calibration_id')->references('id')->on('calibrations')->onDelete('cascade')->onUpdate('cascade');

        });

        DB::table('sensors')->insert(
            [
                [
                    'name' => 'Sensor 1',
                    'error' => false,
                    'calibration_id' => 1


                ],
                [

                    'name' => 'Sensor 2',
                    'error' => true,
                    'calibration_id' => 2
                ],
                [


                    'name' => 'Sensor 3',
                    'error' => true,
                    'calibration_id' => 3

                ],

                [

                    'name' => 'Sensor 4',
                    'error' => true,
                    'calibration_id' => 4
                ],[
                'name' => 'Sensor 5',
                'error' => false,
                'calibration_id' => 5

            ],

                [


                    'name' => 'Sensor 6',
                    'error' => false,
                    'calibration_id' => 6
                ]
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
        Schema::dropIfExists('sensors');
    }
}
