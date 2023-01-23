<?php

namespace App\Http\Controllers;

use App\Log;
use App\Werf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class WerfController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        $userid = auth()->user()->id;

        $werfs = Werf::whereHas('werfusers', function ($query) use ($userid) {
            $query->where('user_id', $userid);
        })->get();

        return view('werf.home', compact('werfs'));
    }

    public function index()
    {
        $werfs = Werf::all();

        return view('werf.crud', compact('werfs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        $werf = new Werf();
        return view('werf.create'); //, compact('werf')
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate $request
        $this->validate($request,[
            'name' => 'required|min:1',
        ]);

        // Create new werf
        $werf = new Werf();
        $werf->name = $request->name;
        $werf->save();

        $log = new Log();
        $log->description = auth()->user()->email . " heeft de werf met naam " . $werf->name . " aangemaakt";
        $log->nameLog = "werf aangemaakt";
        $log->date = now();
        $log->save();

        // Flash a success message to the session
        $message = "Werf $werf->name is aangemaakt.";
        session()->flash('success', $message);
        // Redirect to the master page
        return redirect('/admin/werf/crud');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Werf  $werf
     * @return \Illuminate\Http\Response
     */
    public function show(Werf $werf)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Werf  $werf
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $werf = Werf::findOrFail($id);
        return view('werf.edit', compact('werf'));
//        $result = compact('werf');
//        (new \App\Helpers\Json)->dump($result);
//        return view('werf.edit', $result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Werf  $werf
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $werf = Werf::findOrFail($id);

        // Validate $request
        $this->validate($request,[
            'name' => 'unique:werves,name,' . $werf->id,
        ]);

        // Update genre
        $werf->name = $request->name;
        $werf->save();

        $log = new Log();
        $log->description = auth()->user()->email . " heeft de werf met naam " . $werf->name . " bewerkt";
        $log->nameLog = "werf bewerkt";
        $log->date = now();
        $log->save();

        // Flash a success message to the session
        session()->flash('success', 'De werf is bewerkt');
        // Redirect to the master page
        return redirect('/admin/werf/crud');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Werf  $werf
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $werf = Werf::findOrFail($id);
        $werf->delete();
        $log = new Log();
        $log->description = auth()->user()->email . " heeft de werf met naam " . $werf->name . " verwijderd";
        $log->nameLog = "werf verwijderd";
        $log->date = now();
        $log->save();
        session()->flash('success', "De werf $werf->name  is verwijderd");
        return redirect('/admin/werf/crud');
    }
}
