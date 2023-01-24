<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlowratesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flowrates', function (Blueprint $table) {
            $table->id();
            $table->float('flowrate');
            $table->timestamp('created_at')->useCurrent();
            $table->foreignId('pump_id');
            $table->foreign('pump_id')->references('id')->on('pumps')->onDelete('cascade')->onUpdate('cascade');
        });

        $flowrate_data = [];
        $start_time = strtotime("-2 days");

        for($i=0; $i<48; $i++){
            $time = $start_time + ($i*60*15);
            $flowrate = rand(100,200);
            $flowrate_data[] = [
                'flowrate' => $flowrate,
                'created_at' => date('Y-m-d H:i:s', $time),
                'pump_id' => 1
            ];
        }

        DB::table('flowrates')->insert($flowrate_data);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('flowrates');
    }
}
