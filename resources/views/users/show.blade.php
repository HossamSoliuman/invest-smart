@extends('layouts.admin')
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center mt-5">
            <div class="col-md-11">
                <h1>User Details</h1>
                <table class="table">
                    <tbody>
                        <tr>
                            <th>Account Id</th>
                            <td>{{ $user->account_id }}</td>
                        </tr>
                        <tr>
                            <th>Username</th>
                            <td>{{ $user->user_name }}</td>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>{{ $user->phone }}</td>
                        </tr>
                        <tr>
                            <th>Age</th>
                            <td>{{ $user->age }}</td>
                        </tr>
                        <tr>
                            <th>Balance</th>
                            <td>{{ $user->balance }}</td>
                        </tr>
                    </tbody>
                </table>
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Back to list</a>
            </div>
        </div>
        <div class="col-md-11 mt-5">
            <h2>User Transactions</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Transaction ID</th>
                        <th>Amount</th>
                        <th>Address</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($user->transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->id }}</td>
                            <td>{{ $transaction->amount }}</td>
                            <td>{{ $transaction->address }}</td>
                            <td>{{ $transaction->status }}</td>
                            <td>{{ $transaction->created_at }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">No transactions found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
@endsection
