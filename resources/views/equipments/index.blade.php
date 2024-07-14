@extends('layouts.app')
@php
    $idBtn = 'btnAddModal';
    $idModal = 'equipmentModal';
    $target = '#equipmentModal';
    $btn = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btn_save">Save</button>';
@endphp

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
        <x-button :id="$idBtn" :target="$target"></x-button>
    </div>

    <table id="equipmentsTable" class="table table-striped table-bordered" style="width:100%">
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

    @include('equipments.modal.equipment')
@endsection

@section('script')
    @include('equipments.script')
@endsection
