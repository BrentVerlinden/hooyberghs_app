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

            $table->json('flowrate');
            $table->foreignId('pump_id');
            $table->foreign('pump_id')->references('id')->on('pumps')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });

        DB::table('flowrates')->insert(
            [
                [
                    'flowrate' => json_encode([
                        ['flowrate' => 2000, 'time' => '2023-01-18 11:00'],
                        ['flowrate' => 2050, 'time' => '2023-01-18 11:15'],
                        ['flowrate' => 2100, 'time' => '2023-01-18 11:30'],
                        ['flowrate' => 2150, 'time' => '2023-01-18 11:45'],
                        ['flowrate' => 2200, 'time' => '2023-01-18 12:00'],
                        ['flowrate' => 2250, 'time' => '2023-01-18 12:15'],['flowrate' => 2300, 'time' => '2023-01-18 12:30'], ['flowrate' => 2350, 'time' => '2023-01-18 12:45'],
                        ['flowrate' => 2400, 'time' => '2023-01-18 13:00'], ['flowrate' => 2450, 'time' => '2023-01-18 13:15'], ['flowrate' => 2500, 'time' => '2023-01-19 11:00'],
                        ['flowrate' => 2550, 'time' => '2023-01-19 11:15'], ['flowrate' => 2600, 'time' => '2023-01-19 11:30'], ['flowrate' => 2650, 'time' => '2023-01-19 11:45'], ['flowrate' => 2700, 'time' => '2023-01-19 12:00'],
                        ['flowrate' => 2750, 'time' => '2023-01-19 12:15'], ['flowrate' => 2800, 'time' => '2023-01-19 12:30'], ['flowrate' => 2850, 'time' => '2023-01-19 12:45'], ['flowrate' => 2900, 'time' => '2023-01-19 13:00'], ['flowrate' => 2950, 'time' => '2023-01-19 13:15'],              ]),
                    'pump_id' => 1
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
