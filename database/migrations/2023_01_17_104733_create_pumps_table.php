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
            $table->string('location');
            $table->string('motif')->nullable();
            $table->float('percentage')->nullable();
            $table->float('previous')->nullable();
            $table->boolean('error')->nullable();
            $table->foreignId('sensor_id')->nullable();
            $table->foreignId('werf_id')->nullable();

            $table->timestamps();
            //Foreign keys --> moet nog aangepast worden

            $table->foreign('werf_id')->references('id')->on('werves')->onDelete('cascade')->onUpdate('cascade');
        });


        DB::table('pumps')->insert(
            [
                [
                    'pumpname' => "Pomp 1",
                    'status' => true,
                    'location' => "hoek 1",
                    'motif' => "",
                    'percentage' => 70,
                    'error' => false,

                    'werf_id' => 1,
                ],
                [
                    'pumpname' => "Pomp 2",
                    'status' => true,
                    'location' => "hoek 2",
                    'motif' => "",
                    'percentage' => 70,
                    'error' => false,

                    'werf_id' => 1
                ],
                [
                    'pumpname' => "Pomp 3",
                    'status' => true,
                    'location' => "hoek 3",
                    'motif' => "",
                    'percentage' => 70,
                    'error' => false,

                    'werf_id' => 1,
                ],
                [
                    'pumpname' => "Pomp 4",
                    'status' => true,
                    'location' => "hoek 4",
                    'motif' => "",
                    'percentage' => 70,
                    'error' => false,

                    'werf_id' => 1,
                ],
                [
                    'pumpname' => "Pomp 5",
                    'status' => false,
                    'location' => "hoek 5",
                    'motif' => "Deze pomp is preventief uitgeschakeld omdat het stroomverbruik veel te hoog lag",
                    'percentage' => 0,
                    'error' => true,

                    'werf_id' => 2,
                ]
                ,
                [
                    'pumpname' => "Pomp 6",
                    'status' => false,
                    'location' => "hoek 6",
                    'motif' => "Deze pomp is preventief uitgeschakeld omdat het stroomverbruik veel te hoog lag",
                    'percentage' => 0,
                    'error' => true,

                    'werf_id' => 2,
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
