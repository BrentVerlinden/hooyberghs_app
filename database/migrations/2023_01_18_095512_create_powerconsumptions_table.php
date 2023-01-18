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
                        ['power'=>400, 'time'=>'2023-01-18 09:00'],
                        ['power'=>800, 'time'=>'2023-01-18 10:00']
                    ]),
                    'pump_id' => 1
                ],
                [
                    'power' => json_encode([
                        ['power'=>2000, 'time'=>'2023-01-18 11:00']
                    ]),
                    'pump_id' => 2
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
        Schema::dropIfExists('powerconsumptions');
    }
}
