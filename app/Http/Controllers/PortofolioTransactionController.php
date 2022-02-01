<?php

namespace App\Http\Controllers;

use App\Models\PortofolioTransaction;
use Illuminate\Http\Request;

class PortofolioTransactionController extends Controller
{
    public function index()
    {
        $portofolio_transactions = PortofolioTransaction::OrderBy("id","DESC")->paginate(10);

        $outPut = [
            "message" => "portofolio_transactions",
            "results" => $portofolio_transactions
        ];

        return response()->json($portofolio_transactions, 200);
    }

    public function store(Request $request)
    {
        $input = $request->all();
		$validationRules = [
			'portofolio_id' => 'required|exists:portofolios,id',
			'amount' => 'required|max:50',
        	'business_id' => 'required|exists:businesss,id'
		];

		$validator = \Validator::make($input, $validationRules);

		if($validator->fails()) {
			return response()->json($validator->errors(), 400);
		}
		$portofolio_transaction = PortofolioTransaction::create($input);
		return response()->json($portofolio_transaction, 200);
    }

	public function show($id)
	{
		$portofolio_transaction = PortofolioTransaction::find($id);
		return response()->json($portofolio_transaction, 200);
	}

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $validationRules = [
            'portofolio_id' => 'required|exists:portofolios,id',
			'amount' => 'required|max:50',
        	'business_id' => 'required|exists:businesss,id'
		];

        $validator = \Validator::make($input, $validationRules);

        if($validator->fails()) {
			return response()->json($validator->errors(), 400);
		}
		
		$portofolio_transaction= PortofolioTransaction::find($id);
		$portofolio_transaction->portofolio_id = $request->input('portofolio_id');
		$portofolio_transaction->amount = $request->input('amount');
		$portofolio_transaction->business_id = $request->input('business_id');
		$portofolio_transaction->save();
		return response()->json($portofolio_transaction, 200);
    }

    public function destroy($id)
	{
		$portofolio_transaction = PortofolioTransaction::find($id);
		if (!$portofolio_transaction) {
			abort(404);
		}
		$portofolio_transaction->delete();
		$message = ['message' => 'deleted successfully', 'Investasi_id' => $id];
		return response()->json($message, 200);
	}
}
