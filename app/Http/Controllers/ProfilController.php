<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProfilController extends Controller
{

	public function index()
	{
		$profil = User::OrderBy("id", "DESC")->get()->toArray();
		$response = [
			"data" => $profil,
		];
		return response()->json($response, 200);
	}

	public function show($id)
	{
		$slides = User::find($id);
		return response()->json($slides, 200);
	}

	public function changepassword(Request $request, $id)
	{
		$input = $request->all();
		$validationRules = [
			'password'=>'required|confirmed',
		];

		$validator = \Validator::make($input, $validationRules);

		if ($validator->fails()) {
			return response()->json($validator->errors(), 400);
		}

		$users = User::find($id);
		$plainPassword = $request->input('password');
		$users->password = app('hash')->make($plainPassword);
		$users->save();
		return response()->json($users, 200);
	}

	public function updateprof(Request $request, $id)
	{
		$input = $request->all();
		$validationRules = [
			'name'=>'required|string',
			'username'=>'required',
			'religion'=>'required',
			'phone'=>'required',
			'sex'=>'required|in:Laki-Laki,Perempuan',
			'work'=>'required',
			'address'=>'required'
		];

		$validator = \Validator::make($input, $validationRules);

		if ($validator->fails()) {
			return response()->json($validator->errors(), 400);
		}

		$user = User::find($id);
		$user->fill($input);
		$user->save();
		return response()->json($user, 200);
	}
}
