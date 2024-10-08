<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function signup(Request $request){
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $user = new User();
        $user->name = $input['name'];
        $user->email = $input['email'];
        $user->type = 4;
        $user->password = Hash::make($input['password']);

        try {
            $user->save();
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json([
                'success' => true,
                'message' => 'User Signup Successfully.',
                'data' => $user,
                'token' => $token
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null
            ], 400);
        }
    }

    
    public function login(Request $request) {
        $input = $request->all();
    
        $validator = Validator::make($input, [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
    
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
    
        // Attempt to authenticate the user
        if (Auth::attempt(['email' => $input['email'], 'password' => $input['password']])) {
            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;
    
            return response()->json([
                'success' => true,
                'message' => 'User logged in successfully.',
                'data' => $user,
                'token' => $token
            ], 200);
        } 
        else
        {
            return response()->json([
                'success' => false,
                'message' => 'Invalid email or password.',
                'data' => null
            ], 401);
        }
    }
}
