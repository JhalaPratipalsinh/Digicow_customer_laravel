@extends('components.layout')

@section('contents')
    <!-- Content Header (Page header) -->
    @php
        $breadcrumb = '<li class="breadcrumb-item active">Dashboard</li>';
    @endphp
    <x-backend-breadcrumb title="Dashboard" breadcrumb="{{ $breadcrumb }}" />
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>0</h3>
                            <p>Highest Milk Producer</p>
                        </div>
                        <div class="icon">

                        </div>
                        {{--  <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>  --}}
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>0</h3>

                            <p>Total production for today </p>
                        </div>
                        <div class="icon">

                        </div>
                        {{--  <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>  --}}
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>0</h3>
                            <p>Avg. milk Production/Day </p>
                        </div>
                        <div class="icon">

                        </div>
                        {{--  <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>  --}}
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>
                                0
                            </h3>
                            <p>Total Milk produced to date</p>
                        </div>
                        <div class="icon">

                        </div>
                        {{--  <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>  --}}
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>
                                <?php echo 0; ?>
                            </h3>
                            <p>
                                Lowest Milk Producer
                            </p>
                        </div>
                        <div class="icon">

                        </div>

                    </div>
                </div><!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>
                                <?php echo 0; ?>
                            </h3>
                            <p>
                                Lactating Cows
                            </p>
                        </div>
                        <div class="icon">

                        </div>

                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3>
                                <?php echo 0; ?>
                            </h3>
                            <p>
                                Drying Cows
                            </p>
                        </div>
                        <div class="icon">

                        </div>

                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3>
                                <?php echo 0; ?>
                            </h3>
                            <p>
                                In Calf Cows
                            </p>
                        </div>
                        <div class="icon">

                        </div>

                    </div>
                </div>
            </div><!-- /.row -->
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>
                                <?php echo 0; ?>
                            </h3>
                            <p>
                                Highest Health Expense
                            </p>
                        </div>
                        <div class="icon">

                        </div>

                    </div>
                </div><!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>
                                <?php echo 0; ?>
                            </h3>
                            <p>
                                Highest number of repeat AI
                            </p>
                        </div>
                        <div class="icon">

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- /.content -->
@endsection

@section('scripts')
@endsection
