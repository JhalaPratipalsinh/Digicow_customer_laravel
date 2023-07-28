@extends('components.layout')

@section('contents')
<!-- Content Header (Page header) -->
@php
$breadcrumb = '<li class="breadcrumb-item"><a href="">Dashboard</a></li>';
$breadcrumb .= '<li class="breadcrumb-item"><a href="">Register New Milk Sales Customer</a></li>';
$breadcrumb .= '<li class="breadcrumb-item active">Create</li>';
@endphp
<x-backend-breadcrumb title="Register New Milk Sales Customer" breadcrumb="{{ $breadcrumb }}" />
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
                    {{ Form::open(['url' => URL::to('milk-sales/customer-store'), 'files' => true, 'class' => 'multiple-form-submit']) }}

                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Customers Name</label>
                                    {!! Form::select('consumer_id', $farmer_client, null, [
                                    'placeholder' => '--select--',
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
                                    <label>Select Date:</label>
                                    <input type="date" class="form-control" placeholder="Select Date" name="milk_sales_date" value="{{ old('milk_sales_date') }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Select Time</label>
                                    <select class="form-control" required name="milk_time">
                                        <option value="" selected disabled>--select--</option>
                                        <option value="1">Morning(Asubuhi)</option>
                                        <option value="2">Afternoon(Mchana)</option>
                                        <option value="3">Evening(Jioni)</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Quantity in KGs</label>
                                    <input type="text" class="form-control" placeholder="Quantity" name="quantity" value="{{ old('quantity') }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Market Price</label>
                                    <input type="text" class="form-control" placeholder="Market Price" name="milk_price" value="{{ old('milk_price') }}" required>
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
