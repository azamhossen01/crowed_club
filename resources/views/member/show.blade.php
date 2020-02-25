@extends('partials.app')

@section('title','Member Details')

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
          Member Details
        <a class="btn btn-primary float-right ml-2" href="{{route('members.index')}}">Back</a>
        <button class="btn btn-success float-right" onclick="add_new_payment({{$member->id}})">New</button>
        </div>
        <div class="card-body">
        <div class="row">
        <div class="col-lg-4">
        <div class="card">
          <div class="card-body">
            @if($member->image)
          <img src="{{asset('backend/members/'.$member->image)}}" class="img-responsive" width="100%" alt="">
          @endif
          <div class="card-body">
            <strong>Name : <i>{{$member->first_name}} {{$member->last_name}}</i></strong><br>
            <strong>Email : <i>{{$member->email}}</i></strong><br>
            <strong>Phone : <i>{{$member->phone}}</i></strong><br>
            <strong>Address : <i>{{$member->address}}</i></strong><br>
            <strong>Total Payment : <i>{{$member->payments->sum('amount')}}</i></strong><br>
            <strong>Profit(20%) : <i>{{round((($member->payments->sum('amount')/12)*0.20),2)}}</i></strong><br>
          </div>
          </div>
        </div>
            
          </div>
          <div class="col-lg-8">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Sl</th>
                  <th>Amount</th>
                  <th>Payment Date</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Sl</th>
                  <th>Amount</th>
                  <th>Payment Date</th>
                  <th>Action</th>
                </tr>
              </tfoot>
              <tbody>
                
                @forelse($member->payments as $key=>$payment)
                <tr>
                  <td>{{$key+1}}</td>
                  <td>{{$payment->amount}}</td>
                  <td>{{$payment->created_at->format('M d Y')}}</td>
                  <td>
                    <button class="btn btn-warning" onclick="edit_payment({{$payment->id}})">Edit</button>
                  <form action="{{route('payments.destroy',$payment->id)}}" class="d-inline-block" method="post">
                    @csrf 
                    @method('delete')
                      <button class="btn btn-danger" type="submit" onclick="return confirm('are you sure?')">Delete</button>
                    </form>
                  </td>
                </tr>
                @empty 

                @endforelse

              </tbody>
            </table>
          </div>
          </div>
          
        </div>
          
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
      </div>

    
    </div>
    <!-- /.container-fluid -->

  </div>


  {{-- modal for edit payment start here --}}
  <div class="modal fade" id="payment_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="title">Edit Payment</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="" method="post" id="payment_form">
          @csrf 
          <input type="hidden" name="payment_id" id="payment_id" >
          <input type="hidden" name="member_id" id="member_id" value="{{$member->id}}" >
            <div class="form-group">
              <label for="amount">Amount</label>
              <input type="number" name="amount" required id="amount" class="form-control">
            </div>
          
        </div>
        <div class="modal-footer">
          <button class="btn btn-danger" type="reset">Clear</button>
          <button type="submit" class="btn btn-primary" id="payment_button">Update</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  {{-- modal for edit payment end here --}}



@endsection

@push('js')
<script>
  function edit_payment(payment_id){

    if(payment_id){
      $.ajax({
        type : 'get',
        data : {payment_id:payment_id},
        url : "{{route('edit_payment')}}",
        dataType : 'json',
        success : function(data){
          console.log(data);
          $('#title').text('Edit Payment');
          $('#amount').val(data.amount);
          
          $('#payment_id').val(data.id);
          $('#payment_form').attr('action', "{{route('update_payment')}}");
          $('#payment_button').html('Update');
          $('#payment_modal').modal('show');
        }
      });
    }
  }

  function add_new_payment(member_id){
    if(member_id){
      $('#amount').val(0);
      $('#title').text('New Payment');
      $('#payment_form').attr('action', "{{route('payments.store')}}");
      $('#payment_button').html('Add');
      $('#payment_modal').modal('show');
    }
  }
</script>
@endpush