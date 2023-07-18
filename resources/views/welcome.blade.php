<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register New Account</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css')}}">
</head>
<body class="hold-transition register-page">
    <div class="container">

        <div class="row">
            <div class="col-sm-12">
                <div class="" style="width: 100%;">
                  <div class="register-logo">
                    <a href=""><b>Elx</b>House</a>
                  </div>
                
                  <div class="card">
                    <div class="card-body text-center" style="margin-top: 100px;">
                        <a href="{{ route('client.register') }}" class="btn btn-primary">Register as Customer</a>
                        <a href="{{ route('register.broker.account') }}" class="btn btn-primary">Register as Broker</a>
                      
                
                      
                <div class="row">
                    <div class="col-sm-12 text-center mt-5">

                        <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                    </div>
                </div>
                    </div>
                    <!-- /.form-box -->
                  </div><!-- /.card -->
                </div>
                <!-- /.register-box -->

            </div>
        </div>
    </div>

<!-- jQuery -->
<script src="{{ asset('assets/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/dist/js/adminlte.min.js')}}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('public/js/functions.js') }}"></script>
<script>
    @if(Session::has('success'))

        show_toast('success','{{ Session::get("success") }}')
    @endif
    @if(Session::has('error'))

        show_toast('error','{{ Session::get("error") }}')
    @endif
</script>
</body>
</html>

    
  