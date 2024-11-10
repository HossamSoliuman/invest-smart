@extends('layouts.admin')
@section('content')
    <table class="table table-sm mt-4">
        <thead>
            <tr>
                <th scope="col">Date</th>
                <th scope="col">Email</th>
                <th scope="col">Account Id</th>
                <th scope="col">Amount</th>
                <th scope="col">Status</th>
                <th scope="col">Transaction Type</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $transaction)
                <tr>
                    <th scope="row">{{ $transaction->created_at }}</th>
                    <td>
                        {{ $transaction->user->email }}

                    </td>
                    <td>
                        <a href="{{ route('users.show', $transaction->user->id) }}">
                            {{ $transaction->user->account_id }}
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

                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
