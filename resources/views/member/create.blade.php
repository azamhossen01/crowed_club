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
          Add New Member
        <a class="btn btn-primary float-right" href="{{route('members.index')}}">Back</a>
        </div>
        <div class="card-body">
        <form action="{{route('members.store')}}" method="post" enctype="multipart/form-data">
          @csrf
            <div class="form-group">
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="text" name="first_name" id="first_name" class="form-control" placeholder="First name" required="required" autofocus="autofocus">
                    <label for="first_name">First name</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="text" name="last_name"  id="last_name" class="form-control" placeholder="Last name" required="required">
                    <label for="last_name">Last name</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="email" id="email" name="email" class="form-control" placeholder="Email address" required="required">
                    <label for="email">Email address</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="text" id="phone" name="phone" class="form-control" placeholder="Phone Number" required="required">
                    <label for="phone">Phone Number</label>
                  </div>
                </div>
              </div>
              
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <textarea name="address" id="address" placeholder="Address" class="form-control"  cols="30" rows="5"></textarea>
              </div>
            </div>

            <div class="form-group">
              <div class="form-label-group">
                <input type="file" name="image" id="image">
              </div>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </form>
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