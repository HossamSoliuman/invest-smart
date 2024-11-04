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
                    <td>{{ $transaction->user->email }}</td>
                    <td>{{ $transaction->user->account_id }}</td>
                    <td>{{ $transaction->user->amount }}</td>
                    <td>{{ $transaction->user->status }}</td>
                    <td>{{ $transaction->user->transaction_type }}</td>
                </tr>
            @endforeach

        </tbody>
    </table>
@endsection
