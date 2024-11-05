<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepositRequest;
use App\Http\Requests\WithdrawRequest;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('user_name', 'like', "%{$search}%")
                ->orWhere('account_id', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
        }

        $users = $query->paginate(10);
        return view('users.index', compact('users'));
    }

    public function show(User $user)
    {
        $user->load('transactions');
        return view('users.show', compact('user'));
    }


    public function withdraw(WithdrawRequest $request)
    {
        $validatedData = $request->validated();

        if ($request->user()->balance < $validatedData['amount']) {
            return $this->apiResponse(null, 'Insufficient balance', 0, 400);
        }

        $validatedData['user_id'] = $request->user()->id;
        $validatedData['status'] = Transaction::STATUS_PENDING;
        $validatedData['transaction_type'] = Transaction::TYPE_WITHDRAW;
        $transaction = Transaction::create($validatedData);

        return $this->apiResponse($transaction, 'Created');
    }
    public function deposit(DepositRequest $request)
    {
        $validatedData = $request->validated();

        $validatedData['user_id'] = $request->user()->id;
        $validatedData['status'] = Transaction::STATUS_PENDING;
        $validatedData['transaction_type'] = Transaction::TYPE_DEPOSIT;
        $transaction = Transaction::create($validatedData);

        return $this->apiResponse($transaction, 'Created');
    }
}
