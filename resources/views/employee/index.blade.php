@extends('layouts.app')

@section('pagetitle')
    <h1 class="">Employee List</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item active">Employee</li>
        </ol>
    </nav>
@endsection

@section('content')
    <table id="tbl_employee" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th class="text-center">No.</th>
                <th class="text-center">Name</th>
                <th class="text-center">Email</th>
                <th class="text-center">Total Price</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
        
        </tbody>
    </table>
    @include('employee.modal.view_detail')
@endsection

@section('script')
    @include('employee.script')
@endsection
