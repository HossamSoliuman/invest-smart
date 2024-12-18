@extends('layouts.admin')
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center mt-5">
            <div class="col-md-11">
                <h1>Withdrawals</h1>
                <table class="table table-sm mt-4">
                    <thead>
                        <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Email</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($withdrawals as $transaction)
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
                                <td><a href="{{ route('transactions.show', ['transaction' => $transaction->id]) }}">show</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $withdrawals->links() }}

                <h1>Deposits</h1>
                <table class="table table-sm mt-4">
                    <thead>
                        <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Email</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($deposits as $transaction)
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
                                <td><a
                                        href="{{ route('transactions.show', ['transaction' => $transaction->id]) }}">show</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $deposits->links() }}
            </div>
        </div>
    </div>
@endsection
