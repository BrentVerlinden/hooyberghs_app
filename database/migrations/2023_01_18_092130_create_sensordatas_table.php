<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSensordatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sensordatas', function (Blueprint $table) {
            $table->id();
            $table->dateTime('time');
            $table->float('depth');
            $table->foreignId('sensor_id');
            $table->foreign('sensor_id')->references('id')->on('sensors')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });

        DB::table('sensordatas')->insert(
            [
                [
                    'time' => "2023-01-18 10:00",
                    'depth' => 5,
                    'sensor_id' => 1

                ],
                [
                    'time' => "2023-01-18 13:00",
                    'depth' => 8,
                    'sensor_id' => 1
                ],
                [
                    'time' => "2023-01-18 14:00",
                    'depth' => 2,
                    'sensor_id' => 1
                ],
                [
                    'time' => "2023-01-18 18:00",
                    'depth' => 9,
                    'sensor_id' => 1
                ],
                [
                    'time' => "2023-01-16 09:00",
                    'depth' => 4,
                    'sensor_id' => 2
                ]
                ,
                [
                    'time' => "2023-01-16 12:00",
                    'depth' => 1,
                    'sensor_id' => 2
                ],

                [
                    'time' => "2023-01-16 15:00",
                    'depth' => 15,
                    'sensor_id' => 2
                ],
                [
                    'time' => "2023-01-16 16:00",
                    'depth' => 10,
                    'sensor_id' => 2
                ],
                [
                    'time' => "2023-01-16 18:00",
                    'depth' => 5,
                    'sensor_id' => 2
                ],
                [
                    'time' => "2023-01-10 08:00",
                    'depth' => 1,
                    'sensor_id' => 3
                ],
                [
                    'time' => "2023-01-10 10:00",
                    'depth' => 8,
                    'sensor_id' => 3
                ],
                [
                    'time' => "2023-01-10 12:00",
                    'depth' => 9,
                    'sensor_id' => 3
                ],
                [
                    'time' => "2023-01-10 14:00",
                    'depth' => 18,
                    'sensor_id' => 3
                ],
                [
                    'time' => "2023-01-10 15:00",
                    'depth' => 6,
                    'sensor_id' => 3
                ],
                [
                    'time' => "2023-01-10 18:00",
                    'depth' => 10,
                    'sensor_id' => 3
                ],
                [
                    'time' => "2023-02-01 10:00",
                    'depth' => 20,
                    'sensor_id' => 4
                ],
                [
                    'time' => "2023-02-01 12:00",
                    'depth' => 10,
                    'sensor_id' => 4
                ],
                [
                    'time' => "2023-02-01 14:00",
                    'depth' => 5,
                    'sensor_id' => 4
                ],
                [
                    'time' => "2023-02-01 16:00",
                    'depth' => 1,
                    'sensor_id' => 4
                ],
                [
                    'time' => "2023-02-01 17:00",
                    'depth' => 3,
                    'sensor_id' => 4
                ],
                [
                    'time' => "2023-02-01 18:00",
                    'depth' => 18,
                    'sensor_id' => 4
                ],
                [
                    'time' => "2023-03-01 08:00",
                    'depth' => 10,
                    'sensor_id' => 5
                ],
                [
                    'time' => "2023-03-01 10:00",
                    'depth' => 18,
                    'sensor_id' => 4
                ],
                [
                    'time' => "2023-03-01 12:00",
                    'depth' => 6,
                    'sensor_id' => 4
                ],
                [
                    'time' => "2023-03-01 13:00",
                    'depth' => 1,
                    'sensor_id' => 4
                ],
                [
                    'time' => "2023-03-01 18:00",
                    'depth' => 12,
                    'sensor_id' => 4
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
        Schema::dropIfExists('sensordatas');
    }
}
