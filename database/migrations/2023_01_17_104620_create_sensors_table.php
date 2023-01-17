<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSensorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sensors', function (Blueprint $table) {
            $table->id();
            $table->float('data'); //andere variable?
            $table->boolean('error');
        });


        DB::table('sensors')->insert(
            [
                [
                    'data' => 1,
                    'error' => false
                ],
                [
                    'data' => 2,
                    'error' => false
                ],
                [
                    'data' => 3,
                    'error' => false
                ],
                [
                    'data' => 4,
                    'error' => false
                ],
                [
                    'data' => 5,
                    'error' => true
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
        Schema::dropIfExists('sensors');
    }
}
