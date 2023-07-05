@extends('components.layout')

@section('contents')
<!-- Content Header (Page header) -->
@php
$breadcrumb = '<li class="breadcrumb-item"><a href="">Dashboard</a></li>';
$breadcrumb .= '<li class="breadcrumb-item"><a href="">Record New Expense Record</a></li>';
$breadcrumb .= '<li class="breadcrumb-item active">Create</li>';
@endphp
<x-backend-breadcrumb title="Record New Expense Record" breadcrumb="{{ $breadcrumb }}" />
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
                    </div>
                    <!-- /.card-header -->

                    <!-- .card-body -->
                    {{ Form::open(['url' => URL::to('other_expenses/expense-store'), 'files' => true, 'class' => 'multiple-form-submit']) }}

                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Name/Title</label>
                                    <input type="text" class="form-control" placeholder="Name/Title" name="name" value="{{ old('name') }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Amount</label>
                                    <input type="text" class="form-control" placeholder="Amount" name="amount" value="{{ old('amount') }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Date</label>
                                    <input type="date" class="form-control" placeholder="Date Paid" name="date_selected" value="{{ old('date_selected') }}">
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
