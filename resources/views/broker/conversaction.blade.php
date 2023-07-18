@extends('layouts.broker.broker_app')
@section('content')

<div class="row">
    {{-- <div class="col-md-3">
      <a href="mailbox.html" class="btn btn-primary btn-block mb-3">Back to Inbox</a>

      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Folders</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="card-body p-0">
          <ul class="nav nav-pills flex-column">
            <li class="nav-item active">
              <a href="#" class="nav-link">
                <i class="fas fa-inbox"></i> Inbox
                <span class="badge bg-primary float-right">12</span>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-envelope"></i> Sent
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-file-alt"></i> Drafts
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fas fa-filter"></i> Junk
                <span class="badge bg-warning float-right">65</span>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-trash-alt"></i> Trash
              </a>
            </li>
          </ul>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Labels</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
          <ul class="nav nav-pills flex-column">
            <li class="nav-item">
              <a class="nav-link" href="#"><i class="far fa-circle text-danger"></i> Important</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#"><i class="far fa-circle text-warning"></i> Promotions</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#"><i class="far fa-circle text-primary"></i> Social</a>
            </li>
          </ul>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div> --}}
    <!-- /.col -->
  <div class="col-md-9">
    <div class="card card-primary card-outline">
      <div class="card-header">
        <h3 class="card-title">{{ $conversaction->customer->name }}</h3>

        
      </div>
      <!-- /.card-header -->
      <div class="card-body p-0 chat-body" id="conversactionbosy">
        <input type="hidden" id="conversation_u_id" value="{{$conversaction->uuid}}">
        
       
        <!-- /.mailbox-controls -->
        <div class="mailbox-read-message" id="chatBody">
          @foreach ($chat as $item)
              @if($item->sender_id==Auth::user()->id)
              <p> </p>
                <div class="text-right " style="margin-top: 30px;">
                  <span class="messages send_messages"> {{ $item->messages }}</span>
              </div>
              @else
                <div class="text-left " style="margin-top: 30px;">
                  <span class="messages receive_messages">
                      {{ $item->messages }}
                  </span>
                  
              </div>
              @endif
          @endforeach
         
          
            
        </div>
        <!-- /.mailbox-read-message -->
      </div>
      <!-- /.card-body -->
      <div class="card-footer ">
        <div class="form-group">
            <input type="text" class="form-control" id="message-text">
        </div>
      </div>
      <!-- /.card-footer -->
      <div class="card-footer">
        <div class="float-right">
          <button type="button" class="btn btn-default" onclick="sendMessage()">Send</button>
        </div>
      </div>
      <!-- /.card-footer -->
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

<script>
  $(document).ready(function(){
    setInterval(() => {
        receiveMessages()
    }, 2000);
  })
    

	
    function sendMessage(){
       message= $("#message-text").val()
       
       html='<br><div class="text-right mt-2"><span class="messages send_messages"> '+message+'</span></div>';
       $("#chatBody").append(html)
       $("#message-text").val('')
       $("#message-text").focus()
       var uid=$("#conversation_u_id").val()
       $.ajax({
        url:'{{ route("broker.send.message") }}',
        type:'get',
        data:{uuid:uid,message:message},
        success:function(response){

        }
       })
      //  scrollBottom()
    }
    function receiveMessages(){
      
       var uid=$("#conversation_u_id").val()
      $.ajax({
        url:'{{ route("get.received.messages") }}',
        type:'get',
        data:{uuid:uid},
        success:function(response){
          if(response.status==true){
            // res=response.data
            html='<br><div class="text-left mt-2"><span class="messages receive_messages">'+response.messages+'</span></div>';
           $("#chatBody").append(html)
          }
        }
      })
      
    }
</script>

@endsection