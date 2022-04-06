@extends('layouts.admin')

@section('custom-css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" /><!-- CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
@endsection

@section('content')
    <div class="container">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">List Account</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- <div class="col-lg-12">
        @if(Session::has('success_msg'))
        <div class="alert alert-success">{{ Session::get('success_msg') }}</div>
        @endif -->

        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">List User</h6>
                @if (auth()->user()->hasRole('admin'))
                <a class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Create User
                </a>
                @endif
            </div>
            <div class="card-body">
                <table id="users-table" class="table table-responsive" style="width:100%">
                    <thead class="thread-light">
                        <tr class="col">
                            <th class="col-1">User Name</th>
                            <th class="col-1">Email</th>
                            <th class="col-1">Role</th>
                            <th class="col-1">Department</th>
                            <th class="col-1">Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    @if (auth()->user()->hasRole('admin'))
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create new user</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.account.create') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Full name:</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" name="email" class="form-control" id="email"
                                placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="role">Role:</label>
                            <select class="form-control" name="role_id" id="role">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="department">Department:</label>
                            <select class="form-control" name="department_id" id="department">
                                @foreach ($department as $dpm)
                                    <option value="{{ $dpm->id }}">{{ $dpm->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-warning">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
@endsection

@section('custom-js')
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    {{-- <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script> --}}
    {{-- <script src="https://cdn.datatables.net/rowreorder/1.2.8/js/dataTables.rowReorder.min.js"></script> --}}
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                "autoWidth": false,
                ajax: '{{ url('/admin/account/dt-row-data') }}',
                columns: [{
                        data: 'name',
                        name: 'name',
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'role',
                        name: 'role'
                    },
                    {
                        data: 'department',
                        name: 'department'
                    },
                    {
                        data: 'action',
                        name: 'action',
                    }
                ]
            });
            $('#users-table_wrapper').removeClass('form-inline');
        });
    </script>
@endsection