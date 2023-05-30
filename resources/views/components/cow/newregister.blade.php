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
                        {{ Form::open(['url' => URL::to('cow/register-store'), 'files' => true, 'class' => 'multiple-form-submit']) }}

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Cow Name</label>
                                        <input type="text" class="form-control" placeholder="Cow Name"
                                            name="title" value="{{ old('title') }}">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Select Breed</label>
                                        {!! Form::select('breed_id',  $breed, null, [
                                            'placeholder' => 'Select Breed',
                                            'class' => 'form-control',
                                            'id' => 'breed',
                                        ]) !!}
                                    </div>
                                </div>

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


                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Date of Birth:</label>
                                        <input type="date" class="form-control" placeholder="Date of Birth" name="date_of_birth" value="{{ old('date_of_birth') }}">
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

                        <div class="card-footer">
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
          </script>
@endsection
