<?php

namespace App\Http\Controllers;

use App\Http\Resources\TransactionResource;
use App\Models\Transaction;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function transactions(Request $request)
    {
        $user = $request->user();
        $transactions = Transaction::where('user_id', $user->id)->orderBy('id', 'desc')->paginate(10);
        return $this->apiResponse([
            'data' => TransactionResource::collection($transactions),
            'pagination' => [
                'total' => $transactions->total(),
                'count' => $transactions->count(),
                'per_page' => $transactions->perPage(),
                'current_page' => $transactions->currentPage(),
                'last_page' => $transactions->lastPage(),
            ],
        ]);
        
    }
}
