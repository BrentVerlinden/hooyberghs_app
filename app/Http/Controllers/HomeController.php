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

        $pumps = Pump::with('powerconsumption')->get();

        foreach ($pumps as $pump) {
        foreach($pump->powerconsumption as $power_consumption){
            $power_consumption->power = json_decode($power_consumption->power);
        }
        }

        $active_pumps = Pump::where('status', true)->get();
        $inactive_pumps = Pump::where('status', false)->get();
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
        $werf = Werf::findOrFail($werfid);
        $power_consumptions = $pump->powerconsumption;

        //STROOMVERBRUIK
        foreach ($power_consumptions as $power_consumption) {
            $power_consumption->power = json_decode($power_consumption->power);
        }

        //FLOWRATE
        $flowrates= $pump->flowrate;

        foreach ($flowrates as $flowrate) {
            $flowrate->flowrate = json_decode($flowrate->flowrate);

        }

        (new \App\Helpers\Json)->dump($pump);
        // je kunt nu de power_consumptions gebruiken in je view
        return view('pumps.show', ['pump' => $pump, 'power_consumptions' => $power_consumptions,'flowrates'=>$flowrates, 'werf' => $werf]);
    }
    public function updatePump(Request $request, $werfid, $id)
    {
        $werf = Werf::find($werfid);
        $pump = Pump::find($id);
        if ($request->status == 'on') {
            $pump->status = true;
            // als pomp terug opzet, gaan we ervan uit pomp gefixt, dus motief uitgezet preventief weg
            $pump->motif = "";
        } else {
            $pump->status = false;
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
        $log->save();
        return redirect('/user/werf/' . $werf->id . '/pump/'.$id);
    }

}
