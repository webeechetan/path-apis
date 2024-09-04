<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tests = Test::all();

        return $this->sendResponse($tests->toArray(), 'Tests retrieved successfully.');
       }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'test' => 'required',
            'testprice' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $test = Test::create($input);

        return $this->sendResponse($test->toArray(), 'Test created successfully.');    }

    /**
     * Display the specified resource.
     */
    public function show(Test $test)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Test $test)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'test' => 'required',
            'testprice' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $test->test = $input['test'];
        $test->subtest = $input['subtest'];
        $test->testprice = $input['testprice'];
        $test->save();

        return $this->sendResponse($test->toArray(), 'Test updated successfully.');    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Test $test)
    {
        try {
            $test->delete();
            return $this->sendResponse($test->toArray(), 'Test deleted successfully.');
        } catch (\Exception $e) {
            return $this->sendError('Test not found.');
        }
    }
}
