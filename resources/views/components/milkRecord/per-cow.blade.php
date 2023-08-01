@extends('components.layout')

@section('contents')
    <!-- Content Header (Page header) -->
    @php
        $breadcrumb = '<li class="breadcrumb-item"><a href="">Dashboard</a></li>';
        $breadcrumb .= '<li class="breadcrumb-item active">Milk Production Report for Per Cow</li>';
    @endphp
    <x-backend-breadcrumb title="Milk Production Report for Per Cow" breadcrumb="{{ $breadcrumb }}" />
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
                        <div class="card-body">
                            <!-- <div style="float: left;"><b>Today Registered Students</b></div> -->
                            <!-- <a class="btn btn-primary btn-sm" style="float:right">Add Coach</a> -->

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="box">
                                        {{ Form::open(['url' => URL::to('record-milk-production/json-per-cow'), 'files' => true, 'id' => 'form1', 'class' => 'multiple-form-submit']) }}

                                        <div class="row" style="margin-left: 0px !important;">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>From Date:</label>
                                                    <input type="date" id="from_date" name="from_date"
                                                        value="{{ isset($from_date) ? $from_date : '' }}"
                                                        class="form-control" />

                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>To Date:</label>
                                                    <input type="date" id="to_date" name="to_date"
                                                        value="{{ isset($to_date) ? $to_date : '' }}"
                                                        class="form-control" />

                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Select Cow</label>
                                                    {!! Form::select('cow_id', $cows, !empty($cow_id) ? $cow_id : null, [
                                                        'placeholder' => 'Cows Name',
                                                        'class' => 'form-control',
                                                        'id' => 'cow_id',
                                                    ]) !!}
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>&nbsp;</label>
                                                    <a href="#graph"><button type="button"
                                                            style="margin-top: 25px !important;"
                                                            class="btn btn-primary">View Graphs</button></a>
                                                </div>
                                            </div>

                                        </div>
                                        {{ Form::close() }}
                                        <div class="row" style="margin-left: 0px !important;">

                                        </div>
                                        <br>
                                        <div class="box-body table-responsive" id="hide-cow">
                                            <table id="cow-list" class="table table-bordered table-striped display">
                                                <thead>
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Morning</th>
                                                        <th>Afternoon</th>
                                                        <th>Evening</th>
                                                        <th>Whole Day</th>
                                                        <th>Total Milk</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="milkData">

                                                    <?php
                                                    $today = array();
                                                    $bar_all = array();
                                                    foreach ($milk_production as $product) {
                                                        $milk = explode(',', $product['milk']);
                                                        $time = explode(',', $product['time']);
                                                        $milkval = array_combine($time, $milk);
                                                            ?>
                                                    <tr>
                                                        <td>{{ $product['milking_date'] }}</td>
                                                        <td>{{ isset($milkval['1']) ? $milkval['1'] : '--' }} </td>
                                                        <td>{{ isset($milkval['2']) ? $milkval['2'] : '--' }} </td>
                                                        <td>{{ isset($milkval['3']) ? $milkval['3'] : '--' }} </td>
                                                        <td>{{ isset($milkval['4']) ? $milkval['4'] : '--' }} </td>
                                                        <td>{{ array_sum($milkval) }}</td>
                                                    </tr>
                                                    <?php
                                                        $today[] = date('jS M', strtotime($product['milking_date']));
                                                        $bar_all[]= array_sum($milkval);

                                                    }
                                                    ?>


                                                </tbody>
                                            </table>
                                        </div><!-- /.box-body -->

                                    </div><!-- /.box -->
                                </div>
                            </div>

                            <br>
                            <br>
                            <?php $cow_name  = !empty($cow_name[0]) ? $cow_name[0] : '' ?>
                            <div class="row" id="graph">
                                <div class="col-md-12">
                                    <!-- Bar chart -->
                                    <div class="card card-success">
                                        <div class="card-header">
                                            <h3 class="card-title"><?php echo  $cow_name . ' Milk Production'; ?></h3>

                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="chart">
                                                <canvas id="stackedBarChart"
                                                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                    <!-- /.card -->
                                </div>
                                <!-- /.col -->
                            </div>




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
    <!-- In the head section or before the closing body tag -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        $(document).ready(function() {
            $('#cow-list').DataTable();
        });

        form_date = $('#form_date').val();
        to_date = $('#to_date').val();
        cow_id = $('#cow_id').val();

        $('#from_date').on('change', function() {
            if (cow_id) {
                $('#form1').submit();
            }
        });

        $('#to_date').on('change', function() {
            if (cow_id) {
                $('#form1').submit();
            }
        });

        $("#cow_id").change(function() {
            $('#form1').submit();
        });

        //-------------
        //- BAR CHART -
        //-------------
        var barChartCanvas = $('#stackedBarChart').get(0).getContext('2d');
        barChartData = {
            labels: <?php echo json_encode($today); ?>,

            datasets: [{
                label: 'Total Milk',
                backgroundColor: 'rgba(60,141,188,0.9)',
                borderColor: 'rgba(60,141,188,0.8)',
                pointRadius: false,
                pointColor: '#3b8bba',
                pointStrokeColor: 'rgba(60,141,188,1)',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data: <?php echo json_encode($bar_all); ?>
            }, ]
        }

        var barChartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            datasetFill: false,
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }

        new Chart(barChartCanvas, {
            type: 'bar',
            data: barChartData,
            options: barChartOptions
        })
    </script>
@endsection
