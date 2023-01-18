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
            $table->float('voltage');
            $table->string('location');
            $table->string('motif');
            $table->boolean('frequention');
            $table->float('percentage');
            $table->boolean('error');
            $table->foreignId('sensor_id');
            $table->timestamps();
            //Foreign keys --> moet nog aangepast worden
            $table->foreign('sensor_id')->references('id')->on('sensors')->onDelete('cascade')->onUpdate('cascade');
        });


        DB::table('pumps')->insert(
            [
                [
                    'pumpname' => "Pomp 1",
                    'status' => true,
                    'flowrate' => 3,
                    'powerconsumption' => 2000,
                    'voltage' => 230,
                    'location' => "hoek 1",
                    'motif' => "",
                    'frequention' => true,
                    'percentage' => 70,
                    'error' => false,
                    'sensor_id' => 1
                ],
                [
                    'pumpname' => "Pomp 2",
                    'status' => true,
                    'flowrate' => 3,
                    'powerconsumption' => 2000,
                    'voltage' => 230,
                    'location' => "hoek 2",
                    'motif' => "",
                    'frequention' => true,
                    'percentage' => 70,
                    'error' => false,
                    'sensor_id' => 1
                ],
                [
                    'pumpname' => "Pomp 3",
                    'status' => true,
                    'flowrate' => 3,
                    'powerconsumption' => 2000,
                    'voltage' => 230,
                    'location' => "hoek 3",
                    'motif' => "",
                    'frequention' => true,
                    'percentage' => 70,
                    'error' => false,
                    'sensor_id' => 3
                ],
                [
                    'pumpname' => "Pomp 4",
                    'status' => true,
                    'flowrate' => 3,
                    'powerconsumption' => 2000,
                    'voltage' => 110,
                    'location' => "hoek 4",
                    'motif' => "",
                    'frequention' => true,
                    'percentage' => 70,
                    'error' => false,
                    'sensor_id' => 2
                ],
                [
                    'pumpname' => "Pomp 5",
                    'status' => false,
                    'flowrate' => 3,
                    'powerconsumption' => 0,
                    'voltage' => 50,
                    'location' => "hoek 5",
                    'motif' => "Deze pomp is preventief uitgeschakeld omdat het stroomverbruik veel te hoog lag",
                    'frequention' => false,
                    'percentage' => 0,
                    'error' => true,
                    'sensor_id' => 4
                ]
                ,
                [
                    'pumpname' => "Pomp 6",
                    'status' => false,
                    'flowrate' => 3,
                    'powerconsumption' => 0,
                    'voltage' => 280,
                    'location' => "hoek 6",
                    'motif' => "Deze pomp is preventief uitgeschakeld omdat het stroomverbruik veel te hoog lag",
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
