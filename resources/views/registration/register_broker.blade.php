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
                    <a href=""><b>elx</b>House</a>
                  </div>
                
                  <div class="card">
                    <div class="card-body ">
                      <p class="login-box-msg">Register a new membership</p>
                
                      <form  onsubmit="registerNewAccount()" method="post" id="registerFrom">
                        @csrf
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" class="form-control validate" name="name">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="">Surname</label>
                                    <input type="text" class="form-control validate" name="surname">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="text" class="form-control validate" name="email">
                                </div>
                            </div>
                        </div>
                       
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Address</label>
                                    <input type="text" class="form-control validate" name="address">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Phone Number</label>
                                    <input type="text" class="form-control validate" name="phone">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Company Name</label>
                                    <input type="text" class="form-control validate" name="company_name">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Company Number</label>
                                    <input type="text" class="form-control validate" name="company_number">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="">Region</label>
                                    <select name="region" class="form-control validate" id="" onchange="getCities(this.value)">
                                        <option value="">Select Region</option>
                                        @foreach ($regions as $item)
                                            <option value="{{ $item->id }}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="">City</label>
                                    <select name="city" class="form-control validate"  id="cities">
                                    
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="text" class="form-control validate" name="password">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                           
                            
                        </div>
                        
                        <div class="row">
                            
                            
                        </div>
                       
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group text-right">
                                    <button type="submit" class="btn btn-primary">Register</button>
                                </div>
                            </div>
                        </div>
                      </form>
                
                      
                <div class="row">
                    <div class="col-sm-12">

                        <a href="{{ route('login') }}" class="text-center">I already have a membership</a>
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
    function getCities(value){
        $.ajax({
            url:'{{ route("get-cities") }}',
            type:'get',
            data:{region:value},
            success:function(response){
                if(response.status==true){
                    html='';
                    res=response.data
                    $.each(res,function(index,item){
                        html+='<option value="'+item.id+'">'+item.name+'</option>';
                    })
                    $("#cities").html(html)
                }
            }
        })
    }
    function registerNewAccount(){
        event.preventDefault()
        formData=$("#registerFrom").serialize()
        $.ajax({
            url:'{{ route("create.broker.account") }}',
            type:'post',
            data:formData,
            success:function(response){
                if(response.status==true){
                    show_toast('success',response.message)
                    setTimeout(() => {
                        
                        location.href='{{ route("login") }}'
                    }, 2000);
                }else{
                    
                    show_toast('error',response.message)
                }
            },
            error:function(err){
                if(err.status==422){
                    error=err.responseJSON.errors
                    $("#registerFrom .validate").each(function(index){
                        $(this).removeClass('is-invalid')
                        $(this).next('span').remove()
                        input_name=$(this).attr('name')
                        if(error[input_name]){
                            $(this).addClass('is-invalid')
                            // $(this).after('<span class="text-danger">'+error.name+'</span>')
                        }

                    })
                }
            }
        })
    }
    
        @if(Session::has('success'))

            show_toast('success','{{ Session::get("success") }}')
        @endif
        @if(Session::has('error'))

            show_toast('error','{{ Session::get("error") }}')
        @endif
  
</script>
</body>
</html>
