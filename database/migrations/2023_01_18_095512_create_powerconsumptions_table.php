<?php

use Carbon\Carbon;
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
            $table->float('usage');
            $table->float('current');
            $table->timestamp('created_at')->useCurrent();
            $table->foreign('pump_id')->references('id')->on('pumps')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('pump_id');
        });

        $pump_ids = [1, 2, 3, 4, 5, 6];
        $start_time = Carbon::now();
        $end_time = Carbon::now()->addHours(2);

        foreach ($pump_ids as $pump_id) {
            while ($start_time->lt($end_time)) {
                DB::table('powerconsumptions')->insert([
                    'pump_id' => $pump_id,
                    'usage' => rand(10, 200),
                    'current' => rand(10, 200),
                    'created_at' => $start_time,

                ]);

                $start_time->addMinutes(15);
            }
            $start_time = Carbon::now();
        }
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
