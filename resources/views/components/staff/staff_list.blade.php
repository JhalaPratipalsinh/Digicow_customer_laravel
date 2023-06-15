@extends('components.layout')


@section('styles')

<!-- <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet"> -->
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css"> -->
<!-- <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/css/bootstrap-switch-button.min.css" rel="stylesheet"> -->
@endsection

@section('contents')
<!-- Content Header (Page header) -->
@php
$breadcrumb = '<li class="breadcrumb-item"><a href="">Dashboard</a></li>';
$breadcrumb .= '<li class="breadcrumb-item active">Staff List</li>';
@endphp
<x-backend-breadcrumb title="Staff List" breadcrumb="{{$breadcrumb}}" />
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
                        {{-- <a href="{{ URL::to('vet/create') }}" class="btn btn-primary btn-sm mr-2" style="float:right"><i class="fas fa-plus"></i> Add AI Provider</a> --}}
                    </div>
                    <!-- /.card-header -->

                    <!-- .card-body -->
                    <div class="card-body">
                        <!-- <div style="float: left;"><b>Today Registered Students</b></div> -->
                        <!-- <a class="btn btn-primary btn-sm" style="float:right">Add Coach</a> -->
                        <table id="staff-list" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <td>No</td>
                                    <th>Staff Name</th>
                                    <th>Mobile</th>
                                    <th>Location</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                ?>

                                @foreach ($staff as $stafVal)
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$stafVal['name']}}</td>
                                    <td>{{$stafVal['staff_mobile_number']}}</td>
                                    <td>{{$stafVal['location']}}</td>
                                    @if ($stafVal['status'] == 'active')
                                    <td><span class="badge bg-success">{{$stafVal['status']}}</span></td>
                                    @else
                                    <td><span class="badge bg-danger">{{$stafVal['status']}}</span></td>
                                    @endif
                                    <td>
                                        <?php $checked = ($stafVal['status'] == 'active') ? 1 : 0; ?>
                                        <input data-id="{{$stafVal['id']}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-size="small" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $checked ? 'checked' : '' }}>

                                        &nbsp

                                        <a href="{{ URL('/staff/staff-edit/'.$stafVal['id'] )}}" class="btn btn-sm btn-success" title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php
                                $i++;
                                ?>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
@endsection

@section('scripts')

<!-- <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script> -->
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script>

$('#staff-list').DataTable({});
    $(function() {
        $('.toggle-class').change(function() {
            var status = $(this).prop('checked') == true ? 'active' : 'deleted';
            var user_id = $(this).data('id');
            $.ajax({
                type: "GET",
                dataType: "json",
                url: BASE_URL + '/staff/change-status',
                data: {
                    'status': status,
                    'user_id': user_id
                },
                success: function(data) {
                    console.log(data.success)
                }
            });
        })
    })
</script>
<!-- <script src="{{ asset('assets/dist/js/staff.js') }}"></script> -->
@endsection
