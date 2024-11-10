@extends('layouts.admin')
@section('content')
    <div class="card mt-5 p-5">
        <p class="font-weight-bold">
            {{ $support->message }}
        </p>
        <p class="text-muted">
            {{ $support->created_at->format('F j, Y, g:i a') }}
        </p>


    </div>
    <h4 class="mt-4">User Details</h4>
    <table class="table table-bordered">
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
