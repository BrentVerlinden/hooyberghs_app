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
            $table->boolean('error');
        });


        DB::table('sensors')->insert(
            [
                [
                    'data' => json_encode([                        ['data' => 1, 'time' => '2023-01-18 11:00'],
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
                    'error' => false
                ],
                [
                    'data' => json_encode([                        ['data' => 1, 'time' => '2023-01-18 11:00'],
                        ['data' => 2, 'time' => '2023-01-18 11:15'],
                        ['data' => 3, 'time' => '2023-01-18 11:30'],
                        ['data' => 4, 'time' => '2023-01-18 11:45'],
                        ['data' => 5, 'time' => '2023-01-18 12:00'],
                    ]),
                    'error' => false
                ],
                [
                    'data' => json_encode([                        ['data' => 1, 'time' => '2023-01-18 11:00'],
                        ['data' => 2, 'time' => '2023-01-18 11:15'],
                        ['data' => 3, 'time' => '2023-01-18 11:30'],
                        ['data' => 4, 'time' => '2023-01-18 11:45'],
                        ['data' => 5, 'time' => '2023-01-18 12:00'],
                        ['data' => 6, 'time' => '2023-01-18 12:15'],
                        ['data' => 7, 'time' => '2023-01-18 12:30'],
                    ]),
                    'error' => false
                ],
                [
                    'data' => json_encode([                        ['data' => 1, 'time' => '2023-01-18 11:00'],
                        ['data' => 2, 'time' => '2023-01-18 11:15'],
                        ['data' => 3, 'time' => '2023-01-18 11:30'],
                        ['data' => 4, 'time' => '2023-01-18 11:45'],
                        ['data' => 5, 'time' => '2023-01-18 12:00'],
                        ['data' => 6, 'time' => '2023-01-18 12:15'],
                        ['data' => 7, 'time' => '2023-01-18 12:30'],
                        ['data' => 8, 'time' => '2023-01-18 12:45'],
                        ['data' => 20, 'time' => '2023-01-19 13:15'],
                    ]),
                    'error' => true
                ], [
                'data' => json_encode([                        ['data' => 1, 'time' => '2023-01-18 11:00'],
                    ['data' => 2, 'time' => '2023-01-18 11:15'],
                    ['data' => 3, 'time' => '2023-01-18 11:30'],
                    ['data' => 4, 'time' => '2023-01-18 11:45'],
                    ['data' => 5, 'time' => '2023-01-18 12:00'],
                    ['data' => 6, 'time' => '2023-01-18 12:15'],
                    ['data' => 7, 'time' => '2023-01-18 12:30'],
                    ['data' => 8, 'time' => '2023-01-18 12:45'],
                ]),
                'error' => true
            ],
                [
                    'data' => json_encode([                        ['data' => 1, 'time' => '2023-01-18 11:00'],
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
                    'error' => false
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
