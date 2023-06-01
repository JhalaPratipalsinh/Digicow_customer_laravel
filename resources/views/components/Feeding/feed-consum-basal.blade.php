@extends('components.layout')

@section('contents')
    <!-- Content Header (Page header) -->
    @php
        $breadcrumb = '<li class="breadcrumb-item"><a href="">Dashboard</a></li>';
        $breadcrumb .= '<li class="breadcrumb-item"><a href="">Add Feed Consumption Hay</a></li>';
        $breadcrumb .= '<li class="breadcrumb-item active">Create</li>';
    @endphp
    <x-backend-breadcrumb title="Add Feed Consumption Hay" breadcrumb="{{ $breadcrumb }}" />
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
                        <div class="row">
                            <div class="col-4">
                                <a href="{{ URL::to('feeding/feed-consum-grass-create') }}"><button type="button" class="btn btn-block btn-primary btn-lg">Napier Grass</button></a>
                            </div>
                            <div class="col-4">
                                <a href="{{ URL::to('feeding/feed-consum-hay-create') }}"><button type="button" class="btn btn-block btn-success btn-lg">Hay</button></a>
                            </div>
                            <div class="col-4">
                                <a href="{{ URL::to('feeding/feed-consum-other-create') }}"><button type="button" class="btn btn-block btn-info btn-lg">Other</button></a>
                            </div>
                        </div>
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
