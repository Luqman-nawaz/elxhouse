@extends('layouts.broker.broker_app')
@section('content')

<div class="row">
 
    <div class="col-md-9">
      <div class="card card-primary card-outline">
        <div class="card-header">
          <h3 class="card-title">Conversactions</h3>

          <div class="card-tools">
            <div class="input-group input-group-sm">
              <input type="text" class="form-control" placeholder="Search Mail">
              <div class="input-group-append">
                <div class="btn btn-primary">
                  <i class="fas fa-search"></i>
                </div>
              </div>
            </div>
          </div>
          <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
         
          <div class="table-responsive mailbox-messages">
            <table class="table table-hover table-striped">
              <tbody>
                @foreach($conversaction as $value)
                <tr>
                  <td>
                    <div class="icheck-primary">
                      <input type="checkbox" value="" id="check1">
                      <label for="check1"></label>
                    </div>
                  </td>
                  
                  <td class="mailbox-name"><a href="{{ route('broker.start.conversaction',$value->customer_id) }}">{{ $value->customer->name }}</a></td>
                 {{-- <td><span class="badge badge-primary">{{ count($value->chats) }} Unread Messages</span></td> --}}
                  <td class="mailbox-date">{{  $value->updated_at->diffForHumans() }}</td>
                </tr>
                    
                @endforeach
             
              </tbody>
            </table>
            <!-- /.table -->
          </div>
          <!-- /.mail-box-messages -->
        </div>
        <!-- /.card-body -->
     
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
 @endsection
@section('styles')
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">   
<style>
    .messages {
    box-shadow: 0px 0px 3px 0px;
    /* border: 2px solid; */
    padding: 10px;
    line-height: 30px;
    font-size: 25px;
    /* width: 70%; */
    width: auto;
    background: #747474;
    /* border-radius: 15px; */
}
.chat-body{
    height: 550px;
    overflow: 100%;
    overflow-y: scroll;
}
body::-webkit-scrollbar {
  width: 5px;               
}

</style>
@endsection
@section('scripts')


@endsection