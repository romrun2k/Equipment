@extends('layouts.app')

@section('pagetitle')
    <h1 class="">Equipment List</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item active">Equipment</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="text-right">
        <button class="btn btn-primary mb-3" onclick="addModal()"> <i class="bi bi-plus-circle"></i> Add</button>
    </div>

    <table id="tbl_equipment" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th class="text-center">No.</th>
                <th class="text-center" width="40%">Name</th>
                <th class="text-center">Type</th>
                <th class="text-right">Price</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>

    @include('master_equipment.modal.equipment')
@endsection

@section('script')
    @include('master_equipment.script')
@endsection
