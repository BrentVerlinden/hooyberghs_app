<?php

namespace App\Http\Controllers;

use App\Pump;
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
    public function index()
    {
        $active_pumps = Pump::where('status', true)->get();
        $inactive_pumps = Pump::where('status', false)->get();

        return view('home', [
            'active_pumps' => $active_pumps,
            'inactive_pumps' => $inactive_pumps
        ]);
    }


    public function showPump($id)
    {
        $pump = Pump::find($id);
        $power_consumptions = $pump->powerconsumption;

        foreach ($power_consumptions as $power_consumption) {
            $power_consumption->power = json_decode($power_consumption->power);
        }

        // je kunt nu de power_consumptions gebruiken in je view
        return view('pumps.show', ['pump' => $pump, 'power_consumptions' => $power_consumptions]);
    }
    public function updatePump(Request $request, $id)
    {
        $pump = Pump::find($id);
        if ($request->status == 'on') {
            $pump->status = true;
            // als pomp terug opzet, gaan we ervan uit pomp gefixt, dus motief uitgezet preventief weg
            $pump->motif = "";
        } else {
            $pump->status = false;
        }
        $pump->save();
        return redirect('/user/pump/'.$id);
    }

}
