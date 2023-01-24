<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Json;
use App\Http\Controllers\Controller;
use App\Log;
use App\User;
use App\Werf;
use App\Werfuser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($werfid)
    {
        $werf = Werf::findOrFail($werfid);
        $users = User::orderBy('id')
            ->whereHas('werfusers', function($query) use ($werfid) {
                $query->where('werf_id', $werfid);
            })
            ->get();
        $result = compact('users', 'werf');
        (new \App\Helpers\Json)->dump($result);
        return view('admin.users.index', $result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($werfid)
    {
        $werf = Werf::findOrFail($werfid);
        $user = new User();
        return view('admin.users.create', compact('user', 'werf'));
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
            'email' => 'required|min:3', //|unique:users,email
            'password' => 'required'

        ]);
        $request->merge(['password' => Hash::make($request->password)]);
        // Create new user
        $user = User::firstOrNew(['email' => $request->email]);
        if (!$user->exists) {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = $request->password;
            $checkboxValue = $request->input('admin');
            if ($checkboxValue == 1) {
                $user->admin = 1;
            } else {
                $user->admin = 0;
            }
            $user->save();
            $msg = "Deze gebruiker is succesvol toegevoegd aan het systeem & aan jouw werf.";
            session()->flash('success', $msg);

            $log = new Log();
            $log->description = auth()->user()->email . " heeft de gebruiker met email " . $user->email . " aangemaakt & toegevoegd aan de werf";
            $log->nameLog = "gebruiker aangemaakt";
            $log->date = now();
            $log->werf_id = $werfid;
            $log->save();
        } else {
            $msg = "Deze user bestaat al in het systeem. Als deze nog niet in uw werf zit, zullen we deze toevoegen aan jouw werf. Let wel op, de gegevens van deze persoon blijven ongewijzigd aangezien dit account al bestond.";
            session()->flash('success', $msg);

            $log = new Log();
            $log->description = auth()->user()->email . " heeft de gebruiker met email " . $user->email . " toegevoegd aan de werf";
            $log->nameLog = "gebruiker aangemaakt";
            $log->date = now();
            $log->werf_id = $werfid;
            $log->save();
        }

        $werfuser = Werfuser::firstOrNew(['werf_id' => $werfid, 'user_id' => $user->id]);
        if (!$werfuser->exists) {
            $werfuser->save();
        }

        // Redirect to the master page
        return redirect('/admin/werf/' . $werf->id . '/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($werfid,User $user)
    {
        $werf = Werf::findOrFail($werfid);
        $result = compact('user', 'werf');
        (new \App\Helpers\Json)->dump($result);
        return view('admin.users.edit', $result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $werfid, User $user)
    {
        $werf = Werf::findOrFail($werfid);
        // Validate $request
        $this->validate($request,[
            'name' => 'unique:users,name,' . $user->id,
        ]);

        // Update user
        $user->name = $request->name;
        $user->email = $request->email;
        $checkboxValue = $request->input('admin');
        if ($checkboxValue == 1) {
            $user->admin = 1;
        } else {
            $user->admin = 0;
        }
        $user->save();

        $log = new Log();
        $log->description = auth()->user()->email . " heeft de gebruiker met email " . $user->email . " bewerkt";
        $log->nameLog = "gebruiker bewerkt";
        $log->date = now();
        $log->werf_id = $werfid;
        $log->save();

        // Flash a success message to the session
        session()->flash('success', 'De gebruiker is bewerkt');
        // Redirect to the master page
        return redirect('/admin/werf/' . $werf->id . '/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($werfid, User $user)
    {

//        $user->delete();
        $user = User::find($user->id);
        if ($user->werfusers->count() === 1) {
            $user->delete();
            session()->flash('success', "De gebruiker $user->name  is verwijderd");

            $log = new Log();
            $log->description = auth()->user()->email . " heeft de gebruiker met email " . $user->email . " verwijderd uit het systeem";
            $log->nameLog = "gebruiker verwijderd";
            $log->date = now();
            $log->werf_id = $werfid;
            $log->save();
        } else {
            $user->werfusers()->where('werf_id', $werfid)->delete();
            session()->flash('success', "De gebruiker $user->name  is verwijderd uit uw werf. Aangezien deze nog in andere wer(ven) zit, zal het account wel blijven bestaan.");

            $log = new Log();
            $log->description = auth()->user()->email . " heeft de gebruiker met email " . $user->email . " verwijderd uit de werf";
            $log->nameLog = "gebruiker verwijderd";
            $log->date = now();
            $log->werf_id = $werfid;
            $log->save();
        }
//        session()->flash('success', "De gebruiker $user->name  is verwijderd");
        return redirect('/admin/werf/' . $werfid . '/users');
    }
}
