<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function listDoctors(){
        $doctors = User::where('type','1')->get();
        return $this->sendResponse($doctors->toArray(), 'Doctors retrieved successfully.');
    }

    public function listUsers(){
        $users = User::where('type','2')->get();
        return $this->sendResponse($users->toArray(), 'Users retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeDoctor(Request $request){
        // add validation

        // $doctor = new User();
        $input = $request->all();

        $validator = Validator::make($input, [

        // $doctor->name = $request->name;
        // $doctor->type = 1;
        // $doctor->phone = $request->phone;
        // $doctor->email = $request->email;
        // $doctor->save();

        'name' => 'required',
        'type' => 'required',
    
    ]);

    if ($validator->fails()) {
        return $this->sendError('Validation Error.', $validator->errors());
    }
    
        $doctor = User::create($input);

        return $this->sendResponse($doctor->toArray(), 'Doctor created successfully.');
    }


    public function storeUser(Request $request){
        // add validation

        // $user = new User();
        // $user->name = $request->name;
        // $user->type = 2;
        // $user->phone = $request->phone;
        // $user->email = $request->email;

        // $user->save();

        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'type' => 'required',

    
        ]);
    
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        
            $user = User::create($input);

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
