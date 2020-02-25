@extends('partials.app')

@section('title','All Members')

@section('content')

<div id="content-wrapper">

    <div class="container-fluid">

      <!-- Breadcrumbs-->
      {{-- <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Tables</li>
      </ol> --}}

      <!-- DataTables Example -->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fas fa-table"></i>
          All Members
        <a class="btn btn-primary float-right" href="{{route('members.create')}}">Add New</a>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Sl</th>
                  <th>Name</th>
                  <th>Phone</th>
                  <th>Amount</th>
                  <th>Start date</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Sl</th>
                  <th>Name</th>
                  <th>Phone</th>
                  <th>Amount</th>
                  <th>Start date</th>
                  <th>Action</th>
                </tr>
              </tfoot>
              <tbody>
                @forelse($members as $key=>$member)
                <tr>
                <td>{{$key+1}}</td>
                <td>{{$member->first_name}} {{$member->last_name}}</td>
                <td>{{$member->phone}}</td>
                <td>{{$member->total_amount}}</td>
                <td>{{$member->created_at->diffForHumans()}}</td>
                <td>
                <a href="{{route('members.show',$member->id)}}" class="btn btn-success">Details</a>
                <a href="{{route('members.show',$member->id)}}" class="btn btn-warning">Edit</a>
                <a href="{{route('members.show',$member->id)}}" class="btn btn-danger">Delete</a>
                </td>
                </tr>
                @empty 
                
                @endforelse
                
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
      </div>

      <p class="small text-center text-muted my-5">
        <em>More table examples coming soon...</em>
      </p>

    </div>
    <!-- /.container-fluid -->

    <!-- Sticky Footer -->
    <footer class="sticky-footer">
      <div class="container my-auto">
        <div class="copyright text-center my-auto">
          <span>Copyright © Your Website 2019</span>
        </div>
      </div>
    </footer>

  </div>

@endsection

@push('js')

@endpush