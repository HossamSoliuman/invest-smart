@extends('layouts.admin')
@section('content')
    <div class="container mt-4">
        <h4>Transaction Details</h4>
        <table class="table table-bordered">
            <tr>
                <th>Transaction ID</th>
                <td>{{ $transaction->id }}</td>
            </tr>
            <tr>
                <th>Amount</th>
                <td>{{ $transaction->amount }}</td>
            </tr>
            <tr>
                <th>Address</th>
                <td>{{ $transaction->address }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>
                    <span
                        class="badge 
                        {{ $transaction->status === 'confirmed' ? 'bg-success' : ($transaction->status === 'refused' ? 'bg-danger' : 'bg-warning text-dark') }}">
                        {{ ucfirst($transaction->status) }}
                    </span>
                </td>
            </tr>
            <tr>
                <th>Type</th>
                <td>{{ ucfirst($transaction->transaction_type) }}</td>
            </tr>
            @if ($transaction->transaction_type == 'deposit')
                <tr>
                    <th>Image</th>
                    {{ $transaction->img }}
                    <td> <img src="{{ $transaction->img }}" alt="" width="200px"></td>
                </tr>
            @endif
            <tr>
                <th>Date</th>
                <td>{{ $transaction->created_at }}</td>
            </tr>
        </table>
        @if ($transaction->status == 'pending')
            <div class="mt-4 d-flex">
                <button class="btn btn-success me-2" data-bs-toggle="modal" data-bs-target="#confirmModal">Confirm</button>
                <form action="{{ route('transactions.status') }}" method="post" style="display: inline;">
                    @csrf
                    <input type="hidden" name="transaction" value="{{ $transaction->id }}">
                    <input type="hidden" name="status" value="refused">
                    <button type="submit" class="btn btn-danger">Refuse</button>
                </form>
            </div>
            <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmModalLabel">Confirm Transaction</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to confirm this transaction?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <form action="{{ route('transactions.status') }}" method="post" style="display: inline;">
                                @csrf
                                <input type="hidden" name="transaction" value="{{ $transaction->id }}">
                                <input type="hidden" name="status" value="confirmed">
                                <button type="submit" class="btn btn-success">Confirm</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <h4 class="mt-4">User Details</h4>
        <table class="table table-bordered">
            <tr>
                <th>Balance</th>
                <td>{{ $transaction->user->balance }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $transaction->user->email }}</td>
            </tr>
            <tr>
                <th>Account ID</th>
                <td>{{ $transaction->user->account_id }}</td>
            </tr>

            <tr>
                <th>Name</th>
                <td>{{ $transaction->user->name }}</td>
            </tr>
            <tr>
                <th>Phone</th>
                <td>{{ $transaction->user->phone }}</td>
            </tr>
            <tr>
                <th>Age</th>
                <td>{{ $transaction->user->age }}</td>
            </tr>

            <tr>
                <th>Gender</th>
                <td>{{ ucfirst($transaction->user->gender) }}</td>
            </tr>
            <tr>
                <th>Country</th>
                <td>{{ $transaction->user->country }}</td>
            </tr>

        </table>
        <h4 class="mt-4">User Transactions</h4>
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
                @foreach ($transaction->user->transactions as $transaction)
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
@endsection
