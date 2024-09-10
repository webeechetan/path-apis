<?php

namespace App\Http\Controllers;

use App\Models\SubTest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubtestController extends Controller
{
    public function index()
    {
        $subtests = SubTest::with('test')->get();
        return $this->sendResponse($subtests->toArray(), 'Subtests retrieved successfully.');
    }


    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'test_id' => 'required',
            'name' => 'required',
            'price' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $subtest = SubTest::create($input);

        return $this->sendResponse($subtest->toArray(), 'Subtest created successfully.');  
    }

    
    public function show(SubTest $subtest)
    {
        //
    }

   
    public function edit(SubTest $subtest)
    {
        //
    }

    
    public function update(Request $request, SubTest $subtest)
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

    
    public function destroy(SubTest $subtest)
    {
        try {
            $subtest->delete();
            return $this->sendResponse($subtest->toArray(), 'Subtest deleted successfully.');
        } catch (\Exception $e) {
            return $this->sendError('Subtest not found.');
        }    }
}
