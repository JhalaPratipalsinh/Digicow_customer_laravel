@extends('components.layout')

@section('contents')
    <!-- Content Header (Page header) -->
    @php
        $breadcrumb = '<li class="breadcrumb-item"><a href="">Dashboard</a></li>';
        $breadcrumb .= '<li class="breadcrumb-item active">Record Milk Production</li>';
    @endphp
    <x-backend-breadcrumb title="Record Milk Production" breadcrumb="{{ $breadcrumb }}" />
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
                            {{--  <a href="{{ URL::to('vet/create') }}" class="btn btn-primary btn-sm mr-2" style="float:right"><i class="fas fa-plus"></i> Add AI Provider</a>  --}}
                        </div>
                        <!-- /.card-header -->

                        <!-- .card-body -->

                        {{ Form::open(['url' => URL::to('record-milk-production/milk-store'), 'files' => true, 'class' => 'multiple-form-submit']) }}

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Milk Production Date:</label>
                                        <input type="date" required name="milk_date"
                                            class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <!-- <div style="float: left;"><b>Today Registered Students</b></div> -->
                            <!-- <a class="btn btn-primary btn-sm" style="float:right">Add Coach</a> -->
                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Select</th>
                                        <th>Cow Name</th>
                                        <th>Morning</th>
                                        <th>Afternoon</th>
                                        <th>Evening</th>
                                        <th>Whole Day</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i=0;
                                    foreach ( $cows as $row )
                                    {
                                        if($row['status']=="active")
                                        {
                                        $i++;
                                ?>
                                    <tr class="milk">
                                        <td>
                                            <div class="form-group">
                                                <input type="checkbox" name="cow[]" value="<?php echo $row['title'] . '|' . $row['id']; ?>"
                                                    class="cowcheck" />
                                            </div>
                                        </td>
                                        <td>
                                            <span class="title"><?php echo $row['title']; ?></span>
                                            <div class="cow_name">
                                                {{--  <input type="hidden" name="cow_name[]" value="<?php echo $row['title'] . '|' . $row['id']; ?>">
                                            </div>  --}}
                                        </td>
                                        <td class="morining">
                                            {{--  <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Morning"
                                                    name="morning[]" value="{{ old('milk_quantity') }}">
                                            </div>  --}}
                                        </td>
                                        <td class="afternoon">
                                            {{--  <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Afternoon"
                                                    name="afternoon[]" value="{{ old('death_date') }}">
                                            </div>  --}}
                                        </td>
                                        <td class="evening">
                                            {{--  <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Evening"
                                                    name="evening[]" value="{{ old('death_date') }}">
                                            </div>  --}}
                                        </td>
                                        <td class="whole">
                                            {{--  <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Whole Dayg"
                                                    name="wholedayg[]" value="{{ old('death_date') }}">
                                            </div>  --}}
                                        </td>

                                    </tr>
                                    <?php
                                        }
                                    }
                                ?>
                                    <input type="hidden" name="cow_count" value="<?php echo $i; ?>">
                                </tbody>
                            </table>
                        </div>
                        <br>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary multiple-form-submit">Save</button>
                        </div>
                        {{ Form::close() }}
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection

@section('scripts')
    <script>
        $('.cowcheck').click(function() {
            //$("#txtAge").toggle(this.checked);
            if (this.checked) {
                //console.log($(this).closest('.milk'));
                morning = `<div class="form-group">
                    <input type="text" class="form-control" placeholder="Morning"
                        name="morning[]" value=''>
                </div>`;
                afternoon = `
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Afternoon"
                            name="afternoon[]" value=''>
                    </div>`;
                evening = `<div class="form-group">
                    <input type="text" class="form-control" placeholder="Evening"
                        name="evening[]" value="">
                </div>`;
                whole = `<div class="form-group">
                    <input type="text" class="form-control" placeholder="Whole Dayg"
                        name="wholedayg[]" value="">
                </div>`;

                $($(this).closest('.milk')).find('.morining').html(morning);
                $($(this).closest('.milk')).find('.afternoon').html(afternoon);
                $($(this).closest('.milk')).find('.evening').html(evening);
                $($(this).closest('.milk')).find('.whole').html(whole);


            } else {
                $($(this).closest('.milk')).find('.morining').empty();
                $($(this).closest('.milk')).find('.afternoon').empty();
                $($(this).closest('.milk')).find('.evening').empty();
                $($(this).closest('.milk')).find('.whole').empty();
                $($(this).closest('.milk')).find('.cow_name').empty();

            }
        });
    </script>
@endsection
