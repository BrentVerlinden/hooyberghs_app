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
            $table->json('data')->nullable();

            $table->string('name');

            $table->boolean('error');
            $table->foreignId('pump_id');
            $table->foreign('pump_id')->references('id')->on('pumps')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });


        DB::table('sensors')->insert(
            [
                [
                    'data' => json_encode([                        ['data' => 30, 'time' => '2023-01-18 11:00'],
                        ['data' => 2, 'time' => '2023-01-18 11:15'],
                        ['data' => 3, 'time' => '2023-01-18 11:30'],
                        ['data' => 4, 'time' => '2023-01-18 11:45'],
                        ['data' => 5, 'time' => '2023-01-18 12:00'],
                        ['data' => 6, 'time' => '2023-01-18 12:15'],
                        ['data' => 7, 'time' => '2023-01-18 12:30'],
                        ['data' => 8, 'time' => '2023-01-18 12:45'],
                        ['data' => 9, 'time' => '2023-01-18 13:00'],
                        ['data' => 10, 'time' => '2023-01-18 13:15'],
                        ['data' => 11, 'time' => '2023-01-19 11:00'],
                        ['data' => 12, 'time' => '2023-01-19 11:15'],
                        ['data' => 13, 'time' => '2023-01-19 11:30'],
                        ['data' => 14, 'time' => '2023-01-19 11:45'],
                        ['data' => 15, 'time' => '2023-01-19 12:00'],
                        ['data' => 16, 'time' => '2023-01-19 12:15'],
                        ['data' => 17, 'time' => '2023-01-19 12:30'],
                        ['data' => 18, 'time' => '2023-01-19 12:45'],
                        ['data' => 19, 'time' => '2023-01-19 13:00'],
                        ['data' => 20, 'time' => '2023-01-19 13:15'],
                    ]),
                    'error' => false,
                    'name' => 'Sensor 1',
                    'pump_id' => 1,
                ],
                [
                    'data' => json_encode([                        ['data' => 20, 'time' => '2023-01-18 11:00'],
                        ['data' => 2, 'time' => '2023-01-18 11:15'],
                        ['data' => 3, 'time' => '2023-01-18 11:30'],
                        ['data' => 4, 'time' => '2023-01-18 11:45'],
                        ['data' => 5, 'time' => '2023-01-18 12:00'],
                    ]),
                    'error' => false,
                    'name' => 'Sensor 2',
                    'pump_id' => 2,
                ],
                [
                    'data' => json_encode([                        ['data' => 50, 'time' => '2023-01-18 11:00'],
                        ['data' => 2, 'time' => '2023-01-18 11:15'],
                        ['data' => 3, 'time' => '2023-01-18 11:30'],
                        ['data' => 4, 'time' => '2023-01-18 11:45'],
                        ['data' => 5, 'time' => '2023-01-18 12:00'],
                        ['data' => 6, 'time' => '2023-01-18 12:15'],
                        ['data' => 7, 'time' => '2023-01-18 12:30'],
                    ]),
                    'error' => false,
                    'name' => 'Sensor 3',
                    'pump_id' => 3,
                ],
                [
                    'data' => json_encode([                        ['data' =>60, 'time' => '2023-01-18 11:00'],
                        ['data' => 2, 'time' => '2023-01-18 11:15'],
                        ['data' => 3, 'time' => '2023-01-18 11:30'],
                        ['data' => 4, 'time' => '2023-01-18 11:45'],
                        ['data' => 5, 'time' => '2023-01-18 12:00'],
                        ['data' => 6, 'time' => '2023-01-18 12:15'],
                        ['data' => 7, 'time' => '2023-01-18 12:30'],
                        ['data' => 8, 'time' => '2023-01-18 12:45'],
                        ['data' => 20, 'time' => '2023-01-19 13:15'],
                    ]),
                    'error' => true,'name' => 'Sensor 4',
                    'pump_id' => 4,
                ], [
                'data' => json_encode([                        ['data' => 20, 'time' => '2023-01-18 11:00'],
                    ['data' => 2, 'time' => '2023-01-18 11:15'],
                    ['data' => 3, 'time' => '2023-01-18 11:30'],
                    ['data' => 4, 'time' => '2023-01-18 11:45'],
                    ['data' => 5, 'time' => '2023-01-18 12:00'],
                    ['data' => 6, 'time' => '2023-01-18 12:15'],
                    ['data' => 7, 'time' => '2023-01-18 12:30'],
                    ['data' => 8, 'time' => '2023-01-18 12:45'],
                ]),
                'error' => true,'name' => 'Sensor 5',
                'pump_id' => 5,
            ],
                [
                    'data' => json_encode([
                        ['data' => 25, 'time' => '2023-01-18 11:00'],
                        ['data' => 2, 'time' => '2023-01-18 11:15'],
                        ['data' => 3, 'time' => '2023-01-18 11:30'],
                        ['data' => 4, 'time' => '2023-01-18 11:45'],
                        ['data' => 5, 'time' => '2023-01-18 12:00'],
                        ['data' => 6, 'time' => '2023-01-18 12:15'],
                        ['data' => 7, 'time' => '2023-01-18 12:30'],
                        ['data' => 8, 'time' => '2023-01-18 12:45'],
                        ['data' => 9, 'time' => '2023-01-18 13:00'],
                        ['data' => 10, 'time' => '2023-01-18 13:15'],
                    ]),
                    'error' => false,'name' => 'Sensor 6',
                    'pump_id' => 6,
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
