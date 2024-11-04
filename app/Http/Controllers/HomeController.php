<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('user')->orderBy('updated_at', 'desc')->paginate(10);
        return view('index', compact('transactions'));
    }
}
