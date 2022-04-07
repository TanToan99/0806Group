@extends('layouts.admin')

@section('custom-css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" /><!-- CSS -->
<link rel="stylesheet" href="https//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
<!-- Default theme -->
<link rel="stylesheet" href="https//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
@endsection

@section('content')
<div class="container">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">List Department</li>
                </ol>
            </div>
            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
        </div>
    </div>
    <div class="card">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">List Department</h6>
            @if (auth()->user()->hasRole('admin'))
            <a class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Create Department
            </a>
            @endif
        </div>
        <div class="card-body">
            <table id="users-table" class="table table-responsive" style="width:100%">
                <thead class="thread-light">
                    <tr class="col">
                        <th class="col-1">Department Name</th>
                        <th class="col-1">Account</th>
                        <th class="col-1">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create new department</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.department.createDpm') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group @error('name') is-invalid @enderror">
                        <label for="name">Department name:</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="">
                    </div>
                    @if ($errors->has('name'))
                    <span>
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </span>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning">Add Department</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('custom-js')
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<script>
    $(document).ready(function() {
        $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{url('/admin/department/dt-row-data')}}',
            columns: [{
                    data: 'name',
                    name: 'name',
                },
                {
                    data: 'account',
                    name: 'account',
                },
                {
                    data: 'action',
                    name: 'action'
                }
            ]
        });
        $('#users-table_wrapper').removeClass('form-inline');
    });
</script>
<script>
    @if ($errors->has('name'))
        var delayInMilliseconds = 1000;
        setTimeout(function() {
        $("#exampleModal").modal('show');
        }, delayInMilliseconds);
    @endif
</script>
@endsection
