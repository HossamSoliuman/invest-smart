@extends('layouts.admin')
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center mt-5">
            <div class="col-md-11">
                <h1>Transactions</h1>
                <button type="button" class=" mb-3 btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
                    Create a new Transaction
                </button>

                <!-- Creating Modal -->
                <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
                    role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">New Transaction</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('transactions.store') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" name="user_id" class="form-control"
                                            placeholder="Transaction user_id" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="amount" class="form-control"
                                            placeholder="Transaction amount" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="address" class="form-control"
                                            placeholder="Transaction address" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="status" class="form-control"
                                            placeholder="Transaction status" required>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Edit Transaction Modal -->
                <div class="modal fade" id="editModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
                    role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel">Edit Transaction</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="editForm" method="post">
                                    @csrf
                                    @method('PUT')@csrf
                                    <div class="form-group">
                                        <input type="text" name="user_id" class="form-control"
                                            placeholder="Transaction user_id" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="amount" class="form-control"
                                            placeholder="Transaction amount" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="address" class="form-control"
                                            placeholder="Transaction address" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="status" class="form-control"
                                            placeholder="Transaction status" required>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" id="saveChangesBtn">Save Changes</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th> User_id</th>
                            <th> Amount</th>
                            <th> Address</th>
                            <th> Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transactions as $transaction)
                            <tr data-transaction-id="{{ $transaction->id }}">
                                <td class=" transaction-user_id">{{ $transaction->user_id }}</td>
                                <td class=" transaction-amount">{{ $transaction->amount }}</td>
                                <td class=" transaction-address">{{ $transaction->address }}</td>
                                <td class=" transaction-status">{{ $transaction->status }}</td>
                                <td class="d-flex">
                                    <button type="button" class="btn btn-warning btn-edit" data-toggle="modal"
                                        data-target="#editModal">
                                        Edit
                                    </button>
                                    <form action="{{ route('transactions.destroy', ['transaction' => $transaction->id]) }}"
                                        method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class=" ml-3 btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.btn-edit').on('click', function() {
                var TransactionUser_id = $(this).closest("tr").find(".transaction-user_id").text();
                $('#editModal input[name="user_id"]').val(TransactionUser_id);
                var TransactionAmount = $(this).closest("tr").find(".transaction-amount").text();
                $('#editModal input[name="amount"]').val(TransactionAmount);
                var TransactionAddress = $(this).closest("tr").find(".transaction-address").text();
                $('#editModal input[name="address"]').val(TransactionAddress);
                var TransactionStatus = $(this).closest("tr").find(".transaction-status").text();
                $('#editModal input[name="status"]').val(TransactionStatus);
                var TransactionId = $(this).closest('tr').data('transaction-id');
                $('#editForm').attr('action', '/transactions/' + TransactionId);
                $('#editModal').modal('show');
            });
            $('#saveChangesBtn').on('click', function() {
                $('#editForm').submit();
            });
        });
    </script>
@endsection
