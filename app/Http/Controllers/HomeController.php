<?php

namespace App\Http\Controllers;

use App\Log;
use App\Pump;
use App\Werf;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($werfid)
    {

        $pumps = Pump::where('werf_id', $werfid)->get();

        foreach ($pumps as $pump) {

            foreach ($pump->powerconsumption as $power_consumption) {
                $power_consumption->verbruik = json_decode($power_consumption->verbruik);
            }

            foreach ($pump->sensors as $sensor) {
                $sensor->data = json_decode($sensor->data);
            }


        }

        $active_pumps = Pump::where('status', true)->where('werf_id', $werfid)->get();
        $inactive_pumps = Pump::where('status', false)->where('werf_id', $werfid)->get();
        (new \App\Helpers\Json)->dump($pumps);

        $werf = Werf::findOrFail($werfid);



        return view('home', [
            'active_pumps' => $active_pumps,
            'inactive_pumps' => $inactive_pumps,'pumps'=>$pumps,
            'werf' => $werf
        ]);
    }


    public function showPump($werfid, $id)
    {
        $pump = Pump::find($id);
        $werf = Werf::find($werfid);
        $power_consumptions = $pump->powerconsumption;

        //verbruik
        foreach ($power_consumptions as $power_consumption) {
            $power_consumption->verbruik = json_decode($power_consumption->verbruik);
        }

        //FLOWRATE
        $flowrates= $pump->flowrate;

        foreach ($flowrates as $flowrate) {
            $flowrate->flowrate = json_decode($flowrate->flowrate);

        }


        //stroom
        foreach ($power_consumptions as $power_consumption) {
            $power_consumption->stroom = json_decode($power_consumption->stroom);
        }

        (new \App\Helpers\Json)->dump($pump);
//        (new \App\Helpers\Json)->dump($werf);
        // je kunt nu de power_consumptions gebruiken in je view

        return view('pumps.show', ['pump' => $pump, 'power_consumptions' => $power_consumptions,'flowrates'=>$flowrates,'stroom' => $power_consumptions, 'werf' => $werf]);

    }
    public function updatePump(Request $request, $werfid, $id)
    {
        $werf = Werf::find($werfid);
        $pump = Pump::find($id);
        if ($request->status == 'on') {
            $pump->status = true;
            // als pomp terug opzet, gaan we ervan uit pomp gefixt, dus motief uitgezet preventief weg
            $pump->motif = "";
            if ($werf->frequention == 1) {
                if ($pump->previous != null){
            $pump->percentage = $pump->previous;
                }
            }
        } else {
            $pump->status = false;
            if ($werf->frequention == 1) {
            $pump->previous = $pump->percentage;
            $pump->percentage = 0;
            }
        }
        $pump->save();
        $log = new Log();
        if ($pump->status === true)
        {
            $test1 = " aangezet.";
        }
        else
        {
            $test1 = " uitgezet.";
        }
        $log->description = auth()->user()->email . " heeft de pomp " . $pump->pumpname . $test1;
        $log->nameLog = "pomp aan/uit";
        $log->date = now();
        $log->werf_id = $werfid;
        $log->save();
        return redirect('/user/werf/' . $werf->id . '/pump/'.$id);
    }

}
