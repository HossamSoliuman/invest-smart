@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row justify-content-center mt-3">
            <div class="col-md-11">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1>Users</h1>
                    <div>
                        <form class="form-inline my-2 my-lg-0" action="{{ route('users.index') }}" method="GET">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control mx-2" style="width: 400px;"
                                    placeholder="Search by username, account ID or email" value="{{ request('search') }}">

                                <button class="btn btn-outline-dark my-2 my-sm-0" type="submit"><i class="fa fa-search"
                                        aria-hidden="true"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <h2>Active Users</h2>
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th>Account ID</th>
                            <th>Balance</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($activeUsers as $user)
                            @continue($user->role == 'admin')
                            <tr>
                                <td>{{ $user->account_id }}</td>
                                <td>{{ $user->balance }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>
                                    <a href="{{ route('users.show', $user->id) }}" class="btn btn-secondary">View</a>
                                    <button type="button" class="btn btn-dark"
                                        onclick="showDeleteModal({{ $user->id }})">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $activeUsers->links() }}

                <h2>Inactive Users</h2>
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th>Account ID</th>
                            <th>Balance</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($inactiveUsers as $user)
                            @continue($user->role == 'admin')
                            <tr>
                                <td>{{ $user->account_id }}</td>
                                <td>{{ $user->balance }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>
                                    <a href="{{ route('users.show', $user->id) }}" class="btn btn-secondary">View</a>
                                    <button type="button" class="btn btn-dark"
                                        onclick="showDeleteModal({{ $user->id }})">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $inactiveUsers->links() }}
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this user?
                </div>
                <div class="modal-footer">
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Yes, Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function showDeleteModal(userId) {
            let form = document.getElementById('deleteForm');
            form.action = `/users/${userId}`;
            new bootstrap.Modal(document.getElementById('deleteModal')).show();
        }
    </script>
@endsection
