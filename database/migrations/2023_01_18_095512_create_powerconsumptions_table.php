<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePowerconsumptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('powerconsumptions', function (Blueprint $table) {
            $table->id();
            $table->dateTime('time');
            $table->float('power');
            $table->foreignId('pump_id');
            $table->foreign('pump_id')->references('id')->on('pumps')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });

        DB::table('powerconsumptions')->insert(
            [
                [
                    'time' => "2023-01-18 10:00",
                    'power' => 2000,
                    'pump_id' => 1

                ],
                [
                    'time' => "2023-01-18 10:00",
                    'power' => 3000,
                    'pump_id' => 1
                ],
                [
                    'time' => "2023-01-18 10:00",
                    'power' => 2000,
                    'pump_id' => 1
                ],
                [
                    'time' => "2023-01-18 10:00",
                    'power' => 5000,
                    'pump_id' => 1
                ],
                [
                    'time' => "2023-01-16 09:00",
                    'power' => 2000,
                    'pump_id' => 2
                ]
                ,
                [
                    'time' => "2023-01-16 09:00",
                    'power' => 3000,
                    'pump_id' => 2
                ],

                [
                    'time' => "2023-01-16 09:00",
                    'power' => 1000,
                    'pump_id' => 2
                ],
                [
                    'time' => "2023-01-16 09:00",
                    'power' => 6000,
                    'pump_id' => 2
                ],
                [
                    'time' => "2023-01-16 09:00",
                    'power' => 4000,
                    'pump_id' => 2
                ],
                [
                    'time' => "2023-01-10 08:00",
                    'power' => 1000,
                    'pump_id' => 3
                ],
                [
                    'time' => "2023-01-10 08:00",
                    'power' => 1000,
                    'pump_id' => 3
                ],
                [
                    'time' => "2023-01-10 08:00",
                    'power' => 2500,
                    'pump_id' => 3
                ],
                [
                    'time' => "2023-01-10 08:00",
                    'power' => 3000,
                    'pump_id' => 3
                ],
                [
                    'time' => "2023-01-10 08:00",
                    'power' => 6000,
                    'pump_id' => 3
                ],
                [
                    'time' => "2023-01-10 08:00",
                    'power' => 5000,
                    'pump_id' => 3
                ],
                [
                    'time' => "2023-02-01 10:00",
                    'power' => 1000,
                    'pump_id' => 4
                ],
                [
                    'time' => "2023-02-01 10:00",
                    'power' => 6000,
                    'pump_id' => 4
                ],
                [
                    'time' => "2023-02-01 10:00",
                    'power' => 3000,
                    'pump_id' => 4
                ],
                [
                    'time' => "2023-02-01 10:00",
                    'power' => 1500,
                    'pump_id' => 4
                ],
                [
                    'time' => "2023-02-01 10:00",
                    'power' => 3500,
                    'pump_id' => 4
                ],
                [
                    'time' => "2023-02-01 10:00",
                    'power' => 2500,
                    'pump_id' => 4
                ],
                [
                    'time' => "2023-03-01 08:00",
                    'power' => 0,
                    'pump_id' => 5
                ],
                [
                    'time' => "2023-03-01 08:00",
                    'power' => 0,
                    'pump_id' => 5
                ],
                [
                    'time' => "2023-03-01 08:00",
                    'power' => 0,
                    'pump_id' => 5
                ],
                [
                    'time' => "2023-03-01 08:00",
                    'power' => 0,
                    'pump_id' => 5
                ],
                [
                    'time' => "2023-03-01 08:00",
                    'power' => 0,
                    'pump_id' => 5
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
        Schema::dropIfExists('powerconsumptions');
    }
}
