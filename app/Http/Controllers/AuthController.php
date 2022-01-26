<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
	public function register(Request $request)
	{
		$input = $request->all();

		$validationRules = [
			'name'=>'required|string',
			'email'=>'required|email|unique:users',
			'username'=>'required',
			'religion'=>'required',
			'phone'=>'required',
			'sex'=>'required|in:Laki-Laki,Peremuan',
			'work'=>'required',
			'address'=>'required',
			'password'=>'required|confirmed',
		];

		$validator = \Validator::make($input, $validationRules);

		if ($validator->fails()) {
			return response()->json($validator->errors(), 400);
		}

		$user = new User;
		$user->name = $request->input('name');
		$user->email = $request->input('email');
		$user->username = $request->input('username');
		$user->religion = $request->input('religion');
		$user->phone = $request->input('phone');
		$user->sex = $request->input('sex');
		$user->work = $request->input('work');
		$user->address = $request->input('address');
		$plainPassword = $request->input('password');
		$user->password = app('hash')->make($plainPassword);
		$user->save();

		return response()->json($user, 200);
	}

	public function login(Request $request)
	{
		$input = $request->all();

		$validationRules = [
			'email' => 'required|string',
			'password'=> 'required|string',
		];

		$validator = \Validator::make($input, $validationRules);

		if ($validator->fails()) {
			return response()->json($validator->errors(), 400);
		}

		$credentials = $request->only(['email', 'password']);

		if (! $token = Auth::attempt($credentials)) {
			return response()->json(['message' => 'Unauthorized'], 401);
		}

		$user = User::select('*')->where('email', $request->input('email'))->first();

		return response()->json([
			'data' => $user,
			'credential' => [
				'token'=>$token,
				'token_type'=>'bearer',
				'expires_in'=>Auth::factory()->getTTL() * 60
			]
		], 200);
	}
}
?>


