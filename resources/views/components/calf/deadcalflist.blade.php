@extends('components.layout')

@section('contents')
<!-- Content Header (Page header) -->
@php
$breadcrumb = '<li class="breadcrumb-item"><a href="">Dashboard</a></li>';
$breadcrumb .= '<li class="breadcrumb-item active">Dead Calf List</li>';
@endphp
<x-backend-breadcrumb title="Dead Calf List" breadcrumb="{{$breadcrumb}}" />
<!-- /.content-header -->

<!-- Main content -->
<section class="content">

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- .card-header -->
                    <div class="card-header">
                        <h3 class="card-title"></h3>
                        @include('components.alert.validation-error')
                        {{--  <a href="{{ URL::to('vet/create') }}" class="btn btn-primary btn-sm mr-2" style="float:right"><i class="fas fa-plus"></i> Add AI Provider</a>  --}}
                    </div>
                    <!-- /.card-header -->

                    <!-- .card-body -->
                    <div class="card-body">
                        <!-- <div style="float: left;"><b>Today Registered Students</b></div> -->
                        <!-- <a class="btn btn-primary btn-sm" style="float:right">Add Coach</a> -->
                        <table id="dead-calf-list" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Calf Name</th>
                                    <th>Cause of Death</th>
                                    <th>Date of Death</th>
                                    <th>Carcass Amount</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
@endsection

@section('scripts')
<script src="{{ asset('assets/dist/js/deadcalflist.js') }}"></script>
@endsection
