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
                                    <label>Date of AI:</label>
                                    <input type="date" class="form-control" placeholder="Date of AI" name="date" value="{{ old('date') }}" max="{{ date('Y-m-d') }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Select Bull Breed</label>
                                    {!! Form::select('straw_breed',  $breed, null, [
                                        'placeholder' => 'Select Breed',
                                        'class' => 'form-control',
                                        'id' => 'breed_select',
                                    ]) !!}
                                </div>
                            </div>
                        </div>

                        <div class="row" id="cross_breed" style="display: {{ old('breed_id') == 13 ? 'block' : 'none' }}">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Select Breed 1</label>
                                    {!! Form::select('breed1',  $breed, null, [
                                        'placeholder' => 'Select Breed 1',
                                        'class' => 'form-control',
                                        'id' => 'breed1',
                                    ]) !!}
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Select Breed 2</label>
                                    {!! Form::select('breed2',  $breed, null, [
                                        'placeholder' => 'Select Breed 2',
                                        'class' => 'form-control',
                                        'id' => 'breed2',
                                    ]) !!}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Bull Name</label>
                                    <input type="text" class="form-control" placeholder="Bull Name" name="bull_name" value="{{ old('bull_name') }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Bull Code</label>
                                    <input type="text" class="form-control" placeholder="Bull Code" name="bull_code" value="{{ old('bull_code') }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Cost</label>
                                    <input type="text" class="form-control" placeholder="Cost" name="cost" value="{{ old('cost') }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Enter No. Straw</label>
                                    <input type="text" class="form-control" placeholder="Enter No. Straw" name="no_straw" value="{{ old('no_straw') }}" required>
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

<script>
    // Function to show/hide the cross_breed div based on the breed selection
    function toggleCrossBreedDiv() {
        var breedValue = document.getElementById('breed_select').value;
        var crossBreedDiv = document.getElementById('cross_breed');
        var breed1Input = document.getElementById('breed1');
        var breed2Input = document.getElementById('breed2');

        if (breedValue == 13) {
            crossBreedDiv.style.display = 'block';
            breed1Input.setAttribute('required', 'required'); // Set required attribute
            breed2Input.setAttribute('required', 'required'); // Set required attribute
        } else {
            crossBreedDiv.style.display = 'none';
            breed1Input.removeAttribute('required'); // Remove required attribute
            breed2Input.removeAttribute('required'); // Remove required attribute
        }
    }

    // Call the toggleCrossBreedDiv function on page load
    toggleCrossBreedDiv();

    // Add an event listener to the breed select element
    document.getElementById('breed_select').addEventListener('change', toggleCrossBreedDiv);
</script>
@endsection
