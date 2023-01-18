<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlowratesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flowrates', function (Blueprint $table) {
            $table->id();
            $table->dateTime('time');
            $table->float('flowrate');
            $table->foreignId('pump_id');
            $table->foreign('pump_id')->references('id')->on('pumps')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });

        DB::table('flowrates')->insert(
            [
                [
                    'time' => "2023-01-18 10:00",
                    'flowrate' => 3,
                    'pump_id' => 1

                ],
                [
                    'time' => "2023-01-18 10:00",
                    'flowrate' => 3,
                    'pump_id' => 1
                ],
                [
                    'time' => "2023-01-18 10:00",
                    'flowrate' => 4,
                    'pump_id' => 1
                ],
                [
                    'time' => "2023-01-18 10:00",
                    'flowrate' => 5,
                    'pump_id' => 1
                ],
                [
                    'time' => "2023-01-16 09:00",
                    'flowrate' => 2,
                    'pump_id' => 2
                ]
                ,
                [
                    'time' => "2023-01-16 09:00",
                    'flowrate' => 3,
                    'pump_id' => 2
                ],

                [
                    'time' => "2023-01-16 09:00",
                    'flowrate' => 3,
                    'pump_id' => 2
                ],
                [
                    'time' => "2023-01-16 09:00",
                    'flowrate' => 4,
                    'pump_id' => 2
                ],
                [
                    'time' => "2023-01-16 09:00",
                    'flowrate' => 5,
                    'pump_id' => 2
                ],
                [
                    'time' => "2023-01-10 08:00",
                    'flowrate' => 2,
                    'pump_id' => 3
                ],
                [
                    'time' => "2023-01-10 08:00",
                    'flowrate' => 6,
                    'pump_id' => 3
                ],
                [
                    'time' => "2023-01-10 08:00",
                    'flowrate' => 7,
                    'pump_id' => 3
                ],
                [
                    'time' => "2023-01-10 08:00",
                    'flowrate' => 8,
                    'pump_id' => 3
                ],
                [
                    'time' => "2023-01-10 08:00",
                    'flowrate' => 2,
                    'pump_id' => 3
                ],
                [
                    'time' => "2023-01-10 08:00",
                    'flowrate' => 4,
                    'pump_id' => 3
                ],
                [
                    'time' => "2023-02-01 10:00",
                    'flowrate' => 6,
                    'pump_id' => 4
                ],
                [
                    'time' => "2023-02-01 10:00",
                    'flowrate' => 8,
                    'pump_id' => 4
                ],
                [
                    'time' => "2023-02-01 10:00",
                    'flowrate' => 10,
                    'pump_id' => 4
                ],
                [
                    'time' => "2023-02-01 10:00",
                    'flowrate' => 5,
                    'pump_id' => 4
                ],
                [
                    'time' => "2023-02-01 10:00",
                    'flowrate' => 2,
                    'pump_id' => 4
                ],
                [
                    'time' => "2023-02-01 10:00",
                    'flowrate' => 4,
                    'pump_id' => 4
                ],
                [
                    'time' => "2023-03-01 08:00",
                    'flowrate' => 5,
                    'pump_id' => 5
                ],
                [
                    'time' => "2023-03-01 08:00",
                    'flowrate' => 0,
                    'pump_id' => 5
                ],
                [
                    'time' => "2023-03-01 08:00",
                    'flowrate' => 1,
                    'pump_id' => 5
                ],
                [
                    'time' => "2023-03-01 08:00",
                    'flowrate' => 0,
                    'pump_id' => 5
                ],
                [
                    'time' => "2023-03-01 08:00",
                    'flowrate' => 0,
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
        Schema::dropIfExists('flowrates');
    }
}
