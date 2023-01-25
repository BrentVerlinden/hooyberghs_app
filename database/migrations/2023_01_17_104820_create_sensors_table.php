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
            $table->float('water_level')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->string('name')->nullable();
            $table->boolean('error')->nullable();
            $table->foreignId('pump_id')->nullable();
            $table->foreign('pump_id')->references('id')->on('pumps')->onDelete('cascade')->onUpdate('cascade');

        });

        DB::table('sensors')->insert(
            [
                [
                    'water_level' => 20,
                    'created_at' => '2021-01-01 00:00:01', 'error' => false,
                    'name' => 'Sensor 1',
                    'pump_id' => 1,
                ],
                [
                    'water_level' => 18,
                    'created_at' => '2021-01-01 00:00:02', 'error' => false,
                    'name' => 'Sensor 1',
                    'pump_id' => 1,
                ],
                [
                    'water_level' => 30,
                    'created_at' => '2021-01-01 00:00:03',
                    'error' => false,
                    'name' => 'Sensor 2',
                    'pump_id' => 2,
                ],

                [
                    'water_level' => 25,
                    'created_at' => '2021-01-01 00:00:03',
                    'error' => false,
                    'name' => 'Sensor 2',
                    'pump_id' => 2,
                ],[
                'water_level' => 30,
                'created_at' => '2021-01-01 00:00:03',
                'error' => false,
                'name' => 'Sensor 3',
                'pump_id' => 3,
            ],

                [
                    'water_level' => 25,
                    'created_at' => '2021-01-01 00:00:03',
                    'error' => false,
                    'name' => 'Sensor 3',
                    'pump_id' => 3,
                ],[
                'water_level' => 30,
                'created_at' => '2021-01-01 00:00:03',
                'error' => false,
                'name' => 'Sensor 4',
                'pump_id' => 4,
            ],

                [
                    'water_level' => 25,
                    'created_at' => '2021-01-01 00:00:03',
                    'error' => false,
                    'name' => 'Sensor 4',
                    'pump_id' => 4,
                ],[
                'water_level' => 30,
                'created_at' => '2021-01-01 00:00:03',
                'error' => false,
                'name' => 'Sensor 5',
                'pump_id' => 5,
            ],

                [
                    'water_level' => 25,
                    'created_at' => '2021-01-01 00:00:03',
                    'error' => false,
                    'name' => 'Sensor 5',
                    'pump_id' => 5,
                ],[
                'water_level' => 30,
                'created_at' => '2021-01-01 00:00:03',
                'error' => false,
                'name' => 'Sensor 6',
                'pump_id' => 6,
            ],

                [
                    'water_level' => 25,
                    'created_at' => '2021-01-01 00:00:03',
                    'error' => false,
                    'name' => 'Sensor 6',
                    'pump_id' => 6,
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
        Schema::dropIfExists('sensors');
    }
}
