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
  <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
</head>
<body class="hold-transition register-page">
    <div class="container">

        <div class="row">
            <div class="col-sm-12">
                <div class="" style="width: 100%;">
                  <div class="register-logo">
                    <a href=""><b>ELX</b>House</a>
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
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="">Address</label>
                                    <input type="text" class="form-control validate" name="address">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="">Phone Number</label>
                                    <input type="text" class="form-control validate" name="phone">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="">Current Living</label>
                                    <select name="current_living" class="form-control validate" id="">
                                        <option value="villa">villa</option>
                                        <option value="radhus">radhus</option>
                                        <option value="lagenhet">lagenhet</option>
                                    </select>
                                   
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
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
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="">City</label>
                                    <select name="city[]" class="form-control select2bs4 " onchange=getDistrics(this.value) multiple="multiple" id="cities" style="width: 100%;">
                                    
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="">Distric</label>
                                    <select name="distric" class="form-control  " id="districs" >
                                    
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="">Number Of Adults</label>
                                    <select name="adults" class="form-control validate" id="">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="6">6</option>
                                    </select>
                                   
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="">Childerns</label>
                                    <select name="childerns" class="form-control validate" id="">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                 <label for="">House</label>
                                    <select name="house" class="form-control validate">
                                        <option value="100-150m">100-150m</option>
                                        <option value="150-200m">150-200m</option>
                                        <option value="200-300m">200-300m</option>
                                        <option value="00-350m">300-350m</option>
                                    </select>
                                </div><div class="form-group">
                                   
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="">Budget</label>
                                    <select name="budget" class="form-control validate" id="">
                                        <option value="1-2 miljoner">1-2 miljoner</option>
                                        <option value="2-3 miljoner">2-3 miljoner</option>
                                        <option value="3-4 miljoner">3-4 miljoner</option>
                                        <option value="4-6 miljoner">4-6 miljoner</option>
                                        <option value="6-8 miljoner">6-8 miljoner</option>
                                        <option value="8-10 miljoner">8-10 miljoner</option>
                                        <option value="10-15 miljoner">10-15 miljoner</option>
                                        <option value="15-25 miljoner">15-25 miljoner</option>
                                    </select>
                                   
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Today Living</label>
                                    <input type="text" class="form-control validate" name="living_today">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="text" class="form-control validate" name="password">
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="">Is Grage</label><br>
                                   <input type="radio" name="grage" value="1" checked> Yes
                                   <input type="radio" name="grage" value="0" > No
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="">Is Sea view</label>
                                    <br>
                                    <input type="radio" name="seaview" value="1" checked> Yes
                                    <input type="radio" name="seaview" value="0" > No
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="">is Renovate</label>
                                    <br>
                                    <input type="radio" name="renovate" value="1" checked> Yes
                                   <input type="radio" name="renovate" value="0" > No
                                   
                                </div>
                            </div>
                            
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
<script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script> 
<script>
      $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
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
            url:'{{ route("register.new.account") }}',
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
    function getDistrics(id){
        $.ajax({

            url:'{{ route("get.region.districs") }}',
            type:'get',
            data:{id:id},
            success:function(response){
                var html='<option>Select Distric</option>';
                if(response.status==true){

                    $.each(response.data,function(index,value){
                        html+='<option value="'+value.id+'">'+value.name+'</option>';
                    })
                    $("#districs").html(html)
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
