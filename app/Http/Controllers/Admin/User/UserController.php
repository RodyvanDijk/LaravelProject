<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Hash;

use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

use Illuminate\Validation\Rules;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $role = $request->role;

        $user->assignRole($role);
        event(new Registered($user));



        return redirect(Route('admin.users.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  User $user
     * @return View
     */
    public function show(user $user): View
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User $user
     * @return View
     */
    public function edit(User $user)
    {

        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        $user->name = $request->name;
        $user->email= $request->email;


        if($request->role != ''){
            foreach ($user->getRoleNames() as $role ){
                $user->removeRole($role);
            };
            $user->assignRole($request->role);
            $user->save();
            return to_route('user.index')->with('status', 'user gewijzigd');
        }
        return to_route('user.edit', ['user' => $user->id] )->with('error', 'user moet een rol hebben');
    }

    /**
     * @param user $user
     * @return View
     */
    public function delete(user $user):view
    {
        return view('admin.users.delete', compact('user'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return RedirectResponse
     */
    public function destroy(User $user)
    {
        $user->delete();
        return to_route('user.index')->with('status', 'user verwijderd');
    }
}
