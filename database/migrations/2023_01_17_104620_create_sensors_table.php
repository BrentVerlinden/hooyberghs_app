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

            $table->boolean('error');
        });


        DB::table('sensors')->insert(
            [
                [

                    'error' => false
                ],
                [

                    'error' => false
                ],
                [

                    'error' => false
                ],
                [

                    'error' => false
                ],
                [

                    'error' => true
                ],
                [

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
