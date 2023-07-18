@extends('layouts.admin.admin_app')
@section('content')
<div class="row">
  <div class="col-sm-12">
    <div class="card">
        <div class="card-header">
          <h3 class="card-title">Brokers</h3>
          {{-- <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#addRegionModal">Add New Region</button> --}}
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="regions" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>#</th>
              <th>Name</th>
              <th>Address</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Region</th>
              <th>Company</th>
              <th>Company Number</th>
              <th>Customer Views</th>
              <th>Last Login</th>
              <th>Verified</th>
              <th>Action</th>
             
            </tr>
            </thead>
            <tbody>
                @php $i=1 @endphp
               @foreach ($users as $user)
                   <tr>
                    {{-- {{ dd($user->profile) }} --}}
                        <td>{{ $i++ }}</td>
                        <td><a href="{{route('admin.broker.detail',$user->id)}}">{{ $user->name }} </a> </td>
                        <td>{{ $user->profile->address }}</td>
                        <td>{{$user->email}}</td>
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
                        <td>{{ $user->profile->company_name }}</td>
                        <td>{{ $user->profile->company_number }}</td>
                        <td>{{$user->customerViews->count() }}</td>
                        <td>{{ $user->last_login }}</td>
                        <td>
                          {{-- {{$user->activated}} --}}
                          @if($user->activated=='1')
                            <span class="badge badge-success">Activated </span>
                          @elseif($user->activated=='2')
                              <span class="badge badge-danger">Deactivated </span>
                          @else
                            <a href="" class="badge badge-warning">Pending</a>
                          @endif
                        </td>
                        <td>
                          <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Action
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <a class="dropdown-item" href="{{ route('admin.broker.activated',$user->id) }}">Activate</a>
                              <a class="dropdown-item" href="{{ route('admin.broker.deactive',$user->id) }}">Deactivate</a>
                            </div>
                          </div>
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

@endsection