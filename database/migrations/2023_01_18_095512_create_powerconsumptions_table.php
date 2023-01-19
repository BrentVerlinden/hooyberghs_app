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
                        ['power'=>400, 'time'=>'09:00'],
                        ['power'=>800, 'time'=>'10:00'],
                        ['power'=>200, 'time'=>'11:00'],
                        ['power'=>900, 'time'=>'12:00'],
                        ['power'=>600, 'time'=>'13:00'],
                        ['power'=>500, 'time'=>'14:00']
                    ]),
                    'pump_id' => 1
                ],
                [
                    'power' => json_encode([
                        ['power'=>2000, 'time'=>'2023-01-18 11:00'],['power'=>2000, 'time'=>'2023-01-18 09:00'],
                        ['power'=>3000, 'time'=>'2023-01-18 10:00'],['power'=>1000, 'time'=>'2023-01-18 09:00'],
                        ['power'=>1500, 'time'=>'2023-01-18 10:00']
                    ]),
                    'pump_id' => 2
                ],
                [
                    'power' => json_encode([
                        ['power'=>400, 'time'=>'2023-01-18 09:00'],
                        ['power'=>800, 'time'=>'2023-01-18 10:00'],['power'=>400, 'time'=>'2023-01-18 09:00'],
                            ['power'=>800, 'time'=>'2023-01-18 10:00'],['power'=>400, 'time'=>'2023-01-18 09:00'],
                            ['power'=>800, 'time'=>'2023-01-18 10:00']
                    ]),
                    'pump_id' => 3
                ],
                [
                    'power' => json_encode([
                        ['power'=>2000, 'time'=>'2023-01-18 11:00'],
                        ['power'=>400, 'time'=>'2023-01-18 09:00'],
                        ['power'=>800, 'time'=>'2023-01-18 10:00'],
                        ['power'=>400, 'time'=>'2023-01-18 09:00'],
                        ['power'=>800, 'time'=>'2023-01-18 10:00']
                    ]),
                    'pump_id' => 4
                ],  [
                'power' => json_encode([
                    ['power'=>400, 'time'=>'2023-01-18 09:00'],
                    ['power'=>800, 'time'=>'2023-01-18 10:00'],
                    ['power'=>400, 'time'=>'2023-01-18 09:00'],
                    ['power'=>800, 'time'=>'2023-01-18 10:00']
                ]),
                'pump_id' => 5
            ],
                [
                    'power' => json_encode([
                        ['power'=>2000, 'time'=>'2023-01-18 11:00'],
                        ['power'=>2000, 'time'=>'2023-01-18 11:00'],
                        ['power'=>2000, 'time'=>'2023-01-18 11:00'],
                        ['power'=>2000, 'time'=>'2023-01-18 11:00'],
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
