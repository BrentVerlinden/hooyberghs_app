<?php

namespace App\Http\Controllers\Admin;

use App\Calibration;
use App\Http\Controllers\Controller;
use App\Log;
use App\Pump;
use App\Sensor;
use App\Sensordata;
use App\Werf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PumpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($werfid)
    {
        $werf = Werf::findOrFail($werfid);
        $pumps = Pump::orderBy('id')
            ->where('werf_id', $werfid)
            ->get();
        $result = compact('pumps', 'werf');
        (new \App\Helpers\Json)->dump($result);
        return view('admin.pumps.index', $result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($werfid)
    {
        $werf = Werf::findOrFail($werfid);
        $pump = new Pump();
        return view('admin.pumps.create', compact('pump', 'werf'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $werfid)
    {
        $werf = Werf::findOrFail($werfid);
        // Validate $request
        $this->validate($request,[
            'name' => 'required|min:3',
            'location' => 'required|min:3|',

        ]);
        // Create new genre
        $pump = new Pump();
        $pump->pumpname = $request->name;
        $pump->location = $request->location;
        $pump->status = 0;
        $pump->percentage = 0;
        $pump->werf_id = $werfid;
        $pump->error = 0;

        $calibration = new Calibration();
        $calibration->save();

        $sensor = new Sensor();
        $sensor->name = "Sensor " . $request->name;
        $sensor->calibration_id = $calibration->id;
        $sensor->error = 0;
//
        $sensor->save();
        $pump->sensor_id = $sensor->id;
        $pump->save();

        $sensordata = new Sensordata();
        $sensordata->sensor_id = $sensor->id;
        $sensordata->water_level = 0;
        $sensordata->save();

        $log = new Log();
        $log->description = auth()->user()->email . " heeft de pomp " . $pump->pumpname . " aangemaakt";
        $log->nameLog = "Pomp aangemaakt";
        $log->date = now();
        $log->werf_id = $werfid;
        $log->save();

        // Flash a success message to the session
        $message = "$pump->pumpname is aangemaakt.";
        session()->flash('success', $message);
        // Redirect to the master page
        return redirect('/admin/werf/' . $werf->id . '/pumps');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pump  $pump
     * @return \Illuminate\Http\Response
     */
    public function show(Pump $pump)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pump  $pump
     * @return \Illuminate\Http\Response
     */
    public function edit( $werfid, $pumpid)
    {
        $werf = Werf::findOrFail($werfid);
        $pump = Pump::findOrFail($pumpid);
        $result = compact('pump', 'werf');
        (new \App\Helpers\Json)->dump($result);
        return view('admin.pumps.edit', $result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pump  $pump
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$werfid, $pumpid)
    {
        $werf = Werf::findOrFail($werfid);
        $pump = Pump::findOrFail($pumpid);
        // Validate $request
        $this->validate($request,[
            'name' => 'required|min:3',
            'location' => 'required|min:3|',

        ]);

        // Update genre
        $pump->pumpname = $request->name;
        $pump->location = $request->location;
        $pump->save();

        $log = new Log();
        $log->description = auth()->user()->email . " heeft de pomp " . $pump->pumpname . " bewerkt";
        $log->nameLog = "Pomp bewerkt";
        $log->date = now();
        $log->werf_id = $werfid;
        $log->save();

        // Flash a success message to the session
        session()->flash('success', 'De pomp is bewerkt');
        // Redirect to the master page
        return redirect('/admin/werf/' . $werf->id . '/pumps');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pump  $pump
     * @return \Illuminate\Http\Response
     */
    public function destroy($werfid, $pumpid)
    {
        $werf = Werf::findOrFail($werfid);
        $pump = Pump::findOrFail($pumpid);
        $sensor_id = $pump->sensor_id;
        $sensor = Sensor::findOrFail($sensor_id);
        $calibration_id = $sensor->calibration_id;
        $calibration = Calibration::findOrFail($calibration_id);
        $calibration->delete();
        Sensordata::where('sensor_id', $sensor_id)->delete();
        $sensor->delete();

        $pump->delete();
        $log = new Log();
        $log->description = auth()->user()->email . " heeft de pomp  " . $pump->pumpname . " verwijderd";
        $log->nameLog = "Pomp verwijderd";
        $log->date = now();
        $log->werf_id = $werfid;
        $log->save();
        session()->flash('success', "De pomp $pump->pumpname  is verwijderd");
        return redirect('/admin/werf/' . $werf->id . '/pumps');
    }
}
