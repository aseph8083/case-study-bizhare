<?php

namespace App\Http\Controllers;

use App\Models\Saldo;
use App\Models\Type;
use Illuminate\Http\Request;
use Cloudder;

class SaldoController extends Controller
{

	public function index()
	{
		$saldo = Saldo::OrderBy("id", "DESC")->get()->toArray();
		$response = [
			"data" => $saldo,
		];
		return response()->json($response, 200);
	}

	public function show($id)
	{
		$saldo = Saldo::find($id);
		return response()->json($saldo, 200);
	}
}
