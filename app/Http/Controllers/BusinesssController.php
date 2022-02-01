<?php

namespace App\Http\Controllers;

use App\Models\Business;
use Illuminate\Http\Request;

class BusinesssController extends Controller
{
    public function index()
    {
        $businesss = Business::OrderBy("id","DESC")->paginate(10);

        $outPut = [
            "message" => "businesss",
            "results" => $businesss
        ];

        return response()->json($businesss, 200);
    }

    public function store(Request $request)
    {
        $input = $request->all();
		$validationRules = [
            'name' => 'required|max:150',
            'description' => 'required|max:65535',
            'business_category_id' => 'required|exists:business_categories,id'
		];

		$validator = \Validator::make($input, $validationRules);

		if($validator->fails()) {
			return response()->json($validator->errors(), 400);
		}
		$business = Business::create($input);
		return response()->json($business, 200);
    }

    public function show($id)
	{
		$business = Business::find($id);
		return response()->json($business, 200);
	}

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $validationRules = [
            'name' => 'required|max:150',
            'description' => 'required|max:65535',
            'business_category_id' => 'required|exists:business_categories,id'
		];

        $validator = \Validator::make($input, $validationRules);

        if($validator->fails()) {
			return response()->json($validator->errors(), 400);
		}
		
		$business = Business::find($id);
		$business->name = $request->input('name');
		$business->description = $request->input('description');
        $business->business_category_id = $request->input('business_category_id');
		$business->save();
		return response()->json($business, 200);
    }

    public function destroy($id)
	{
		$business = Business::find($id);
		if (!$business) {
			abort(404);
		}
		$business->delete();
		$message = ['message' => 'deleted successfully', 'bisnis_id' => $id];
		return response()->json($message, 200);
	}
}
