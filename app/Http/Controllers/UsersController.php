<?php

namespace App\Http\Controllers;

use Alert;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    public function index()
    {
        $users = User::all();
        confirmDelete("Delete", "Are You Sure?");
        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:8',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->isAdmin = $request->isAdmin;
        $user->save();
        Alert::success('Success', 'Data Berhasil di simpan')->autoClose(1000);
        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:8',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->isAdmin = $request->isAdmin;
        $user->save();
        alert()->success('Success', 'data edited successfully.')->autoClose(1000);
        return redirect()->route('user.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        toast('Data delete Successfully', 'success')->autoClose(1000);
        return redirect()->route('user.index');

    }
}
