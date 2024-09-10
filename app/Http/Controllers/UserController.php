<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
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
        
        $input = $request->all();
        $input['type'] = 1;
        $input['password'] = bcrypt('defaultPassword');
        $validator = Validator::make($input, [

        'name' => 'required',
        'type' => 'required',  
        'password' => 'required'
    ]);

    if ($validator->fails()) {
        return $this->sendError('Validation Error.', $validator->errors());
    }
    
        $doctor = User::create($input);

        return $this->sendResponse($doctor->toArray(), 'Doctor created successfully.');
    }

//----------------------------------------------------------------------------------------------------


    public function storeUser(Request $request){
        
        $input = $request->all();
        $input['type'] = 2;
        $input['password'] = bcrypt('defaultPassword');
        $validator = Validator::make($input, [
            'name' => 'required',
            'type' => 'required',
            'password' => 'required'
        ]);
    
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        
            $user = User::create($input);

        return $this->sendResponse($user->toArray(), 'User created successfully.');
    }


    public function show(User $user)
    {
        //
    }

   
    public function update(Request $request, User $user)
    {
        //
    }

  
    public function destroyUser(User $user)
    {
        try {
            $user->delete();
            return $this->sendResponse($user->toArray(), 'User deleted successfully.');
        } catch (\Exception $e) {
            return $this->sendError('User not found.');
        }    }


    public function destroyDoctor(User $user)
    { 
        try {
            $user->delete();
            return $this->sendResponse($user->toArray(), 'Doctor deleted successfully.');
        } catch (\Exception $e) {
            return $this->sendError('Doctor not found.');
        }    
    }
}
