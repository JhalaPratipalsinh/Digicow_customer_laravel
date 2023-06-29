
<!DOCTYPE html>
<html lang="en">

<head>


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="D0g0Z8jZnixb6WgTYp1zQSADV9WR79ced9kN4VQz">

    <title> Digicow Customer</title>

    <link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="login-page" >


        <div class="login-box">


        <div class="login-logo">
            <a href="{{ asset('home')}}">
                <img src="{{ asset('assets/image/Digicow_logo.png')}}" alt="Admin Logo" height="50">
                <b>Digicow</b> Customer
            </a>
        </div>


        <div class="card card-outline card-primary">
                <div class="card-header ">
                    <h3 class="card-title float-none text-center"></h3>
                </div>


    <div class="card-body login-card-body ">
        {{ Form::open(['url' => URL::to('authenticate'), 'files' => true, 'class' => 'multiple-form-submit']) }}

        <div class="input-group mb-3">
            <input type="text" name="mobile_number" class="form-control "
                   value="" placeholder="Mobile Number" autofocus>

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope "></span>
                </div>
            </div>

                    </div>


        <div class="input-group mb-3">
            <input type="password" name="pin" class="form-control "
                   placeholder="Pin">

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock "></span>
                </div>
            </div>

                    </div>


        <div class="row">
            <div class="col-7">

            </div>

            <div class="col-5">
                <button type=submit class="btn btn-block btn-flat btn-primary">
                    <span class="fas fa-sign-in-alt"></span>
                    Sign In
                </button>
            </div>
        </div>

    </form>
            </div>


        </div>

    </div>


    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>







</body>

</html>
