@extends('layouts.admin')
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center mt-5">
            <div class="col-md-11">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1>Users</h1>
                    <div>
                        <form class="form-inline my-2 my-lg-0" action="{{ route('users.index') }}" method="GET">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control mx-2"
                                    placeholder="Search by username, account ID or email" value="{{ request('search') }}">
                                <button class="btn btn-outline-dark my-2 my-sm-0" type="submit">Search</button>
                            </div>
                        </form>
                       
                    </div>
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th>Account ID</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->account_id }}</td>
                                <td>{{ $user->user_name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>
                                    <a href="{{ route('users.show', $user->id) }}" class="btn btn-secondary">View</a>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="post"
                                        style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-dark">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
