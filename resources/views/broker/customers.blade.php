@extends('layouts.broker.broker_app')
@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('broker.customers') }}" id="search_form">


            <div class="row">
                <div class="col-sm-3">
                    <label for="">Region</label>
                    <select name="region" id="region" class="form-control" onchange="getCities(this.value)">
                        {{-- <option value="">Select Region</option> --}}
                            @foreach ($regions as $item)
                                <option value="{{ $item->id }}">{{$item->name}}</option>
                            @endforeach
                    </select>
                </div>
                <div class="col-sm-3">
                    <label for="">City</label>
                    <select name="city"  class="form-control" id="cities" onchange="getDistrics(this.value)">
                        <option value="">Select City</option>
                          @foreach ($cities as $item)
                              <option value="{{$item->id}}">{{ $item->name }}</option>
                          @endforeach
                    </select>
                </div>
                <div class="col-sm-3">
                    <label for="">Distric</label>
                    <select name="distric" id="districs" class="form-control" >
                        <option value="">Select Distric</option>
                           
                    </select>
                </div>
                <div class="col-sm-3">
                    <label for="">Budget</label>
                    <select name="budget" class="form-control validate" id="budget">
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
          
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="">House</label>
                        <select name="house" class="form-control validate" id="house">
                            <option value="100-150m">100-150m</option>
                            <option value="150-200m">150-200m</option>
                            <option value="200-300m">200-300m</option>
                            <option value="00-350m">300-350m</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="">Is Grage</label><br>
                       <input type="radio" name="grage" value="1" checked> Yes
                       <input type="radio" name="grage" value="0" > No
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="">Is Sea view</label>
                        <br>
                        <input type="radio" name="seaview" value="1" checked> Yes
                        <input type="radio" name="seaview" value="0" > No
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="">is Renovate</label>
                        <br>
                        <input type="radio" name="renovate" value="1" checked> Yes
                       <input type="radio" name="renovate" value="0" > No
                       
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-primary" >Search</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="row">
  <div class="col-sm-12">
    <div class="card">
        <div class="card-header">
          <h3 class="card-title">Customers</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="customersTable" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Id</th>
                
              <th>Region</th>
              <th>City</th>
              <th>Distric</th>
              <th>Budget</th>
              <th>house</th>
              <th>Action</th>
             
            </tr>
            </thead>
            <tbody>
                @php $i=1 @endphp
                @foreach ($users as $user)
                    <tr>
                        <td>
                            {{ $i++ }}</td>
                            <td>{{ $user->user?$user->user->user_account_id:'' }}</td>
                            <td>{{ $user->region?$user->region->name:'' }}</td>
                            <td> {{ $selectedcity }}</td>
                            <td>{{ $user->distric?$user->distric->name:'' }}</td>
                           <td> {{ $user->budget }}</td>
                           <td> {{ $user->house }}</td>
                        </td>
                        <td>
                            <a href="{{ route('broker.start.conversaction',$user->user->id) }}" class="btn btn-primary">Chat</a>
                            <a href="{{ route('broker.custstomer.detail',$user->user->id) }}" class="btn btn-primary">View</a>
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
 @endsection
@section('styles')
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">   
@endsection
@section('scripts')
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  
<script>
    $(document).ready(function(){
        $('#customersTable').DataTable({})
    })
    // function customers(formData){
    //     $('#customersTable').DataTable({
    //            processing: true,
    //            serverSide: true,
    //            ajax: '{{ route("broker.filter.customer") }}',
    //            data:formData,
    //            columns: [
    //                     { data: 'id', name: 'id' },
    //                     { data: 'name', name: 'name' },
    //                     { data: 'address', name: 'address' },
    //                     { data: 'phone', name: 'phone' },
    //                     { data: 'region', name: 'region' },
    //                  ]
    //         });
    // }
    function filterCustomer(){
        event.preventDefault()
        formData=$('#search_form').serialize()
        customers(formData)
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
     function getCities(value){
        $.ajax({
            url:'{{ route("get-cities") }}',
            type:'get',
            data:{region:value},
            success:function(response){
                var html='<option>Select City</option>';
                if(response.status==true){
                    // html='';
                    res=response.data
                    $.each(res,function(index,item){
                        html+='<option value="'+item.id+'">'+item.name+'</option>';
                    })
                    $("#cities").html(html)
                }
            }
        })
    }
</script>

@endsection