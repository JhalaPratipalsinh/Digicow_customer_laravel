@extends('components.layout')

@section('contents')
    <!-- Content Header (Page header) -->
    @php
        $breadcrumb = '<li class="breadcrumb-item"><a href="">Dashboard</a></li>';
        $breadcrumb .= '<li class="breadcrumb-item"><a href="">Add calf to dead</a></li>';
        $breadcrumb .= '<li class="breadcrumb-item active">Create</li>';
    @endphp
    <x-backend-breadcrumb title="Add calf to dead" breadcrumb="{{ $breadcrumb }}" />
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
                        {{ Form::open(['url' => URL::to('calfs/dead-store'), 'files' => true, 'class' => 'multiple-form-submit']) }}

                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Calf Name</label>
                                        {!! Form::select('cow_id', $cow, null, [
                                            'placeholder' => 'Calf Name',
                                            'class' => 'form-control',
                                            'id' => 'breed',
                                        ]) !!}
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Death Date:</label>
                                        <input type="date" class="form-control" placeholder="Select Date"
                                            name="death_date" value="{{ old('death_date') }}">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Cause of Death</label>
                                        <input type="text" class="form-control" placeholder="Cause of Death"
                                            name="cause_of_death" value="{{ old('cause_of_death') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Carcass Amount</label>
                                        <input type="text" class="form-control" placeholder="Carcass Amount" name="carcass_amount"
                                            value="{{ old('carcass_amount') }}">
                                    </div>
                                </div>
                            </div>
                            <br>

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

    <script></script>
@endsection
