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
        return User::where('type','1')->get();
    }

    public function listUsers(){
        $users = User::where('type','0')->get();

        $this->sendResponse(
            $users,
            'Users created successfully'
        );
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

        return $this->sendResponse($user->toArray(), 'Patient created successfully.');
    }


    public function storeUser(Request $request){
        // add validation

        return $request;
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
