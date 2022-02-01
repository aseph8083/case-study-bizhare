<?php

namespace App\Http\Controllers;

use App\Models\Portofolio;
use App\Models\User;
use Illuminate\Http\Request;

class PortofolioController extends Controller
{
    public function index()
    {
        $portofolios = Portofolio::OrderBy("id","DESC")->paginate(10);

        $outPut = [
            "message" => "portofolios",
            "results" => $portofolios
        ];

        return response()->json($portofolios, 200);
    }

    public function store(Request $request)
    {
        $input = $request->all();
		$validationRules = [
			'name' => 'required|max:250',
			'user_id' => 'required|exists:users,id'
		];

		$validator = \Validator::make($input, $validationRules);

		if($validator->fails()) {
			return response()->json($validator->errors(), 400);
		}
		$portofolio = Portofolio::create($input);
		return response()->json($portofolio, 200);
    }

	public function show($id)
	{
		$portofolio = Portofolio::find($id);
		return response()->json($portofolio, 200);
	}

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $validationRules = [
            'name' => 'required|max:250',
			'user_id' => 'required|exists:users,id'
		];

        $validator = \Validator::make($input, $validationRules);

        if($validator->fails()) {
			return response()->json($validator->errors(), 400);
		}
		
		$portofolio= Portofolio::find($id);
		$portofolio->name = $request->input('name');
		$portofolio->user_id = $request->input('user_id');
		$portofolio->save();
		return response()->json($portofolio, 200);
    }

    public function destroy($id)
	{
		$portofolio = portofolio::find($id);
		if (!$portofolio) {
			abort(404);
		}
		$portofolio->delete();
		$message = ['message' => 'deleted successfully', 'portofolio_id' => $id];
		return response()->json($message, 200);
	}
}
