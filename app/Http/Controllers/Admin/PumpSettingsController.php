<?php

namespace App\Http\Controllers\Admin;

use App\Automation;
use App\Http\Controllers\Controller;
use App\Log;
use App\Pump;
use App\User;
use App\Werf;
use Illuminate\Http\Request;

class PumpSettingsController extends Controller
{
    public function index($werfid)
    {
        $pumps = Pump::where('werf_id', $werfid)->get();
        $werf = Werf::findOrFail($werfid);
        return view('admin.pumpstart.update', compact('werf', 'pumps'));
    }

    public function update(Request $request, $werfid, $pumpid)
//        Automation $automation
    {
//        $automation = Automation::where('werf_id', $werfid)->first();
        $pump = Pump::findOrFail($pumpid);
        $werf = Werf::findOrFail($werfid);
        // Validate $request
        $this->validate($request,[
            'depth' => 'required',
        ]);

        // Update pump
        // check before starting to pump if water level > depth to pump

        if($pump->sensor->sensordatas->last()->water_level >= $request->depth && $request->depth >= 0)
        {
            $pump->depth = $request->depth;
            $pump->automatic = true;
            $pump->save();

            $log = new Log();
            $log->description = auth()->user()->email . " heeft het automatisch systeem voor pomp " . $pump->pumpname . " gestart";
            $log->nameLog = "automatisch systeem gestart";
            $log->werf_id = $werfid;
            $log->date = now();
            $log->save();

            // Flash a success message to the session
            session()->flash('success', 'De pomp is ingesteld op automatisch');
//            dd(session()->all());
            // Redirect to the master page
            return redirect('/admin/werf/' . $werfid . '/pumpsettings');
        }

        // Flash a success message to the session
        session()->flash('danger', 'U overschrijdt het grondwaterniveau');
        // Redirect to the master page
        return redirect('/admin/werf/' . $werfid . '/pumpsettings');
    }



    public function off(Request $request, $werfid, $pumpid)
//        Automation $automation
    {
//        $automation = Automation::where('werf_id', $werfid)->first();

        $pump = Pump::findOrFail($pumpid);
        $werf = Werf::findOrFail($werfid);

        $pump->automatic = false;
        $pump->depth = null;

        $pump->save();

        $log = new Log();
        $log->description = auth()->user()->email . " heeft het automatisch systeem voor pomp " . $pump->pumpname . " gestopt";
        $log->nameLog = "automatisch systeem gestopt";
        $log->werf_id = $werfid;
        $log->date = now();
        $log->save();

        // Flash a success message to the session
        session()->flash('success', 'De pomp stopt met automatisch pompen');
        // Redirect to the master page
        return redirect('/admin/werf/' . $werfid . '/pumpsettings');
    }

}
