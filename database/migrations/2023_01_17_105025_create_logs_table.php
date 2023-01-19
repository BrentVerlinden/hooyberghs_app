<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->string('nameLog');
            $table->dateTime('date'); //andere variable?
            $table->foreignId('user_id')->nullable();
            $table->foreignId('pump_id')->nullable();
            $table->foreignId('sensor_id')->nullable();


            //Foreign keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('pump_id')->references('id')->on('pumps')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('sensor_id')->references('id')->on('sensors')->onDelete('cascade')->onUpdate('cascade');
        });

        for ($i = 0; $i <= 5; $i++) {
            DB::table('logs')->insert(
                [
                    [
                        'description' => "event $i",
                        'namelog' => "log $i",
                        'date' => '2022-01-01 10:00',  //andere variable
                        'user_id' => 1,
                        'pump_id' => 1,
                        'sensor_id' => 1
                    ],

                ]
            );
        }

        DB::table('logs')->insert([
            [
                'description' => "failure of login",
                'namelog' => "log failure 1",
                'date' => '2022-01-01 11:00',  //andere variable
                'user_id' => 1,
                'pump_id' => 1,
                'sensor_id' => 1
            ],
        ]);


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logs');
    }
}
