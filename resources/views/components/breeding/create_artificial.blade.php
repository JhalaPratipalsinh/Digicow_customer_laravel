@extends('components.layout')

@section('contents')
<!-- Content Header (Page header) -->
@php
$breadcrumb = '<li class="breadcrumb-item"><a href="">Dashboard</a></li>';
$breadcrumb .= '<li class="breadcrumb-item"><a href="">Record New Breeding Record</a></li>';
$breadcrumb .= '<li class="breadcrumb-item active">Create</li>';
@endphp
<x-backend-breadcrumb title="Record New Breeding Record" breadcrumb="{{ $breadcrumb }}" />
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
                    {{ Form::open(['url' => URL::to('artificial-insemination/artificial-store'), 'files' => true, 'class' => 'multiple-form-submit']) }}

                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Select Cow</label>
                                    {!! Form::select('cow_id', $cow, null, [
                                    'placeholder' => 'Cows Name',
                                    'class' => 'form-control',
                                    'id' => 'breed',
                                    ]) !!}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Bull Name</label>
                                    <input type="text" class="form-control" placeholder="Bull Name" name="bull_name" value="{{ old('bull_name') }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Bull Code</label>
                                    <input type="text" class="form-control" placeholder="Bull Code" name="bull_code" value="{{ old('bull_code') }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Cost</label>
                                    <input type="text" class="form-control" placeholder="Cost" name="cost" value="{{ old('cost') }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Date of AI:</label>
                                    <input type="date" class="form-control" placeholder="Date of AI" name="date" value="{{ old('date') }}">
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
