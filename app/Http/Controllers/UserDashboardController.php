<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function transactions(Request $request)
    {
        $user = $request->user();
        $transactions = Transaction::where('user_id', $user->id)->orderBy('id', 'desc')->paginate(10);
        return $this->apiResponse($transactions);
    }
}
