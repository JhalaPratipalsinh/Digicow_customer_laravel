@extends('components.layout')

@section('contents')
    <!-- Content Header (Page header) -->
    @php
        $breadcrumb = '<li class="breadcrumb-item"><a href="">Dashboard</a></li>';
        $breadcrumb .= '<li class="breadcrumb-item"><a href="">Add Feed Consumption Minerals</a></li>';
        $breadcrumb .= '<li class="breadcrumb-item active">Create</li>';
    @endphp
    <x-backend-breadcrumb title="Add Feed Consumption Minerals" breadcrumb="{{ $breadcrumb }}" />
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
                        {{ Form::open(['url' => URL::to('feeding/feed-minerals-store'), 'files' => true, 'class' => 'multiple-form-submit']) }}

                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Select Date:</label>
                                        <input type="date" class="form-control" placeholder="Select Date"
                                        name="date_selected" value="{{ old('date_selected') }}" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Select Feed:</label>
                                        <select class="form-control" required name="feed">
                                            <option value="" selected disabled>--select--</option>
                                            <option value="Mineral licks">Mineral licks</option>
                                            <option value="Feed Additives - yeast">Feed Additives - yeast</option>
                                            <option value="Under Boost">Under Boost</option>
                                            <option value="Milking serve">Milking serve</option>
                                            <option value="Epsom salt">Epsom salt</option>
                                            <option value="Caulin">Caulin</option>
                                            <option value="Sulphur drugs">Sulphur drugs</option>
                                            <option value="Alamycin spray">Alamycin spray</option>
                                            <option value="Calcium">Calcium</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Select Units:</label>
                                        <select class="form-control" required name="units">
                                            <option value="" selected disabled>--select--</option>
                                            <option value="KGs">KGs</option>
                                            <option value="Litres">Litres</option>
                                            <option value="Ml">Ml</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Quantity in KGs</label>
                                        <input type="text" class="form-control" placeholder="Quantity"
                                            name="quantity" value="{{ old('quantity') }}" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Enter Price</label>
                                        <input type="text" class="form-control" placeholder="Total" name="total"
                                            value="{{ old('total') }}" required>
                                    </div>
                                </div>
                            </div>
                            <br>

                            <div >
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
