@extends('layouts.app')

@section('pagetitle')
    <h1 class="">Orders</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item active">Order</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="text-right">
        <button class="btn btn-primary mb-3" onclick="addModal()"> <i class="bi bi-plus-circle"></i> Add</button>
    </div>

    <table id="tbl_odrer" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th class="text-center">No.</th>
                <th class="text-right">Total Price</th>
                <th class="text-center">Date</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>

    @include('orders.modal.order')
    @include('orders.modal.view_detail')
@endsection

@section('script')
    @include('orders.script')
@endsection
