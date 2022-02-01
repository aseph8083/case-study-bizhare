<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use App\Models\Type;
use Illuminate\Http\Request;
use Cloudder;

class SlideController extends Controller
{

	public function index()
	{
		$slides = Slide::OrderBy("id", "DESC")->get()->toArray();
		$response = [
			"data" => $slides,
		];
		return response()->json($response, 200);
	}

	public function store(Request $request)
	{
		$file_url = $request->all();
		if ($request->hasFile('gambar') && $request->file('gambar')->isValid()) {
			$cloudder = Cloudder::upload($request->file('gambar')->getRealPath());
			$uploadResult = $cloudder->getResult();
			$file_url = $uploadResult["url"];
			$slides = Slide::create([
				'gambar' => $file_url
			]);
			return response()->json($slides, 200);
		}
		return response()->json([
			'status' => false,
			'message' => "File must be required",
		], 400);
	}

	public function show($id)
	{
		$slides = Slide::find($id);
		return response()->json($slides, 200);
	}

	public function update(Request $request, $id)
	{
		$file_url = $request->all();
		if ($request->hasFile('gambar') && $request->file('gambar')->isValid()) {
			$cloudder = Cloudder::upload($request->file('gambar')->getRealPath());
			$uploadResult = $cloudder->getResult();
			$file_url = $uploadResult["url"];
			$slides = Slide::find($id);
			$slides->gambar = $file_url;
			$slides->save();
			return response()->json($slides, 200);
		}
		return response()->json([
			'status' => false,
			'message' => "File must be required",
		], 400);
	}

	public function destroy($id)
	{
		$slides = Slide::find($id);
		if (!$slides) {
			abort(404);
		}
		$slides->delete();
		$message = ['message' => 'deleted successfully', 'id' => $id];
		return response()->json($message, 200);
	}
}
