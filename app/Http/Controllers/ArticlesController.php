<?php
namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Type;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{

	public function index(Request $request)
	{
		$articles = Article::with('types')->OrderBy("id", "DESC")->paginate(10)->toArray();
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
			'title' => 'required|min:5',
			'body' => 'required|min:10',
			'category' => 'required',
			'user_id' => 'required|exists:users,id'
		];

		$validator = \Validator::make($input, $validationRules);

		if($validator->fails()) {
			return response()->json($validator->errors(), 400);
		}
		
		$article = new Article;
		$article->title = $request->input('title');
		$article->body = $request->input('body');
		$article->user_id = $request->input('user_id');
		$article->save();
		$type = Type::find($request->input('category'));
        $article->types()->attach($type);
		$_article = Article::with('types')->find($article->id);
		return response()->json($_article, 200);
	}

	public function show($id)
	{
		$articles = Article::with('types')->OrderBy("id", "DESC");
		$articles->types()->where('id',$id)->paginate(10)->toArray();
		if (!$articles) {
			abort(404);
		}
		return response()->json($articles, 200);
	}

	public function detail($id)
	{
		$article = Article::with('types')->find($id);
		if (!$article) {
			abort(404);
		}
		return response()->json($article, 200);
	}

	public function update(Request $request, $id)
	{
		$input = $request->all();
		$validationRules = [
			'title' => 'required|min:5',
			'body' => 'required|min:10',
			'category' => 'required',
			'user_id' => 'required|exists:users,id'
		];

		$validator = \Validator::make($input, $validationRules);

		if($validator->fails()) {
			return response()->json($validator->errors(), 400);
		}
		
		$article = Article::find($id);
		$article->title = $request->input('title');
		$article->body = $request->input('body');
		$article->user_id = $request->input('user_id');
		$article->save();
		$article->types()->detach();
		$type = Type::find($request->input('category'));
        $article->types()->attach($type);
		$article = Article::with('types')->find($id);
		return response()->json($article, 200);
	}

	public function destroy($id)
	{
		$article = Article::find($id);
		if (!$article) {
			abort(404);
		}
		$article->types()->detach();
		$article->delete();
		$message = ['message' => 'deleted successfully', 'article_id' => $id];
		return response()->json($message, 200);
	}
}
?>

