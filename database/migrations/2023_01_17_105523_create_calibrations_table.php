<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalibrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calibrations', function (Blueprint $table) {
            $table->id();
            $table->dateTime('startDate');
            $table->dateTime('endDate');
            $table->time('time'); //andere variable?
            $table->foreignId('pit_id');
            //Foreign keys --> moet nog aangepast worden
            $table->foreign('pit_id')->references('id')->on('pits')->onDelete('cascade')->onUpdate('cascade');
        });


        DB::table('calibrations')->insert(
            [
                [
                    'startDate' => '2023-01-16',
                    'endDate' => '2023-04-22',
                    'time' => 10,
                    'pit_id' => 1

                ],
                [
                    'startDate' => '2023-01-17',
                    'endDate' => '2023-05-22',
                    'time' => 10,
                    'pit_id' => 1

                ],
                [
                    'startDate' => '2023-01-15',
                    'endDate' => '2023-04-22',
                    'time' => 10,
                    'pit_id' => 2

                ],
                [
                    'startDate' => '2023-01-17',
                    'endDate' => '2023-02-19',
                    'time' => 10,
                    'pit_id' => 2

                ],
                [
                    'startDate' => '2023-01-17',
                    'endDate' => '2023-03-19',
                    'time' => 10,
                    'pit_id' => 3

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
        Schema::dropIfExists('calibrations');
    }
}
