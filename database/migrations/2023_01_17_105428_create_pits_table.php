<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pits', function (Blueprint $table) {
            $table->id();
            $table->string('location');
            $table->foreignId('pump_id');
            //Foreign keys --> moet nog aangepast worden
            $table->foreign('pump_id')->references('id')->on('pumps')->onDelete('cascade')->onUpdate('cascade');
        });

        DB::table('pits')->insert(
            [
                [
                    'location' => "hoek 1",
                    'pump_id' => 1
                ],
                [
                    'location' => "hoek 2",
                    'pump_id' => 2
                ],
                [
                    'location' => "hoek 3",
                    'pump_id' => 3
                ],
                [
                    'location' => "hoek 4",
                    'pump_id' => 4
                ],
                [
                    'location' => "hoek 5",
                    'pump_id' => 5
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
        Schema::dropIfExists('pits');
    }
}
