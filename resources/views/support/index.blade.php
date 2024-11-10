@extends('layouts.admin')
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center mt-5">
            <div class="col-md-11">
                <h1>Support Messages</h1>
                <table class="table">
                    <thead>
                        <tr>
                            <th> Account ID</th>
                            <th> Message</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($supports as $support)
                            <tr data-support-id="{{ $support->id }}">
                                <td class=" support-user_id">{{ $support->user->account_id }}</td>
                                <td class=" support-message">{{ Str::limit($support->message, 50, '...') }}</td>
                                <td class="d-flex">
                                    <a href="{{ route('support.show', ['support' => $support->id]) }}">show</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
