<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePumpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pumps', function (Blueprint $table) {
            $table->id();
            $table->string('pumpname');
            $table->boolean('status');
            $table->float('flowrate'); //andere variable?
            $table->float('powerconsumption'); //andere variable?
            $table->string('location');
            $table->boolean('frequention');
            $table->float('percentage');
            $table->boolean('error');
            $table->foreignId('sensor_id');

            //Foreign keys --> moet nog aangepast worden
            $table->foreign('sensor_id')->references('id')->on('sensors')->onDelete('cascade')->onUpdate('cascade');
        });


        DB::table('pumps')->insert(
            [
                [
                    'pumpname' => "Naam 1",
                    'status' => true,
                    'flowrate' => 3,
                    'powerconsumption' => 2000,
                    'location' => "hoek 1",
                    'frequention' => true,
                    'percentage' => 70,
                    'error' => false,
                    'sensor_id' => 1
                ],
                [
                    'pumpname' => "Naam 2",
                    'status' => true,
                    'flowrate' => 3,
                    'powerconsumption' => 2000,
                    'location' => "hoek 2",
                    'frequention' => true,
                    'percentage' => 70,
                    'error' => false,
                    'sensor_id' => 1
                ],
                [
                    'pumpname' => "Naam 3",
                    'status' => true,
                    'flowrate' => 3,
                    'powerconsumption' => 2000,
                    'location' => "hoek 3",
                    'frequention' => true,
                    'percentage' => 70,
                    'error' => false,
                    'sensor_id' => 3
                ],
                [
                    'pumpname' => "Naam 4",
                    'status' => true,
                    'flowrate' => 3,
                    'powerconsumption' => 2000,
                    'location' => "hoek 4",
                    'frequention' => true,
                    'percentage' => 70,
                    'error' => false,
                    'sensor_id' => 2
                ],
                [
                    'pumpname' => "Naam 5",
                    'status' => true,
                    'flowrate' => 3,
                    'powerconsumption' => 0,
                    'location' => "hoek 5",
                    'frequention' => false,
                    'percentage' => 0,
                    'error' => true,
                    'sensor_id' => 4
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
        Schema::dropIfExists('pumps');
    }
}
