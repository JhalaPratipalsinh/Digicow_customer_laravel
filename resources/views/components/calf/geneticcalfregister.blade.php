@extends('components.layout')

@section('contents')
    <!-- Content Header (Page header) -->
    @php
        $breadcrumb = '<li class="breadcrumb-item"><a href="">Dashboard</a></li>';
        $breadcrumb .= '<li class="breadcrumb-item"><a href="">Add cow genetic record</a></li>';
        $breadcrumb .= '<li class="breadcrumb-item active">Create</li>';
    @endphp
    <x-backend-breadcrumb title="Add cow genetic record" breadcrumb="{{ $breadcrumb }}" />
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
                        {{ Form::open(['url' => URL::to('calfs/genetic-store'), 'files' => true, 'class' => 'multiple-form-submit']) }}

                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Calfs Name</label>
                                        {!! Form::select('cow_id', $cow, null, [
                                            'placeholder' => 'Calfs Name',
                                            'class' => 'form-control',
                                            'id' => 'breed',
                                        ]) !!}
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Calf code / Ear tag number</label>
                                        <input type="text" class="form-control" placeholder="Select code" name="calf_code"
                                            value="{{ old('calf_code') }}">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Dam</label>
                                        <input type="text" class="form-control" placeholder="Cause of Death"
                                            name="dam" value="{{ old('dam') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Dam Code</label>
                                        <input type="text" class="form-control" placeholder="Cause of Death"
                                            name="dam_code" value="{{ old('dam_code') }}">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Dam Father</label>
                                        <input type="text" class="form-control" placeholder="Carcass Amount"
                                            name="dam_father" value="{{ old('dam_father') }}">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Dam Father Code</label>
                                        <input type="text" class="form-control" placeholder="Carcass Amount"
                                            name="dam_father_code" value="{{ old('dam_father_code') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Dam Mother</label>
                                        <input type="text" class="form-control" placeholder="Carcass Amount"
                                            name="dam_mother" value="{{ old('dam_mother') }}">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Dam Mother Code</label>
                                        <input type="text" class="form-control" placeholder="Carcass Amount"
                                            name="dam_mother_code" value="{{ old('dam_mother_code') }}">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Sire</label>
                                        <input type="text" class="form-control" placeholder="Carcass Amount"
                                            name="sire" value="{{ old('sire') }}">
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Sire Code</label>
                                        <input type="text" class="form-control" placeholder="Carcass Amount"
                                            name="sire_code" value="{{ old('sire_code') }}">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Sire Father</label>
                                        <input type="text" class="form-control" placeholder="Carcass Amount"
                                            name="sire_father" value="{{ old('sire_father') }}">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Sire Father Code</label>
                                        <input type="text" class="form-control" placeholder="Carcass Amount"
                                            name="sire_father_code" value="{{ old('sire_father_code') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Sire Mother</label>
                                        <input type="text" class="form-control" placeholder="Carcass Amount"
                                            name="sire_mother" value="{{ old('sire_mother') }}">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Sire Mother Code</label>
                                        <input type="text" class="form-control" placeholder="Carcass Amount"
                                            name="sire_mother_code" value="{{ old('sire_mother_code') }}">
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
