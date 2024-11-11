@extends('layouts.admin')
@section('content')
    <div class="card mt-5 p-5 shadow-sm">
        <h3 class="font-weight-bold text-primary">Support Ticket</h3>
        <p class="font-weight-bold mt-4">
            {{ $support->message }}
        </p>
        <p class="text-muted">
            Submitted on {{ $support->created_at->format('F j, Y, g:i a') }}
        </p>

        @php
            $statusClass = match ($support->status) {
                'closed' => 'text-danger',
                'in progress' => 'text-warning',
                default => 'text-primary',
            };
        @endphp

        <p class="{{ $statusClass }} font-weight-bold">
            {{ ucfirst($support->status) }}
        </p>



        <div class="d-flex gap-3 mt-4">
            <form action="{{ route('support.update-status', ['support' => $support->id, 'status' => 'in progress']) }}"
                method="get">
                <button class="btn btn-warning btn-sm">Update to In Progress</button>
            </form>
            <form action="{{ route('support.update-status', ['support' => $support->id, 'status' => 'closed']) }}"
                method="get">
                <button class="btn btn-danger btn-sm">Update to Closed</button>
            </form>
        </div>
    </div>

    <h4 class="mt-5">User Details</h4>
    <table class="table table-bordered mt-3 shadow-sm">
        <tr>
            <th>Balance</th>
            <td>{{ $support->user->balance }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $support->user->email }}</td>
        </tr>
        <tr>
            <th>Account ID</th>
            <td>{{ $support->user->account_id }}</td>
        </tr>
        <tr>
            <th>Name</th>
            <td>{{ $support->user->name }}</td>
        </tr>
        <tr>
            <th>Phone</th>
            <td>{{ $support->user->phone }}</td>
        </tr>
        <tr>
            <th>Age</th>
            <td>{{ $support->user->age }}</td>
        </tr>
        <tr>
            <th>Gender</th>
            <td>{{ ucfirst($support->user->gender) }}</td>
        </tr>
        <tr>
            <th>Country</th>
            <td>{{ $support->user->country }}</td>
        </tr>
    </table>
@endsection
