@extends('components.layout')

@section('contents')
<!-- Content Header (Page header) -->
@php
$breadcrumb = '<li class="breadcrumb-item"><a href="">Dashboard</a></li>';
$breadcrumb .= '<li class="breadcrumb-item"><a href="">Register New Staff</a></li>';
$breadcrumb .= '<li class="breadcrumb-item active">Create</li>';
@endphp
<x-backend-breadcrumb title="Register New Staff" breadcrumb="{{ $breadcrumb }}" />
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
                    {{ Form::open(['url' => URL::to('staff/staff-store'), 'files' => true, 'class' => 'multiple-form-submit']) }}

                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Staff Name</label>
                                    <input type="text" class="form-control" placeholder="Staff Name" name="name" value="{{ old('name') }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Staff Mobile No</label>
                                    <input type="text" class="form-control" placeholder="Staff Mobile No" name="staff_mobile_number" value="{{ old('staff_mobile_number') }}">
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Enter New PIN</label>
                                    <input type="text" class="form-control" placeholder="Enter New PIN" name="pin" value="{{ old('pin') }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Confirm PIN</label>
                                    <input type="text" class="form-control" placeholder="Confirm PIN" name="confirm_pin" value="{{ old('confirm_pin') }}">
                                </div>
                            </div>
                        </div>

                        {{-- <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Staff ID</label>
                                    <input type="text" class="form-control" placeholder="Staff ID" name="id_number" value="{{ old('id_number') }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Farm's Location</label>
                                    <input type="text" class="form-control" placeholder="Farm's Location" name="location" value="{{ old('location') }}">
                                </div>
                            </div>
                        </div> --}}
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
