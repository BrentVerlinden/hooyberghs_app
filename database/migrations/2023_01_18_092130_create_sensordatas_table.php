<?php

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
            $table->json('depth');
            $table->foreignId('sensor_id');
            $table->foreign('sensor_id')->references('id')->on('sensors')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });

        DB::table('sensordatas')->insert(
            [
                [
                    'depth' => json_encode([
                        ['depth'=>1, 'time'=>'2023-01-18 09:00'],
                        ['depth'=>9, 'time'=>'2023-01-18 10:00']
                    ]),
                    'sensor_id' => 1
                ],[
                'depth' => json_encode([
                    ['depth'=>11, 'time'=>'2023-01-18 09:00'],
                    ['depth'=>29, 'time'=>'2023-01-18 10:00']
                ]),
                'sensor_id' => 2
            ],[
                'depth' => json_encode([
                    ['depth'=>31, 'time'=>'2023-01-18 09:00'],
                    ['depth'=>19, 'time'=>'2023-01-18 10:00']
                ]),
                'sensor_id' => 3
            ],  [
                'depth' => json_encode([
                    ['depth'=>8, 'time'=>'2023-01-18 09:00'],
                    ['depth'=>12, 'time'=>'2023-01-18 10:00']
                ]),
                'sensor_id' => 4
            ],[
                'depth' => json_encode([
                    ['depth'=>11, 'time'=>'2023-01-18 09:00'],
                    ['depth'=>29, 'time'=>'2023-01-18 10:00']
                ]),
                'sensor_id' => 5
            ],[
                'depth' => json_encode([
                    ['depth'=>31, 'time'=>'2023-01-18 09:00'],
                    ['depth'=>19, 'time'=>'2023-01-18 10:00']
                ]),
                'sensor_id' => 6
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
