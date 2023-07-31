@extends('components.layout')

@section('contents')
    <!-- Content Header (Page header) -->
    @php
        $breadcrumb = '<li class="breadcrumb-item"><a href="">Dashboard</a></li>';
        $breadcrumb .= '<li class="breadcrumb-item"><a href="">Register New Cow</a></li>';
        $breadcrumb .= '<li class="breadcrumb-item active">Create</li>';
    @endphp
    <x-backend-breadcrumb title="Register New Cow" breadcrumb="{{ $breadcrumb }}" />
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


                        <div class="card-body">
                            {{ Form::open(['url' => URL::to('cow/register-store'), 'files' => true, 'class' => 'multiple-form-submit']) }}
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Cow Name</label>
                                        <input type="text" class="form-control" placeholder="Cow Name"
                                            name="title" value="{{ old('title') }}" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Select Breed</label>
                                        {!! Form::select('breed_id',  $breed, null, [
                                            'placeholder' => 'Select Breed',
                                            'class' => 'form-control',
                                            'id' => 'breed',
                                            'required' => 'required',
                                        ]) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row" id="cross_breed" style="display: {{ old('breed_id') == 13 ? 'block' : 'none' }}">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Select Breed 1</label>
                                        {!! Form::select('cow_breeding_1',  $breed, null, [
                                            'placeholder' => 'Select Breed 1',
                                            'class' => 'form-control',
                                            'id' => 'breed1',
                                        ]) !!}
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Select Breed 2</label>
                                        {!! Form::select('cow_breeding_2',  $breed, null, [
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
                                        <label>Select Cow Group</label>
                                        {!! Form::select('group_id', $group, null, [
                                            'placeholder' => 'Select Cow Group',
                                            'class' => 'form-control',
                                            'id' => 'group',
                                        ]) !!}
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Date of Birth:</label>
                                        <input type="date" id="birth_date" class="form-control" placeholder="Date of Birth" name="date_of_birth" value="{{ old('date_of_birth') }}" max="{{ date('Y-m-d') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group"> <span style="color: red;"></span>
                                        <label>No of Calvings/Lactations</label>
                                        <input type="number" class="form-control" placeholder="No of Calvings/Lactations"
                                            name="calving_lactation" value="{{ old('calving_lactation') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary multiple-form-submit">Save</button>
                                    </div>
                                </div>
                            </div>
                            {{ Form::close() }}

                            {{ Form::open(['url' => URL::to('cow/register-excel-store'), 'files' => true, 'class' => 'multiple-form-submit']) }}
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label>------------------------OR---------------------</label>
                                    </div>
                                    <div style="color: red">
                                        <b>Notes:</b>
                                        <ul>
                                            <li>You can download sample file from here. <a href="{{ asset('assets/upload/cow_upload.xlsx') }}" target="_blank">Download</a></li>
                                            <li>File should be .CSV (comma-delimited) only. Better you dwonload sample file and change in it.</li>
                                            <li>Spelling mistake in breed and cow group can create error in insert.</li>
                                            <li>"No of Calvings/Lactations" should be number only</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label>Upload CSV file</label>
                                        <input type="file" class="form-control" name="excel_file" />
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary multiple-form-submit">Upload</button>
                                    </div>
                                </div>
                            </div>
                            {{ Form::close() }}
                        </div>
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
            var breedValue = document.getElementById('breed').value;
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
        document.getElementById('breed').addEventListener('change', toggleCrossBreedDiv);
    </script>
@endsection
