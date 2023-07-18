@extends('layouts.customer.customer_app')
@section('content')
<div class="card">
  <div class="card-body">
      For urgent basis cotact adminstration support@elxhouse.com
  </div>
</div>
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Application</h3>
    <button class="btn btn-primary" data-toggle="modal" data-target="#applicationModal">Add Application</button>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th>Name</th>
        <th>Region</th>
        <th>Distric</th>
        <th>Cities</th>
        
        <th>House Type</th>
        <th>Budget</th>
        <th>Grage</th>
        <th>sea_view</th>
        <th>renovate</th>
        <th>Status</th>
      </tr>
      </thead>
      <tbody>
        {{-- {{dd($regions)}} --}}
      @foreach ($applications as $item)
      <tr>

        <td>{{ $item->user?$item->user->name:'' }}</td>
        <td>{{ $item->region?$item->region->name:'' }}</td>
        <td>{{ $item->distric?$item->distric->name:'' }}</td>
        <td>
          @foreach($item->city as $city)
            <span class="badge badge-success">{{ $city->name }}</span>
          @endforeach
        </td>
       
        <td>{{$item->house}}</td>
        <td>{{$item->budget}}</td>
        <td>{{$item->grage}}</td>
        <td>{{$item->sea_view}}</td>
        <td>{{$item->renovate}}</td>
        <td>
          @if($item->approved=='0')
            <span class="badge badge-warning">Pending</span>
            @else
            
            <span class="badge badge-success">Approved</span>
          @endif
        </td>
      </tr>
      @endforeach
     
      </tfoot>
    </table>
  </div>
  <!-- /.card-body -->
</div>
<div class="modal fade" id="applicationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Submit Application</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form onsubmit="submitApplication()" id="applicationForm">
      
        <div class="modal-body">
          @csrf
              <div class="form-group">
                <label for="">Region</label>
                <select name="region" class="form-control validate" id="" onchange="getCities(this.value)">
                    <option value="">Select Region</option>
                    @foreach ($regions as $item)
                        <option value="{{ $item->id }}">{{$item->name}}</option>
                    @endforeach
                </select>
            </div>
          
              <div class="form-group">
                <label for="">City</label>
                <select name="city[]" class="form-control  select2bs4 "  multiple="multiple"id="cities" onchange="getDistrics(this.value)">
                
                </select>
            </div>
            <div class="form-group">
              <label for="">Distric</label>
              <select name="distric" class="form-control  validate" id="districs" >
              
              </select>
          </div>
              {{-- <div class="form-group">
                <label for="">Number Of Adults</label>
                <select name="adults" class="form-control validate" id="">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="6">6</option>
                </select>
              
            </div>
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
          </div> --}}
          <div class="form-group">
            <label for="">House Type</label>
            <select name="house" class="form-control validate">
                <option value="100-150m">100-150m</option>
                <option value="150-200m">150-200m</option>
                <option value="200-300m">200-300m</option>
                <option value="00-350m">300-350m</option>
            </select>
        </div>
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
     <div class="row">
      <div class="col-sm-4">
        <div class="form-group">
          <label for="">Grage</label><br>
          <label for=""><input type="radio" name="grage" value="1" checked>Yes</label>
          <label for=""><input type="radio" name="grage" value="0">No</label>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="form-group">
          <label for="">Sea View</label><br>
          <label for=""><input type="radio" name="sea_view" value="1" checked>Yes</label>
          <label for=""><input type="radio" name="sea_view" value="0">No</label>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="form-group">
          <label for="">Renovate</label><br>
          <label for=""><input type="radio" name="renovate" value="1" checked>Yes</label>
          <label for=""><input type="radio" name="renovate" value="0">No</label>
        </div>
      </div>
      <div class="form-group">
        <label for="">Message</label>
        <textarea name="note" id=""  class="form-control" cols="100" style="width: 100%"></textarea>
      </div>
     </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
@section('styles')
<link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<style>
  .select2-selection{
    background: #343a40 !important;
  }
</style>
@endsection
@section('scripts')
<script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script> 
{{-- <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}" ></script> --}}
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
    function submitApplication(){
        event.preventDefault()
        formData=$("#applicationForm").serialize()
        $.ajax({
            url:'{{ route("customer.submit.application") }}',
            type:'post',
            data:formData,
            success:function(response){
                if(response.status==true){
                    show_toast('success',response.message)
                    location.reload()
                }else{
                    
                    show_toast('error',response.message)
                }
            },
            error:function(err){
                if(err.status==422){
                    error=err.responseJSON.errors
                    $("#applicationForm .validate").each(function(index){
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
    </script>
@endsection