<?php
namespace App\Http\Controllers;

use App\Models\Bantuan;
use App\Models\Type;
use Illuminate\Http\Request;

class BantuansController extends Controller
{

	public function index(Request $request)
	{
		$articles = Bantuan::OrderBy("id", "DESC")->paginate(10)->toArray();
		$response = [
			"total_count" => $articles["total"],
			"limit" => $articles["per_page"],
			"pagination" => [
				"next_page" => $articles["next_page_url"],
				"current_page" => $articles["current_page"]
			],
			"data" => $articles["data"],
		];
		return response()->json($response, 200);
	}

	public function store(Request $request)
	{
		$input = $request->all();
		$validationRules = [
			'name' => 'required|min:5',
			'description' => 'required|min:10',
			'type' => 'required|in:FAQ,Bantuan',
			'user_id' => 'required|exists:users,id'
		];

		$validator = \Validator::make($input, $validationRules);

		if($validator->fails()) {
			return response()->json($validator->errors(), 400);
		}
		$bantuan = Bantuan::create($input);
		return response()->json($bantuan, 200);
	}

	public function show($id)
	{
		$article = Bantuan::find($id);
		return response()->json($article, 200);
	}

	public function update(Request $request, $id)
	{
		$input = $request->all();
		$validationRules = [
			'name' => 'required|min:5',
			'description' => 'required|min:10',
			'type' => 'required|in:FAQ,Bantuan',
			'user_id' => 'required|exists:users,id'
		];

		$validator = \Validator::make($input, $validationRules);

		if($validator->fails()) {
			return response()->json($validator->errors(), 400);
		}
		
		$bantuan = Bantuan::find($id);
		$bantuan->name = $request->input('name');
		$bantuan->description = $request->input('description');
		$bantuan->type = $request->input('type');
		$bantuan->user_id = $request->input('user_id');
		$bantuan->save();
		return response()->json($bantuan, 200);
	}

	public function destroy($id)
	{
		$bantuan = Bantuan::find($id);
		if (!$bantuan) {
			abort(404);
		}
		$bantuan->delete();
		$message = ['message' => 'deleted successfully', 'bantuan_id' => $id];
		return response()->json($message, 200);
	}
}
?>

