<?php

namespace App\Http\Controllers;

use App\Models\BusinessCategory;
use Illuminate\Http\Request;

class BusinessCategoriesController extends Controller
{
    public function index()
    {
        $business_categories = BusinessCategory::OrderBy("id","DESC")->paginate(10);

        $outPut = [
            "message" => "business_categories",
            "results" => $business_categories
        ];

        return response()->json($business_categories, 200);
    }

    public function store(Request $request)
    {
        $input = $request->all();
		$validationRules = [
            'name' => 'required|max:150',
		    'description' => 'required|max:65535'
		];

		$validator = \Validator::make($input, $validationRules);

		if($validator->fails()) {
			return response()->json($validator->errors(), 400);
		}
		$business_category = BusinessCategory::create($input);
		return response()->json($business_category, 200);
    }

    public function show($id)
	{
		$business_category = BusinessCategory::find($id);
		return response()->json($business_category, 200);
	}

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $validationRules = [
            'name' => 'required|max:150',
		    'description' => 'required|max:65535'
		];

        $validator = \Validator::make($input, $validationRules);

        if($validator->fails()) {
			return response()->json($validator->errors(), 400);
		}
		
		$business_category = BusinessCategory::find($id);
		$business_category->name = $request->input('name');
		$business_category->description = $request->input('description');
		$business_category->save();
		return response()->json($business_category, 200);
    }

    public function destroy($id)
	{
		$business_category = BusinessCategory::find($id);
		if (!$business_category) {
			abort(404);
		}
		$business_category->delete();
		$message = ['message' => 'deleted successfully', 'category_id' => $id];
		return response()->json($message, 200);
	}
}
