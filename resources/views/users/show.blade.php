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
                        <tr>
                            <th>Email Verified</th>
                            <td>
                                @if ($user->email_verified_at != null)
                                    <span class="badge bg-success">Verified</span>
                                @else
                                    <span class="badge bg-warning text-dark">Not Verified</span>
                                    <form action="{{ route('users.verify', $user->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-primary btn-sm">Verify User</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Back to list</a>
            </div>
        </div>
        <div class="col-md-11 mt-5">
            <h2>User Transactions</h2>
            <table class="table table-sm mt-4">
                <thead>
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Email</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Status</th>
                        <th scope="col">Transaction Type</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user->transactions as $transaction)
                        <tr>
                            <th scope="row">{{ $transaction->created_at }}</th>
                            <td>
                                <a href="{{ route('users.show', $transaction->user->id) }}">
                                    {{ $transaction->user->email }}
                                </a>
                            </td>
                            <td>{{ $transaction->amount }}</td>
                            <td>
                                @if ($transaction->status === \App\Models\Transaction::STATUS_PENDING)
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @elseif ($transaction->status === \App\Models\Transaction::STATUS_CONFIRMED)
                                    <span class="badge bg-success">Confirmed</span>
                                @elseif ($transaction->status === \App\Models\Transaction::STATUS_REFUSED)
                                    <span class="badge bg-danger">Refused</span>
                                @endif
                            </td>

                            <td>
                                @if ($transaction->transaction_type === \App\Models\Transaction::TYPE_WITHDRAW)
                                    <span class="badge bg-info text-dark">Withdraw</span>
                                @elseif ($transaction->transaction_type === \App\Models\Transaction::TYPE_DEPOSIT)
                                    <span class="badge bg-primary">Deposit</span>
                                @endif
                            </td>
                            <td><a href="{{ route('transactions.show', ['transaction' => $transaction->id]) }}">show</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection
