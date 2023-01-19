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
            $table->json('power');
            $table->foreignId('pump_id');
            $table->foreign('pump_id')->references('id')->on('pumps')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });

        DB::table('powerconsumptions')->insert(
            [
                [
                    'power' => json_encode([
                        ['power' => 2000, 'time' => '2023-01-18 11:00'],
                        ['power' => 2050, 'time' => '2023-01-18 11:15'],
                        ['power' => 2100, 'time' => '2023-01-18 11:30'],
                        ['power' => 2150, 'time' => '2023-01-18 11:45'],
                        ['power' => 2200, 'time' => '2023-01-18 12:00'],
                        ['power' => 2250, 'time' => '2023-01-18 12:15'],['power' => 2300, 'time' => '2023-01-18 12:30'], ['power' => 2350, 'time' => '2023-01-18 12:45'],
                        ['power' => 2400, 'time' => '2023-01-18 13:00'], ['power' => 2450, 'time' => '2023-01-18 13:15'], ['power' => 2500, 'time' => '2023-01-19 11:00'],
                        ['power' => 2550, 'time' => '2023-01-19 11:15'], ['power' => 2600, 'time' => '2023-01-19 11:30'], ['power' => 2650, 'time' => '2023-01-19 11:45'], ['power' => 2700, 'time' => '2023-01-19 12:00'],
                        ['power' => 2750, 'time' => '2023-01-19 12:15'], ['power' => 2800, 'time' => '2023-01-19 12:30'], ['power' => 2850, 'time' => '2023-01-19 12:45'], ['power' => 2900, 'time' => '2023-01-19 13:00'], ['power' => 2950, 'time' => '2023-01-19 13:15'], ['power' => 3000, 'time' => '2023-01-20 11:00'],
                        ['power' => 3050, 'time' => '2023-01-20 11:15'],
                        ['power' => 3100, 'time' => '2023-01-20 11:30'], ['power' => 3150, 'time' => '2023-01-20 11:45'], ['power' => 3200, 'time' => '2023-01-20 12:00'], ['power' => 3250, 'time' => '2023-01-20 12:15'],
                        ['power' => 3300, 'time' => '2023-01-20 12:30'],
                        ['power' => 3350, 'time' => '2023-01-20 12:45'], ['power' => 3400, 'time' => '2023-01-20 13:00'], ['power' => 3500, 'time' => '2023-01-20 13:15'],
                        ['power' => 3550, 'time' => '2023-01-20 13:30'], ['power' => 3600, 'time' => '2023-01-20 13:45'],
                        ['power' => 3650, 'time' => '2023-01-20 14:00'],
                        ['power' => 3700, 'time' => '2023-01-20 14:15'],
                        ['power' => 3750, 'time' => '2023-01-20 14:30'], ['power' => 3800, 'time' => '2023-01-20 14:45'],
                        ['power' => 3850, 'time' => '2023-01-20 15:00'],
                        ['power' => 3900, 'time' => '2023-01-20 15:15'], ['power' => 3950, 'time' => '2023-01-20 15:30'],
                        ['power' => 4000, 'time' => '2023-01-20 15:45'], ['power' => 4050, 'time' => '2023-01-20 16:00'], ['power' => 4100, 'time' => '2023-01-20 16:15'],
                        ['power' => 4150, 'time' => '2023-01-20 16:30'], ['power' => 4200, 'time' => '2023-01-20 16:45'], ['power' => 4250, 'time' => '2023-01-20 17:00'], ['power' => 4300, 'time' => '2023-01-20 17:15'], ['power' => 4350, 'time' => '2023-01-20 17:30'],
                        ['power' => 4400, 'time' => '2023-01-20 17:45'], ['power' => 4450, 'time' => '2023-01-20 18:00'],
                    ]),
                    'pump_id' => 1
                ],
                [
                    'power' => json_encode([
                        ['power' => 2000, 'time' => '2023-01-18 11:00'], ['power' => 2000, 'time' => '2023-01-18 09:00'],
                        ['power' => 3000, 'time' => '2023-01-18 10:00'], ['power' => 1000, 'time' => '2023-01-18 09:00'],
                        ['power' => 1500, 'time' => '2023-01-18 10:00']
                    ]),
                    'pump_id' => 2
                ],
                [
                    'power' => json_encode([
                        ['power' => 400, 'time' => '2023-01-18 09:00'],
                        ['power' => 800, 'time' => '2023-01-18 10:00'], ['power' => 400, 'time' => '2023-01-18 09:00'],
                        ['power' => 800, 'time' => '2023-01-18 10:00'], ['power' => 400, 'time' => '2023-01-18 09:00'],
                        ['power' => 800, 'time' => '2023-01-18 10:00']
                    ]),
                    'pump_id' => 3
                ],
                [
                    'power' => json_encode([
                        ['power' => 2000, 'time' => '2023-01-18 11:00'],
                        ['power' => 400, 'time' => '2023-01-18 09:00'],
                        ['power' => 800, 'time' => '2023-01-18 10:00'],
                        ['power' => 400, 'time' => '2023-01-18 09:00'],
                        ['power' => 800, 'time' => '2023-01-18 10:00']
                    ]),
                    'pump_id' => 4
                ], [
                'power' => json_encode([
                    ['power' => 400, 'time' => '2023-01-18 09:00'],
                    ['power' => 800, 'time' => '2023-01-18 10:00'],
                    ['power' => 400, 'time' => '2023-01-18 09:00'],
                    ['power' => 800, 'time' => '2023-01-18 10:00']
                ]),
                'pump_id' => 5
            ],
                [
                    'power' => json_encode([
                        ['power' => 2000, 'time' => '2023-01-18 11:00'],
                        ['power' => 2000, 'time' => '2023-01-18 12:00'],
                        ['power' => 2000, 'time' => '2023-01-18 13:00'],
                        ['power' => 2000, 'time' => '2023-01-18 14:00'],
                    ]),
                    'pump_id' => 6
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
        Schema::dropIfExists('powerconsumptions');
    }
}
