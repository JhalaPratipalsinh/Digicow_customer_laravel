@extends('components.layout')

@section('contents')
<!-- Content Header (Page header) -->
@php
$breadcrumb = '<li class="breadcrumb-item"><a href="">Dashboard</a></li>';
$breadcrumb .= '<li class="breadcrumb-item"><a href="">Record New Health Dewormer Record</a></li>';
$breadcrumb .= '<li class="breadcrumb-item active">Create</li>';
@endphp
<x-backend-breadcrumb title="Record New Health Dewormer Record" breadcrumb="{{ $breadcrumb }}" />
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
                        <!-- <a href="{{ URL::to('backend/student/create') }}" class="btn btn-primary btn-sm mr-2" style="float:right"><i class="fas fa-plus"></i> Create</a> -->
                    </div>
                    <!-- /.card-header -->

                    <!-- .card-body -->
                    {{ Form::open(['url' => URL::to('health-record/dewormer-store'), 'files' => true, 'class' => 'multiple-form-submit']) }}

                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Select Cow</label>
                                    {!! Form::select('cow_id', $cow, null, [
                                    'placeholder' => 'Cows Name',
                                    'class' => 'form-control',
                                    'id' => 'breed',
                                    'required' => 'required',
                                    ]) !!}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Date of De-wormer Record:</label>
                                    <input type="date" required class="form-control" placeholder="Date of De-wormer Record" name="treatment_date" value="{{ old('treatment_date') }}" max="{{ date('Y-m-d') }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>De-wormer</label>
                                    <input type="text" required class="form-control" placeholder="De-wormer" name="diagnosis" value="{{ old('diagnosis') }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Cost</label>
                                    <input type="text" required class="form-control" placeholder="Cost" name="cost" value="{{ old('cost') }}">
                                </div>
                            </div>
                        </div>

                        <br>

                        <div>
                            <button type="submit" class="btn btn-primary multiple-form-submit">Save</button>
                        </div>
                        {{ Form::close() }}
                        <!-- /.card-body -->
                    </div>
                </div>
                <input type="hidden" id="base_url" value="{{ url('') }}">
            </div>
        </div>
</section>
<!-- /.content -->
@endsection

@section('scripts')
<!-- <script src="{{ asset('assets/dist/js/vet.js') }}"></script> -->

<script></script>
@endsection
