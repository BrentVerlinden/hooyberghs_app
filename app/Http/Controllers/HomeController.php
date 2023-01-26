<?php

namespace App\Http\Controllers;

use App\Log;
use App\Pump;
use App\Sensor;
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

        $pumps = Pump::with('powerconsumption', 'sensor.sensordatas')->where('werf_id', $werfid)->get();



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
        $pump = Pump::with(['powerconsumption', 'flowrate','sensor.sensordatas'])->find($id);
        $werf = Werf::find($werfid);

        (new \App\Helpers\Json)->dump($pump);

        return view('pumps.show', ['pump' => $pump, 'power_consumptions' => $pump->powerconsumption,'flowrates'=>$pump->flowrate, 'werf' => $werf]);

    }
    public function updatePump(Request $request, $werfid, $id)
    {
        $werf = Werf::find($werfid);
        $pump = Pump::find($id);
        if ($request->status == 'on') {
            $pump->status = true;
            $pump->error = 0;
            // als pomp terug opzet, gaan we ervan uit pomp gefixt, dus motief uitgezet preventief weg en error weg
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

    public function handleValueChange(Request $request, $werfid,  $id)
    {
        $pump = Pump::find($id);
        $werf = Werf::find($werfid);
        $sliderValue = $request->input('range_slider');
        $pump->percentage = $sliderValue;

        $log = new Log();
        if($sliderValue == 0) {
            $pump->status = 0;
            $test1 = " uitgezet (freq 0)";
        } else {
            $pump->status = 1;
            $pump->error = 0;
            $pump->motif = "";
            $test1 = " aangezet (freq " . $sliderValue . ")";
        }
        $log->description = auth()->user()->email . " heeft de pomp " . $pump->pumpname . $test1;
        $log->nameLog = "pomp aan/uit";
        $log->date = now();
        $log->werf_id = $werfid;
        $log->save();
        $pump->save();
        // process the slider value as needed

        return redirect('/user/werf/' . $werf->id . '/pump/'.$id);
    }

}
