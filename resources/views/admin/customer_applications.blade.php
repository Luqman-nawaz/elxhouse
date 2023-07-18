@extends('layouts.admin.admin_app')
@section('content')
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Application</h3>
    {{-- <button class="btn btn-primary" data-toggle="modal" data-target="#applicationModal">Add Application</button> --}}
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th>Name</th>
        <th>Region</th>
        <th>Cities</th>
        <th>Distric</th>
        <th>House Type</th>
        <th>Budget</th>
        <th>Grage</th>
        <th>Sea View</th>
        <th>Renovated</th>
        <th>Message</th>
        <th>Status</th>
      </tr>
      </thead>
      <tbody>
        {{-- {{dd($regions)}} --}}
      @foreach ($applications as $item)
      <tr>

        <td>{{ $item->user?$item->user->name:'' }}</td>
        <td>{{ $item->region?$item->region->name:'' }}</td>
        <td>
          @foreach($item->city as $city)
          <span class="badge badge-success">{{ $city->name }}</span>
          @endforeach
        </td>
        <td>{{ $item->distric?$item->distric->name:'' }}</td>
        
        <td>{{$item->house}}</td>
        <td>{{$item->budget}}</td>
        <td>{{$item->grage}}</td>
        <td>{{$item->sea_view}}</td>
        <td>{{$item->renovate}}</td>
        <td>{{$item->note}}</td>
        <td>
          @if($item->approved=='0')
            <a href="{{ route('admin.approve.customer.application',$item->id) }}" class="badge badge-warning">Pending</a>
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

@endsection
@section('scripts')
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
                            $(this).after('<span class="text-danger">'+error.name+'</span>')
                        }

                    })
                }
            }
        })
    }
    </script>
@endsection