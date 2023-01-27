<?php

namespace App\Http\Controllers;

use App\Log;
use App\Werf;
use Illuminate\Http\Request;

class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index(Request $request, $werfid)
    {
        $werf = Werf::findOrFail($werfid);
        $description = '%' . $request->input('description') . '%';
        $date = $request->input('date');

        $logs = Log::orderBy('date', 'desc');

        if ($description) {
            $logs = $logs->where('description', 'like', $description);
        }

        if ($date) {
            $logs = $logs->whereDate('date', $date);
        }

//        $logs = $logs->where('werf_id', $werfid)->get();
        $logs = $logs->where('werf_id', $werfid)->paginate(15);
//        ->paginate(15);

        return view('admin.log.log', compact('logs', 'werf'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Log  $log
     * @return \Illuminate\Http\Response
     */
    public function show(Log $log)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Log  $log
     * @return \Illuminate\Http\Response
     */
    public function edit(Log $log)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Log  $log
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Log $log)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Log  $log
     * @return \Illuminate\Http\Response
     */
    public function destroy(Log $log)
    {
        //
    }
}
