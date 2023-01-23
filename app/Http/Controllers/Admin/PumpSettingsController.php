<?php

namespace App\Http\Controllers\Admin;

use App\Automation;
use App\Http\Controllers\Controller;
use App\Werf;
use Illuminate\Http\Request;

class PumpSettingsController extends Controller
{
    public function index($werfid)
    {
        $werf = Werf::findOrFail($werfid);
        return view('admin.pumpstart.start', compact('werf'));
    }

    public function store(Request $request, $werfid)
    {

        // Validate $request
        $this->validate($request,[
            'depth' => 'required',
            'day' => 'required'
        ]);

        $automation = new Automation();
        $automation->depth = $request->depth;
        $automation->day = $request->day;
        $automation->automatic = true;
        $automation->save();

        return redirect('/admin/werf/' . $werfid . '/pumpsettings');
    }
}
