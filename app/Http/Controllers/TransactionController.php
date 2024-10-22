<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Http\Resources\TransactionResource;
use Hossam\Licht\Controllers\LichtBaseController;

class TransactionController extends LichtBaseController
{

    public function index()
    {
        $transactions = Transaction::all();
        $transactions = TransactionResource::collection($transactions);
        return view('transactions', compact('transactions'));
    }

    public function store(StoreTransactionRequest $request)
    {
        $transaction = Transaction::create($request->validated());
        return redirect()->route('transactions.index');
    }

    public function show(Transaction $transaction)
    {
        return $this->successResponse(TransactionResource::make($transaction));
    }

    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
        $transaction->update($request->validated());
        return redirect()->route('transactions.index');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('transactions.index');
    }
}
