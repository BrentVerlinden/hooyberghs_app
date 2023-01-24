<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWerfusersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('werfusers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('werf_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('werf_id')->references('id')->on('werves')->onDelete('cascade')->onUpdate('cascade');
        });

        DB::table('werfusers')->insert(
            [
                [
                    'user_id' => 1,
                    'werf_id' => 1
                ],
                [
                    'user_id' => 2,
                    'werf_id' => 1
                ],
                [
                    'user_id' => 3,
                    'werf_id' => 1
                ],
                [
                    'user_id' => 4,
                    'werf_id' => 1
                ],
                [
                    'user_id' => 1,
                    'werf_id' => 2
                ],
                [
                    'user_id' => 2,
                    'werf_id' => 2
                ],
                [
                    'user_id' => 3,
                    'werf_id' => 2
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
        Schema::dropIfExists('werfusers');
    }
}
