<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepositRequest;
use App\Http\Requests\WithdrawRequest;
use App\Http\Resources\TransactionResource;
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
            $query->where(function ($q) use ($search) {
                $q->where('user_name', 'like', "%{$search}%")
                    ->orWhere('account_id', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $activeUsers = (clone $query)->whereHas('transactions')->paginate(5, ['*'], 'activePage');
        $inactiveUsers = (clone $query)->whereDoesntHave('transactions')->paginate(5, ['*'], 'inactivePage');

        return view('users.index', compact('activeUsers', 'inactiveUsers'));
    }
    public function verify($id)
    {
        $user = User::findOrFail($id);

        if ($user->email_verified_at) {
            return redirect()->back()->with('status', 'User is already verified.');
        }

        $user->update(['email_verified_at' => now()]);
        

        return redirect()->back()->with('status', 'User has been successfully verified.');
    }




    public function show(User $user)
    {
        $user->load('transactions');
        return view('users.show', compact('user'));
    }

    public function destroy(User $user)
    {
        $user->delete();
        return to_route('users.index');
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

        return $this->apiResponse(TransactionResource::make($transaction), 'Created');
    }
    public function deposit(DepositRequest $request)
    {
        $path = $this->uploadFile($request->validated('img'), 'transaction-files/imgs');
        $validatedData = $request->validated();
        $validatedData['img'] = $path;
        $validatedData['user_id'] = $request->user()->id;
        $validatedData['status'] = Transaction::STATUS_PENDING;
        $validatedData['transaction_type'] = Transaction::TYPE_DEPOSIT;

        $transaction = Transaction::create($validatedData);
        $transaction->refresh();
        return $this->apiResponse(TransactionResource::make($transaction), 'Created');
    }
    public function tickets(Request $request)
    {
        $user = User::with(['supports' => function ($q) {
            $q->orderBy('updated_at', 'desc');
        }])->find($request->user()->id);
        return $this->apiResponse($user->supports);
    }
}
