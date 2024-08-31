<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function listDoctors(){
        $doctors = User::where('type','1')->get();
        return $doctors;
    }

    public function listUsers(){
        $users = User::where('type','2')->get();
        return $users;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeDoctor(Request $request){
        // add validation

        $user = new User();
        $user->name = $request->name;
        $user->type = 1;
        $user->phone = $request->phone;
        $user->email = $request->email;

        $user->save();

        return $this->sendResponse($user->toArray(), 'Doctor created successfully.');
    }


    public function storeUser(Request $request){
        // add validation

        $user = new User();
        $user->name = $request->name;
        $user->type = 2;
        $user->phone = $request->phone;
        $user->email = $request->email;

        $user->save();

        return $this->sendResponse($user->toArray(), 'User created successfully.');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
