<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSensordatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sensordatas', function (Blueprint $table) {
            $table->id();
//            $table->timestamps();
            $table->float('water_level')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->foreignId('sensor_id');
            $table->foreign('sensor_id')->references('id')->on('sensors')->onDelete('cascade')->onUpdate('cascade');


        });
        $start_time = Carbon::now();

        DB::table('sensordatas')->insert(
            [
                [
                    'water_level' => 18,
                    'created_at' => $start_time,
                    'sensor_id' => 1
                ],
                [

                    'water_level' => 10,
                    'created_at' => $start_time,
                    'sensor_id' => 1
                ],
                [

                    'water_level' => 6,
                    'created_at' => $start_time,
                    'sensor_id' => 1

                ],

                [
                    'water_level' => 15,
                    'created_at' => $start_time,
                    'sensor_id' => 2
                ],[
                'water_level' => 14,
                'created_at' => $start_time,
                'sensor_id' => 2

            ],

                [

                    'water_level' => 25,
                    'created_at' => $start_time,
                    'sensor_id' => 2
                ],[

                'water_level' => 1,
                'created_at' => $start_time,
                'sensor_id' => 3

            ],

                [

                    'water_level' => 15,
                    'created_at' => $start_time,
                    'sensor_id' => 3
                ],[

                'water_level' => 6,
                'created_at' => $start_time,
                'sensor_id' => 3

            ],

                [

                    'water_level' => 19,
                    'created_at' => $start_time,
                    'sensor_id' => 4

                ],[

                'water_level' => 12,
                'created_at' => $start_time,
                'sensor_id' => 4

            ],

                [

                    'water_level' => 5,
                    'created_at' => $start_time,
                    'sensor_id' => 4

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
        Schema::dropIfExists('sensordatas');
    }
}
