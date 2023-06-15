@extends('components.layout')


@section('styles')

@endsection

@section('contents')
<!-- Content Header (Page header) -->
@php
$breadcrumb = '<li class="breadcrumb-item"><a href="">Dashboard</a></li>';
$breadcrumb .= '<li class="breadcrumb-item active">Breeding List</li>';
@endphp
<x-backend-breadcrumb title="Breeding List" breadcrumb="{{$breadcrumb}}" />
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
                        {{-- <a href="{{ URL::to('vet/create') }}" class="btn btn-primary btn-sm mr-2" style="float:right"><i class="fas fa-plus"></i> Add AI Provider</a> --}}
                    </div>
                    <!-- /.card-header -->

                    <!-- .card-body -->
                    <div class="card-body">
                        <!-- <div style="float: left;"><b>Today Registered Students</b></div> -->
                        <!-- <a class="btn btn-primary btn-sm" style="float:right">Add Coach</a> -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box">
                                    <!-- {{ Form::open(['url' => URL::to('record-milk-production/json-per-cow'), 'files' => true, 'id' => 'form1', 'class' => 'multiple-form-submit']) }} -->

                                    <!-- <div class="row" style="margin-left: 0px !important;">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>From Date:</label>
                                                <input type="date" id="from_date" name="from_date" value="{{ isset($from_date) ? $from_date : '' }}" class="form-control" />

                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>To Date:</label>
                                                <input type="date" id="to_date" name="to_date" value="{{ isset($to_date) ? $to_date : '' }}" class="form-control" />

                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>&nbsp;</label>
                                                <a href="#graph"><button type="button" style="margin-top: 25px !important;" class="btn btn-primary">View Graphs</button></a>
                                            </div>
                                        </div>

                                    </div> -->
                                    <!-- {{ Form::close() }} -->
                                </div>
                            </div>
                        </div>

                        <table id="arifical-list" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Cow Name</th>
                                    <th>Bull Name</th>
                                    <th>Bull Code</th>
                                    <th>Cost</th>
                                    <th>Date inseminated</th>
                                    <th>Confirmation Date</th>
                                    <th>Confirmation Status</th>
                                    <th>Repeat Date</th>
                                    <th>Drying Date</th>
                                    <th>Streaming Up Date</th>
                                    <th>Calving Date</th>
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

<script src="{{ asset('assets/dist/js/artifial.js') }}"></script>
@endsection
