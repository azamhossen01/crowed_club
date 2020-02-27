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
                <td>{{$member->created_at->format('M d Y')}}</td>
                <td>
                <a href="{{route('members.show',$member->id)}}" class="btn btn-success">Details</a>
                <button onclick="edit_member({{$member->id}})" class="btn btn-warning">Edit</button>
                <form action="{{route('members.destroy',$member->id)}}" class="d-inline-block" method="post">
                  @csrf 
                  @method('delete')
                  <button type="submit" class="btn btn-danger">Delete</button>
                </form>
                {{-- <a href="{{route('members.show',$member->id)}}" class="btn btn-danger">Delete</a> --}}
                </td>
                </tr>
                @empty 
                
                @endforelse
                
              </tbody>
            </table>
          </div>
        </div>
        {{-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> --}}
      </div>

    </div>
    <!-- /.container-fluid -->

    <div class="modal fade" id="edit_member" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="title">Edit Member</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{route('update_member')}}" method="post" enctype="multipart/form-data">
            @csrf 
            <input type="hidden" id="member_id" name="member_id">
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
                    <input type="text" name="last_name"  id="last_name" class="form-control" placeholder="Last name" >
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
                <div class="row">
                  <div class="col-lg-6">
                     <input type="file" name="image" id="image">
                  </div>
                  <div class="col-lg-4">
                    <img src="" id="member_image" width="100%" alt="">
                  </div>
                </div>
               
              </div>
            </div>
            
          </div>
          <div class="modal-footer">
            <button class="btn btn-danger" type="reset">Clear</button>
            <button type="submit" class="btn btn-primary" >Update</button>
            </form>
          </div>
        </div>
      </div>
    </div>
   
  </div>

@endsection

@push('js')
<script>
  function edit_member(member_id){
    if(member_id){
      $.ajax({
        type : 'get',
        data : {member_id:member_id},
        url : "{{route('edit_member')}}",
        dataType : 'json',
        success : function(data){
          console.log(data);
          $('#first_name').val(data.first_name);
          $('#last_name').val(data.last_name);
          $('#address').val(data.address);
          $('#email').val(data.email);
          $('#phone').val(data.phone);
          $('#member_id').val(data.id);
          if(data.image !== null){
            $('#member_image').attr('src',"{{asset('backend/members')}}/"+data.image);
          }
          
          $('#edit_member').modal('show');
        }
      });
    }
  }
</script>
@endpush