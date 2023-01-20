<?php

namespace App\Http\Controllers\Admin;

use App\Automation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PumpSettingsController extends Controller
{
    public function index()
    {
        return view('admin.pumpstart.start');
    }

    public function store(Request $request)
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

        return redirect('admin/pumpsettings');
    }
}
