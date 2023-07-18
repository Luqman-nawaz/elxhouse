@extends('layouts.admin.admin_app')
@section('content')
<div class="row">
  <div class="col-sm-12">
    <div class="card">
        <div class="card-header">
          <h3 class="card-title">Customers</h3>
          <a href="{{route('admin.customer.csv')}}" class="btn btn-primary">Export As Csv</a>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="customers" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>#</th>
              <th>Name</th>
              <th>Address</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Region</th>
              <th>Distric</th>
              <th>Last Login</th>
             
            </tr>
            </thead>
            <tbody>
                @php $i=1 @endphp
               @foreach ($users as $user)
                   <tr>
                    {{-- {{ dd($user->profile) }} --}}
                        <td>{{ $i++ }}</td>
                        <td> <a href="{{route('admin.customer.detail',$user->id)}}"> {{ $user->name }}</a></td>
                        <td>{{ $user->profile->address }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->profile->phone }}</td>
                        <td>
                          @if($user->profile)
                            @if($user->profile->region)
                                {{ $user->profile->region->name }}
                            @endif

                            @else
                            ---
                          @endif
                          
                       </td>
                        <td>
                          @if($user->profile)
                            @if($user->profile->distric)
                                {{ $user->profile->distric->name }}
                            @endif

                            @else
                            ---
                          @endif
                          
                       </td>
                        <td>{{ $user->last_login }}</td>
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
  $("#customers").DataTable();
</script>
@endsection