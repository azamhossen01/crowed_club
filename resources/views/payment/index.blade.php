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
          All Payments
        <a class="btn btn-primary float-right" href="{{route('payments.create')}}">Add New</a>
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
                
                <?php $i = 1; ?>
                @forelse($payments as $key=>$payment)
                <tr>
                <td>{{$i++}}</td>
                <td>{{$payment->first()->member->first_name}} {{$payment->first()->member->last_name}}</td>
                <td>{{$payment->first()->member->phone}}</td>
                <td>{{$payment->sum('amount')}}</td>
                <td>{{$payment->first()->member->created_at->diffForHumans()}}</td>
                <td>
                <a href="{{route('payments.show',$payment->first()->id)}}" class="btn btn-success">Details</a>
                <a href="{{route('payments.edit',$payment->first()->id)}}" class="btn btn-warning">Edit</a>
                <a href="{{route('payments.edit',$payment->first()->id)}}" class="btn btn-danger">Delete</a>
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