<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAutomationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('automations', function (Blueprint $table) {
            $table->id();
            $table->integer('day')->nullable();
            $table->float('depth')->nullable();
            $table->boolean('automatic')->default(false);
            $table->foreignId('werf_id')->nullable();
            $table->foreign('werf_id')->references('id')->on('werves')->onDelete('cascade')->onUpdate('cascade');
        });

        DB::table('automations')->insert(
            [
                [
                    'werf_id'=> 1,
                    'automatic'=>0
                ],
                [
                    'werf_id'=> 2,
                    'automatic'=>0
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
        Schema::dropIfExists('automations');
    }
}
