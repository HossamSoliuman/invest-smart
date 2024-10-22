<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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
}
