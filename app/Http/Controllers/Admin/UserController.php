<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Json;
use App\Http\Controllers\Controller;
use App\Log;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id')
            ->get();
        $result = compact('users');
        (new \App\Helpers\Json)->dump($result);
        return view('admin.users.index', $result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User();
        return view('admin.users.create', compact('user'));
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
            'name' => 'required|min:3|unique:users,name',
            'email' => 'required|min:3|unique:users,email',
            'password' => 'required'

        ]);
        $request->merge(['password' => Hash::make($request->password)]);
        // Create new genre
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
//        $user->admin = $request->admin ? 1 : 0;
        $checkboxValue = $request->input('admin');
        if ($checkboxValue == 1) {
            $user->admin = 1;
        } else {
            $user->admin = 0;
        }
        $user->save();

        $log = new Log();
        $log->description = auth()->user()->email . " heeft de gebruiker " . $user->email . " aangemaakt";
        $log->nameLog = "user creation";
        $log->date = now();
        $log->save();

        // Flash a success message to the session
        $message = "User $user->name met email  $user->email is aangemaakt.";
        session()->flash('success', $message);
        // Redirect to the master page
        return redirect('admin/users');
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
    public function edit(User $user)
    {
        $result = compact('user');
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
    public function update(Request $request, User $user)
    {
        // Validate $request
        $this->validate($request,[
            'name' => 'unique:users,name,' . $user->id,
        ]);

        // Update genre
        $user->name = $request->name;
        $user->email = $request->email;
        $checkboxValue = $request->input('admin');
        if ($checkboxValue == 1) {
            $user->admin = 1;
        } else {
            $user->admin = 0;
        }
        $user->save();

        // Flash a success message to the session
        session()->flash('success', 'De gebruiker is aangepast');
        // Redirect to the master page
        return redirect('admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        session()->flash('success', "De gebruiker $user->name  is verwijderd");
        return redirect('admin/users');
    }
}
