<?php

namespace App\Http\Controllers;

use App\Models\Subtest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubtestController extends Controller
{
    public function index()
    {
        $subtests = Subtest::all();
        return $this->sendResponse($subtests->toArray(), 'Subtests retrieved successfully.');
    }


    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'subtest' => 'required',
            'price' => 'required',

        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $subtest = Subtest::create($input);

        return $this->sendResponse($subtest->toArray(), 'Subtest created successfully.');  
    }

    
    public function show(Subtest $subtest)
    {
        //
    }

   
    public function edit(Subtest $subtest)
    {
        //
    }

    
    public function update(Request $request, Subtest $subtest)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'subtest' => 'required',
            'price' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $subtest->subtest = $input['subtest'];
        $subtest->price = $input['price'];

        $subtest->save();

        return $this->sendResponse($subtest->toArray(), 'Subtest updated successfully.');
    }

    
    public function destroy(Subtest $subtest)
    {
        try {
            $subtest->delete();
            return $this->sendResponse($subtest->toArray(), 'Subtest deleted successfully.');
        } catch (\Exception $e) {
            return $this->sendError('Subtest not found.');
        }    }
}
