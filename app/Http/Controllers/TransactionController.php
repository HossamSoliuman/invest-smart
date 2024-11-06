<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangeStatusRequest;
use App\Models\Transaction;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Http\Resources\TransactionResource;
use App\Models\User;
use Hossam\Licht\Controllers\LichtBaseController;

class TransactionController extends LichtBaseController
{

    public function index()
    {
        $transactions = Transaction::where('status', Transaction::STATUS_PENDING)->get();
        $transactions = TransactionResource::collection($transactions);
        return view('transactions.index', compact('transactions'));
    }

    public function store(StoreTransactionRequest $request)
    {
        $transaction = Transaction::create($request->validated());
        return redirect()->route('transactions.index');
    }

    public function show(Transaction $transaction)
    {
        $transaction->load(['user', 'user.transactions' => function ($query) {
            $query->orderByDesc('created_at');
        }]);

        return view('transactions.show', compact('transaction'));
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

    public function changeStatus(ChangeStatusRequest $request)
    {
        $status = $request->validated('status');
        $transaction = $request->validated('transaction');
        $transaction = Transaction::with('user')->find($transaction);
        $user = User::find($transaction->user_id);
        if ($transaction->status != Transaction::STATUS_PENDING) {
            return to_route('transactions.show', ['transaction' => $transaction->id]);
        }
        if ($status == Transaction::STATUS_CONFIRMED) {
            if ($transaction->transaction_type == Transaction::TYPE_WITHDRAW) {
                $user->update([
                    'balance' => $user->balance - $transaction->amount
                ]);
            } else {
                $user->update([
                    'balance' => $user->balance + $transaction->amount
                ]);
            }
            $transaction->update([
                'status' => Transaction::STATUS_CONFIRMED
            ]);
        } elseif ($status == Transaction::STATUS_REFUSED) {
            $transaction->update([
                'status' => Transaction::STATUS_REFUSED
            ]);
        }
        return to_route('transactions.show', ['transaction' => $transaction->id]);
    }
}
