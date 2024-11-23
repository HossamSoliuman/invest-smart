@extends('layouts.admin')
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center mt-5">
            <div class="col-md-11">
                <h1>Contact Us</h1>




                <table class="table">
                    <thead>
                        <tr>
                            <th> Name</th>
                            <th> Email</th>
                            <th> Phone</th>
                            <th> Country</th>
                            <th> Amount of Invest</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contactUs as $contactU)
                            <tr data-contactU-id="{{ $contactU->id }}">
                                <td class=" contactU-name">{{ $contactU->name }}</td>
                                <td class=" contactU-email">{{ $contactU->email }}</td>
                                <td class=" contactU-phone">{{ $contactU->phone }}</td>
                                <td class=" contactU-country">{{ $contactU->country }}</td>
                                <td class=" contactU-amount_of_invest">{{ $contactU->amount_of_invest }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
