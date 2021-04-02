<?php

namespace App\Http\Controllers\Dashboard\UserManagement;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.user_management.users.index', [
            'users' => User::paginate(10),
            'allRoles' => Role::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.user_management.users.create', [
            'user' => [],
            'allRoles' => Role::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        $user->assignRole($request['role']);

        return redirect()->route('dashboard.user_management.user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('dashboard.user_management.users.edit', [
            'user' => $user,
            'allRoles' => Role::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validator = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);
        $user->name = $request['name'];
        $user->email = $request['email'];
        $request['password'] == null ? : Hash::make($request['password']);

        $edit_access = ($user->id == 1) && $request['role'] !== 'super' ? false : true;
        if (!$edit_access){
            return view('dashboard.user_management.users.edit', [
                'user' => $user,
                'allRoles' => Role::all(),
                'edit_access' => $edit_access,
            ]);
        }
        $user->save();
        $user->syncRoles([$request['role']]);
        return redirect()->route('dashboard.user_management.user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $delete_access = $user->id == 1 ? false : true;
        if ($delete_access){
            $user->delete();
            return redirect()->route('dashboard.user_management.user.index');
        }
        return view('dashboard.user_management.users.index', [
            'delete_access' => $delete_access,
            'users' => User::paginate(10),
            'allRoles' => Role::all(),
        ]);
    }
}
