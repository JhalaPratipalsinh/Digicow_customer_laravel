@extends('components.layout')

@section('contents')
<!-- Content Header (Page header) -->
@php
$breadcrumb = '<li class="breadcrumb-item"><a href="">Dashboard</a></li>';
$breadcrumb .= '<li class="breadcrumb-item"><a href="">Milking Time</a></li>';
$breadcrumb .= '<li class="breadcrumb-item active">Create</li>';
@endphp
<x-backend-breadcrumb title="Milking Time" breadcrumb="{{ $breadcrumb }}" />
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
                    {{ Form::open(['url' => URL::to('record-milk-production-store/all-milk-store'), 'files' => true, 'class' => 'multiple-form-submit']) }}

                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Select Cow</label>
                                    {!! Form::select('cow', $cow, null, [
                                    'placeholder' => 'Cows Name',
                                    'class' => 'form-control',
                                    'id' => 'breed',
                                    ]) !!}
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Milk Production Date:</label>
                                    <input type="date" class="form-control" placeholder="Date" name="milking_date" value="{{ old('milking_date') }}" max="{{ date('Y-m-d') }}" required>
                                </div>
                            </div>
                        </div>

                
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Morning</label>
                                    <input type="text" class="form-control" placeholder="Morning" name="morning" value="{{ old('morning') }}">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Afternoon</label>
                                    <input type="text" class="form-control" placeholder="Afternoon" name="afternoon" value="{{ old('afternoon') }}">
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Evening</label>
                                    <input type="text" class="form-control" placeholder="Evening" name="evening" value="{{ old('evening') }}">
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

        if (breedValue == 13) {
            crossBreedDiv.style.display = 'block';
        } else {
            crossBreedDiv.style.display = 'none';
        }
    }

    // Call the toggleCrossBreedDiv function on page load
    toggleCrossBreedDiv();

    // Add an event listener to the breed select element
    document.getElementById('breed_select').addEventListener('change', toggleCrossBreedDiv);
</script>
@endsection
