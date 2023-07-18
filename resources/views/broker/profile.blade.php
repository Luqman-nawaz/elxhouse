@extends('layouts.broker.broker_app')
@section('content')
<div class="card">
    <div class="card-body ">
      <p class="login-box-msg">Register a new membership</p>

      <form  onsubmit="registerNewAccount()" method="post" id="registerFrom">
        @csrf
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" class="form-control validate" name="name" value="{{ $user->name }}">
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="">Surname</label>
                    <input type="text" class="form-control validate" name="surname" value="{{ $user->surname }}">
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="text" class="form-control validate" name="email" value="{{ $user->email }}">
                </div>
            </div>
        </div>
       
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="">Address</label>
                    <input type="text" class="form-control validate" name="address" value="{{ $user->profile?$user->profile->address:'' }}">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="">Phone Number</label>
                    <input type="text" class="form-control validate" name="phone" value="{{ $user->profile?$user->profile->phone:'' }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="">Company Name</label>
                    <input type="text" class="form-control validate" name="company_name" value="{{ $user->profile?$user->profile->company_name:'' }}">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="">Company Number</label>
                    <input type="text" class="form-control validate" name="company_number" value="{{ $user->profile?$user->profile->company_number:'' }}">
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
                            <option value="{{ $item->id }}" {{ $item->id==$user->profile->region_id?'selected':'' }}>{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="">City</label>
                    <select name="city" class="form-control validate"  id="cities">
                        @foreach ($user->profile->city as $cit)
                            <option value="{{ $cit->id }}">{{$cit->name}}</option>
                        @endforeach
                    
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
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
      </form>

      

    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
 @endsection
@section('styles')
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">   
@endsection
@section('scripts')
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
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
            url:'{{ route("broker.update.profile") }}',
            type:'post',
            data:formData,
            success:function(response){
                if(response.status==true){
                    show_toast('success',response.message)
                    setTimeout(() => {
                        location.reload()
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

@endsection