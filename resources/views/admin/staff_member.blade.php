@extends('layouts.admin.admin_app')
@section('content')
<div class="row">
  <div class="col-sm-12">
    <div class="card">
        <div class="card-header">
          <h3 class="card-title">Regions</h3>
          <button type="button" class="btn btn-primary pull-right" data-toggle="modal" onclick="addNewRegion()" data-target="#addRegionModal">Add New Member</button>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="regions" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>#</th>
              <th>Name</th>
              <th>Email</th>
              <th>Is Admin</th>
              <th>Role</th>
              <th>Action</th>
             
            </tr>
            </thead>
            <tbody>
               @php $i=1 @endphp
                @foreach ($members as $member)
                {{-- {{dd($member->adminRole)}} --}}
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$member->name}}</td>
                        <td>{{$member->email}}</td>
                        <td>{{$member->is_admin=='1'?'YES':"NO"}}</td>
                        <td>{{$member->adminRole->name}}</td>
                        <td>
                            @if(Auth::user()->id!=$member->id)
                                
                            <button type="button" class="btn btn-primary" onclick="editAdmin('{{ base64_encode(json_encode($member)) }}')">Edit</button>
                            <a href="{{route('admin.delete.staff.member',$member->id)}}" class="btn btn-danger">Delete</a>
                            @endif
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
          <h5 class="modal-title" id="exampleModalLabel">Staff Member</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form onsubmit="addAdmin()" id="addRegionForm">
            <div class="modal-body">
                @csrf
                <input type="hidden" id="user_id" name="user_id" value="">
                <div class="form-group">
                    <label for="">Select Role</label>
                    <select name="role"  id="role" class="form-control validate">
                        @foreach ($roles as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                <label for=""> Name</label>
                <input type="text" name="name" class="form-control validate" id="name">
            </div>
            <div class="form-group">
                <label for=""> Email</label>
                <input type="text" name="email" class="form-control validate" id="email">
            </div>
            <div class="form-group">
                <label for=""> Password</label>
                <input type="text" name="password" class="form-control validate" id="password">
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
    function addAdmin(){
        event.preventDefault()
        // debugger
       form_data= $('#addRegionForm').serialize()
        $.ajax({
            url:"{{route('admin.add.member')}}",
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
    function AddNewRegion(){
        $('#addRegionForm').attr('onsubmit','addRegion()')
    }
    
    function editAdmin(data){
        user=JSON.parse(atob(data))
        $("#user_id").val(user.id)
        $("#role").val(user.admin_role_id)
        $("#name").val(user.name)
        $("#email").val(user.email)
        $('#addRegionForm').attr('onsubmit','udpateAdmin()')
        $("#addRegionModal").modal('show')
    }
     function udpateAdmin(){
        
        event.preventDefault()
        debugger
       form_data= $('#addRegionForm').serialize()
        $.ajax({
            url:"{{route('admin.udpate.member')}}",
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
</script>
@endsection