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
            $table->json('verbruik');
            $table->foreignId('pump_id');
            $table->float('stroom');
            $table->foreign('pump_id')->references('id')->on('pumps')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });

        DB::table('powerconsumptions')->insert(
            [
                [
                    'verbruik' => json_encode([
                        ['verbruik' => 2000, 'time' => '2023-01-18 11:00'],
                        ['verbruik' => 2050, 'time' => '2023-01-18 11:15'],
                        ['verbruik' => 2100, 'time' => '2023-01-18 11:30'],
                        ['verbruik' => 2150, 'time' => '2023-01-18 11:45'],
                        ['verbruik' => 2200, 'time' => '2023-01-18 12:00'],
                        ['verbruik' => 2250, 'time' => '2023-01-18 12:15'],['verbruik' => 2300, 'time' => '2023-01-18 12:30'], ['verbruik' => 2350, 'time' => '2023-01-18 12:45'],
                        ['verbruik' => 2400, 'time' => '2023-01-18 13:00'], ['verbruik' => 2450, 'time' => '2023-01-18 13:15'], ['verbruik' => 2500, 'time' => '2023-01-19 11:00'],
                        ['verbruik' => 2550, 'time' => '2023-01-19 11:15'], ['verbruik' => 2600, 'time' => '2023-01-19 11:30'], ['verbruik' => 2650, 'time' => '2023-01-19 11:45'], ['verbruik' => 2700, 'time' => '2023-01-19 12:00'],
                        ['verbruik' => 2750, 'time' => '2023-01-19 12:15'], ['verbruik' => 2800, 'time' => '2023-01-19 12:30'], ['verbruik' => 2850, 'time' => '2023-01-19 12:45'], ['verbruik' => 2900, 'time' => '2023-01-19 13:00'], ['verbruik' => 2950, 'time' => '2023-01-19 13:15'], ['verbruik' => 3000, 'time' => '2023-01-20 11:00'],
                        ['verbruik' => 3050, 'time' => '2023-01-20 11:15'],
                        ['verbruik' => 3100, 'time' => '2023-01-20 11:30'], ['verbruik' => 3150, 'time' => '2023-01-20 11:45'], ['verbruik' => 3200, 'time' => '2023-01-20 12:00'], ['verbruik' => 3250, 'time' => '2023-01-20 12:15'],
                        ['verbruik' => 3300, 'time' => '2023-01-20 12:30'],
                        ['verbruik' => 3350, 'time' => '2023-01-20 12:45'], ['verbruik' => 3400, 'time' => '2023-01-20 13:00'], ['verbruik' => 3500, 'time' => '2023-01-20 13:15'],
                        ['verbruik' => 3550, 'time' => '2023-01-20 13:30'], ['verbruik' => 3600, 'time' => '2023-01-20 13:45'],
                        ['verbruik' => 3650, 'time' => '2023-01-20 14:00'],
                        ['verbruik' => 3700, 'time' => '2023-01-20 14:15'],
                        ['verbruik' => 3750, 'time' => '2023-01-20 14:30'], ['verbruik' => 3800, 'time' => '2023-01-20 14:45'],
                        ['verbruik' => 3850, 'time' => '2023-01-20 15:00'],
                        ['verbruik' => 3900, 'time' => '2023-01-20 15:15'], ['verbruik' => 3950, 'time' => '2023-01-20 15:30'],
                        ['verbruik' => 4000, 'time' => '2023-01-20 15:45'], ['verbruik' => 4050, 'time' => '2023-01-20 16:00'], ['verbruik' => 4100, 'time' => '2023-01-20 16:15'],
                        ['verbruik' => 4150, 'time' => '2023-01-20 16:30'], ['verbruik' => 4200, 'time' => '2023-01-20 16:45'], ['verbruik' => 4250, 'time' => '2023-01-20 17:00'], ['verbruik' => 4300, 'time' => '2023-01-20 17:15'], ['verbruik' => 4350, 'time' => '2023-01-20 17:30'],
                        ['verbruik' => 4400, 'time' => '2023-01-20 17:45'], ['verbruik' => 4450, 'time' => '2023-01-20 18:00'],
                    ]),
                    'pump_id' => 1,
                    'stroom' => 50
                ],
                [
                    'verbruik' => json_encode([
                        ['verbruik' => 2000, 'time' => '2023-01-18 11:00'], ['verbruik' => 2000, 'time' => '2023-01-18 09:00'],
                        ['verbruik' => 3000, 'time' => '2023-01-18 10:00'], ['verbruik' => 1000, 'time' => '2023-01-18 09:00'],
                        ['verbruik' => 1500, 'time' => '2023-01-18 10:00']
                    ]),
                    'pump_id' => 2,
                    'stroom' => 25
                ],
                [
                    'verbruik' => json_encode([
                        ['verbruik' => 400, 'time' => '2023-01-18 09:00'],
                        ['verbruik' => 800, 'time' => '2023-01-18 10:00'], ['verbruik' => 400, 'time' => '2023-01-18 09:00'],
                        ['verbruik' => 800, 'time' => '2023-01-18 10:00'], ['verbruik' => 400, 'time' => '2023-01-18 09:00'],
                        ['verbruik' => 800, 'time' => '2023-01-18 10:00']
                    ]),
                    'pump_id' => 3,
                    'stroom' => 30
                ],
                [
                    'verbruik' => json_encode([
                        ['verbruik' => 2000, 'time' => '2023-01-18 11:00'],
                        ['verbruik' => 400, 'time' => '2023-01-18 09:00'],
                        ['verbruik' => 800, 'time' => '2023-01-18 10:00'],
                        ['verbruik' => 400, 'time' => '2023-01-18 09:00'],
                        ['verbruik' => 800, 'time' => '2023-01-18 10:00']
                    ]),
                    'pump_id' => 4,
                    'stroom' => 5
                ], [
                'verbruik' => json_encode([
                    ['verbruik' => 400, 'time' => '2023-01-18 09:00'],
                    ['verbruik' => 800, 'time' => '2023-01-18 10:00'],
                    ['verbruik' => 400, 'time' => '2023-01-18 09:00'],
                    ['verbruik' => 800, 'time' => '2023-01-18 10:00']
                ]),
                'pump_id' => 5,
                'stroom' => 15
            ],
                [
                    'verbruik' => json_encode([
                        ['verbruik' => 2000, 'time' => '2023-01-18 11:00'],
                        ['verbruik' => 2000, 'time' => '2023-01-18 12:00'],
                        ['verbruik' => 2000, 'time' => '2023-01-18 13:00'],
                        ['verbruik' => 2000, 'time' => '2023-01-18 14:00'],
                    ]),
                    'pump_id' => 6,
                    'stroom' => 30
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
