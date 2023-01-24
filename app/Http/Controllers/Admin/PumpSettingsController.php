<?php

namespace App\Http\Controllers\Admin;

use App\Automation;
use App\Http\Controllers\Controller;
use App\Log;
use App\User;
use App\Werf;
use Illuminate\Http\Request;

class PumpSettingsController extends Controller
{
    public function index($werfid)
    {
        $automation = Automation::where('werf_id', $werfid);
        $werf = Werf::findOrFail($werfid);
        return view('admin.pumpstart.update', compact('werf', 'automation'));
    }

//    public function store(Request $request, $werfid)
//    {
//        $werf = Werf::findOrFail($werfid);
//        // Validate $request
//        $this->validate($request,[
//            'depth' => 'required',
//            'day' => 'required'
//        ]);
//
//        $automation = new Automation();
//        $automation->depth = $request->depth;
//        $automation->day = $request->day;
//        $automation->werf_id = $werf->id;
//        $automation->automatic = true;
//        $automation->save();
//
//        return redirect('/admin/werf/' . $werfid . '/pumpsettings');
//    }

    public function update(Request $request, $werfid)
//        Automation $automation
    {
        $automation = Automation::where('werf_id', $werfid)->first();
        $werf = Werf::findOrFail($werfid);
        // Validate $request
        $this->validate($request,[
            'depth' => 'required',
            'day' => 'required'
        ]);

        // Update user
        $automation->depth = $request->depth;
        $automation->day = $request->day;
        $automation->automatic = true;

        $automation->save();

        $log = new Log();
        $log->description = auth()->user()->email . " heeft het automatisch systeem gestart";
        $log->nameLog = "automatisch systeem gestart";
        $log->werf_id = $werfid;
        $log->date = now();
        $log->save();

        // Flash a success message to the session
        session()->flash('success', 'De pomp begint met pompen');
        // Redirect to the master page
        return redirect('/admin/werf/' . $werfid . '/pumpsettings');
    }

}
