@extends('layouts.admin.admin_app')
@section('content')
<div class="row">
  <div class="col-sm-6">
    <div class="card">
        <div class="card-header">
          <h3 class="card-title">Regions</h3>
          <button type="button" class="btn btn-primary pull-right" data-toggle="modal" onclick="addNewRegion()" data-target="#addRegionModal">Add New Region</button>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="regions" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>#</th>
              <th>Name</th>
              <th>Action</th>
             
            </tr>
            </thead>
            <tbody>
                @php $i=1 @endphp
                @foreach ($regions as $item)
                    
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $item->name }}</td>
                    <td><button onclick="editRegion('{{ base64_encode(json_encode($item)) }}')" class="btn btn-success"><i class="fa fa-edit"></i></button>
                        <a href="{{ route('admin.region.delete',$item->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                    </td>

                </tr>
                @endforeach
            </tbody>
           
          </table>
        </div>
        <!-- /.card-body -->
      </div>
  </div>
  <div class="col-sm-6">
    <div class="card">
        <div class="card-header">
          <h3 class="card-title">Cities</h3>
          <button type="button" class="btn btn-primary pull-right" data-toggle="modal" onclick="AddNewCity()" data-target="#addCitiesModal">Add New City</button>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="cities" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>#</th>
              <th>Name</th>
              <th>Regions</th>
              <th>Action</th>
             
            </tr>
            </thead>
            <tbody>
                @php $i=1 @endphp
                @foreach ($cities as $city)
                    
                <tr>
                    <td>{{ $i++ }}</td>
                    
                    <td>{{ $city->name }}</td>
                    <td>{{ $city->region?$city->region->name:'--' }}</td>
                    <td><button  onclick="editCity('{{ base64_encode(json_encode($city)) }}')" class="btn btn-success"><i class="fa fa-edit"></i></button>
                        <a href="{{ route('admin.city.delete',$city->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
           
          </table>
        </div>
        <!-- /.card-body -->
      </div>
  </div>
  <div class="col-sm-6">
    <div class="card">
        <div class="card-header">
          <h3 class="card-title">Districs</h3>
          <button type="button" class="btn btn-primary pull-right" data-toggle="modal" onclick="addNewDistric()" data-target="#addDistricModal">Add New Distric</button>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="cities" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>#</th>
              <th>Name</th>
              <th>Regions</th>
              <th>City</th>
              <th>Action</th>
             
            </tr>
            </thead>
            <tbody>
                @php $i=1 @endphp
                @foreach ($districs as $distt)
                    
                <tr>
                    <td>{{ $i++ }}</td>
                    
                    <td>{{ $distt->name }}</td>
                    <td>{{ $distt->region?$distt->region->name:'--' }}</td>
                    <td>{{ $distt->city?$distt->city->name:'--' }}</td>
                    <td><button  onclick="editDistric('{{ base64_encode(json_encode($distt)) }}')" class="btn btn-success"><i class="fa fa-edit"></i></button>
                        <a href="{{ route('admin.distric.delete',$distt->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
           
          </table>
        </div>
        <!-- /.card-body -->
      </div>
  </div>
  
  </div>
  <!-- Modal -->
<div class="modal fade" id="addRegionModal" tabindex="-1">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Region</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form onsubmit="addRegion()" id="addRegionForm">
            <div class="modal-body">
                @csrf
                <input type="hidden" id="region_id" name="region_id" value="">
            <div class="form-group">
                <label for="">Region Name</label>
                <input type="text" name="name" class="form-control validate" id="region_name">
            </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
            </div>
         </div>
        </form>
    </div>
  </div>
<div class="modal fade" id="addCitiesModal" tabindex="-1">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">City</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form onsubmit="addCity()" id="addCityForm">
            <div class="modal-body">
                @csrf
                <div class="form-group">
                    <label for="">Select Region</label>
                    <select name="region" class="form-control validate" id="city_region_id" >
                        <option value="">Regions</option>
                        @foreach ($regions as $reg)
                            <option value="{{ $reg->id }}">{{$reg->name}}</option>
                        @endforeach
                    </select>
                </div>
               
                <input type="hidden" id="city_id" name="city_id" value="">
                <div class="form-group">
                    <label for="">City Name</label>
                    <input type="text" name="name" class="form-control validate" id="city_name">
                </div>
            
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
            </div>
         </div>
        </form>
    </div>
  </div>
<div class="modal fade" id="addDistricModal" tabindex="-1">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Districs</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form onsubmit="addDistric()" id="addDistricForm">
            <div class="modal-body">
                @csrf
                <div class="form-group">
                    <label for="">Select Region</label>
                    <select name="region" class="form-control validate" id="distric_region_id" onchange="getCities(this.value)">
                        <option value="">Select Region</option>
                        @foreach ($regions as $reg)
                            <option value="{{ $reg->id }}">{{$reg->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Select City</label>
                    <select name="city" class="form-control validate" id="region_cities" >
                       
                    </select>
                </div>
                <input type="hidden" id="distric_id" name="distric_id" value="">
                <div class="form-group">
                    <label for="">Distric Name</label>
                    <input type="text" name="name" class="form-control validate" id="distric_name">
                </div>
            
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
            </div>
         </div>
        </form>
    </div>
  </div>
@endsection
@section('styles')
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">   
@endsection
@section('scripts')
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script>
    $(document).ready(function(){
        $('#regions').DataTable({})
        $('#cities').DataTable({})
    })
    function addRegion(){
        event.preventDefault()
        // debugger
       form_data= $('#addRegionForm').serialize()
        $.ajax({
            url:"{{route('admin.add.region')}}",
            type:'post',
            data:form_data,
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
                    $("#addRegionForm .validate").each(function(index){
                        $(this).removeClass('is-invalid')
                        $(this).next('span').remove()
                        input_name=$(this).attr('name')
                        if(error[input_name]){
                            $(this).addClass('is-invalid')
                            $(this).after('<span class="text-danger">'+error.name+'</span>')
                        }

                    })
                }
            }
        })
    }
    function addDistric(){
        event.preventDefault()
        // debugger
       form_data= $('#addDistricForm').serialize()
        $.ajax({
            url:"{{route('admin.add.distric')}}",
            type:'post',
            data:form_data,
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
                    $("#addDistricForm .validate").each(function(index){
                        $(this).removeClass('is-invalid')
                        $(this).next('span').remove()
                        input_name=$(this).attr('name')
                        if(error[input_name]){
                            $(this).addClass('is-invalid')
                            $(this).after('<span class="text-danger">'+error.name+'</span>')
                        }

                    })
                }
            }
        })
    }
    function addCity(){
        event.preventDefault()
        // debugger
       form_data= $('#addCityForm').serialize()
        $.ajax({
            url:"{{route('admin.add.city')}}",
            type:'post',
            data:form_data,
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
                    $("#addCityForm .validate").each(function(index){
                        $(this).removeClass('is-invalid')
                        $(this).next('span').remove()
                        input_name=$(this).attr('name')
                        if(error[input_name]){
                            $(this).addClass('is-invalid')
                        }

                    })
                }
            }
        })
    }
    function AddNewCity(){
        $('#addCityForm').attr('onsubmit','addCity()')
    }
    function AddNewDistric(){
        $('#addDistricForm').attr('onsubmit','addDistric()')
    }
    function AddNewRegion(){
        $('#addRegionForm').attr('onsubmit','addRegion()')
    }
    function editCity(data){
        city=JSON.parse(atob(data))
        $('#addCityForm').attr('onsubmit','udpateCity()')
        $('#city_id').val(city.id)
        $('#city_region_id').val(city.region_id)
        $('#city_name').val(city.name)
        $("#addCitiesModal").modal('show')
    }
    function editDistric(data){
        distric=JSON.parse(atob(data))
        $('#addDistricForm').attr('onsubmit','udpateCDistric()')
        $('#distric_region_id').val(distric.region_id)
        $('#distric_id').val(distric.id)
        $('#distric_name').val(distric.name)
        $("#addDistricModal").modal('show')
    }
    function editRegion(data){
        region=JSON.parse(atob(data))
        $("#region_id").val(region.id)
        $("#region_name").val(region.name)
        $('#addRegionForm').attr('onsubmit','updateRegion()')
        $("#addRegionModal").modal('show')
    }
    function udpateCity(){
        event.preventDefault()
        form_data= $('#addCityForm').serialize()
        $.ajax({
            url:"{{route('admin.udpate.city')}}",
            type:'post',
            data:form_data,
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
                    $("#addCityForm .validate").each(function(index){
                        $(this).removeClass('is-invalid')
                        $(this).next('span').remove()
                        input_name=$(this).attr('name')
                        if(error[input_name]){
                            $(this).addClass('is-invalid')
                        }

                    })
                }
            }
        })
    }
    function udpateCDistric(){
        event.preventDefault()
        form_data= $('#addDistricForm').serialize()
        $.ajax({
            url:"{{route('admin.udpate.distric')}}",
            type:'post',
            data:form_data,
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
                    $("#addDistricForm .validate").each(function(index){
                        $(this).removeClass('is-invalid')
                        $(this).next('span').remove()
                        input_name=$(this).attr('name')
                        if(error[input_name]){
                            $(this).addClass('is-invalid')
                        }

                    })
                }
            }
        })
    }
     function updateRegion(){
        
        event.preventDefault()
        // debugger
       form_data= $('#addRegionForm').serialize()
        $.ajax({
            url:"{{route('admin.udpate.region')}}",
            type:'post',
            data:form_data,
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
                    $("#addRegionForm .validate").each(function(index){
                        $(this).removeClass('is-invalid')
                        $(this).next('span').remove()
                        input_name=$(this).attr('name')
                        if(error[input_name]){
                            $(this).addClass('is-invalid')
                            $(this).after('<span class="text-danger">'+error.name+'</span>')
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
                var html='';
                if(response.status==true){

                    $.each(response.data,function(index,value){
                        html+='<option value="'+value.id+'">'+value.name+'</option>';
                    })
                    $("#region_districs").html(html)
                }
            }
        })
     }
     function getCities(id){
        $.ajax({

            url:'{{ route("get.region.cities") }}',
            type:'get',
            data:{id:id},
            success:function(response){
                var html='';
                if(response.status==true){

                    $.each(response.data,function(index,value){
                        html+='<option value="'+value.id+'">'+value.name+'</option>';
                    })
                    $("#region_cities").html(html)
                }
            }
        })
     }
</script>
@endsection