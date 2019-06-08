@extends('partials.main')
@section('content')
   
     <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card card-plain">
                <div class="card-header card-header-primary">
                  <h4 class="card-title mt-0"> User Orders List</h4>
                  <p class="card-category"> Here is the showing all Orders of a User</p>
                </div>
                
                  <form class="d-flex justify-content-end" method="get" action="{{route('filter-user-orders')}}" >
                    {{csrf_field()}}
                    <input type="hidden" name="id" id="id" value="@if(!empty($getUserOrders[0])) {{$getUserOrders[0]->user_id}} @else @endif">
                    <div class="d-flex align-items-end flex-row-reverse"style="margin-top: 23px;">
                      <button type="submit" class="btn btn-white btn-raised btn-fab btn-round">
                        <i class="material-icons">search</i>
                      </button>
                      &nbsp;
                      <select name="selectorPay" class="form-control" title="Payment Status">
                      <option value="">--Select Payment Status--</option>
                        <option value="done"@if(!empty($inputs['selectorPay']) && $inputs['selectorPay']=='done') selected @endif>Done</option>
                        <option value="pending"@if(!empty($inputs['selectorPay']) && $inputs['selectorPay']=='pending') selected @endif>Pending</option>
                      </select>
                      
                      <select name="selectorOrd" class="form-control" title="Order Status">
                      <option value="">--Select Order Status--</option>
                        <option value="done"@if(!empty($inputs['selectorOrd']) && $inputs['selectorOrd']=='done') selected @endif>Done</option>
                        <option value="pending"@if(!empty($inputs['selectorOrd']) && $inputs['selectorOrd']=='pending') selected @endif>Pending</option>
                          
                      </select>
                      
                      <input type="text" class="form-control datepicker" id="bookdate"name="bookdate" placeholder="Booking Date" value="@if(!empty($inputs['bookdate'])){{$inputs['bookdate']}} @endif" autocomplete="false">

                      <input type="text" class="form-control datepicker" id="serdate"name="serdate" placeholder="Service Date" value="@if(!empty($inputs['serdate'])){{$inputs['serdate']}} @endif" autocomplete="false">

                      <input type="text" class="form-control " id="order_id"name="order_id" placeholder="Order Id" value="@if(!empty($inputs['order_id'])){{$inputs['order_id']}} @endif">
                      </div>
                  </form>
               
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead class="">
                        <th>Order Id</th>
                        <th>Package Name</th>
                        <th>Service Date</th>
                        <th>Service Time</th>
                        <th>Order Status</th>
                        <th>Payment status</th>
                        <th>View</th>
                      </thead>
                      <tbody>
                        @if(count($getUserOrders) > 0)
                        @foreach($getUserOrders as $key=>$value)
                        <tr>
                          <td>{{$value->id}}</td>
                          <td>{{$value->packageData->package_name}}</td>
                          <td>{{$value->service_date}}</td>
                          <td>{{date("h:i A",$value->timeSlot->start_time)}} to {{date("h:i A",$value->timeSlot->end_time)}}</td>
                          @if($value->status=='done')
                          <td><img src="{{asset('assets/img/sucess.png')}}"/>&nbsp;{{$value->status}}</td>
                          @else
                          <td><img src="{{asset('assets/img/wrong.png')}}"/>&nbsp;{{$value->status}}</td>
                          @endif

                          @if($value->payment_status=='done')
                          <td><img src="{{asset('assets/img/paymentSucess.png')}}"/>&nbsp;{{$value->payment_status}}</td>
                          @else
                          <td><img src="{{asset('assets/img/paymentNot.png')}}"/>&nbsp;{{$value->payment_status}}</td>
                          @endif
                          <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Action
                                </button>
                                <div class="dropdown-menu">
                                  <a class="dropdown-item viewOrderDetails" id="viewOrderDetails"data-toggle="modal" data-target="#OrderDetailModal"data-order_id="{{$value->id}}"><i class="material-icons">assignment</i>Detials</a>

                                  <a class="dropdown-item" href="{{route('view-feedback',$value->id)}}"><i class="material-icons">feedback </i>Feedback</a>
                                </div>
                            </div>
                          </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                          <td colspan="7"><center>Record not Found !!</center></td>
                        </tr>
                        @endif
                      </tbody>
                    </table>
                    <!-- {{ $getUserOrders->appends(Illuminate\Support\Facades\Input::except('page'))->links() }} -->
                    {{$getUserOrders->links()}}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Order Details Modal -->
      <div class="modal fade" id="OrderDetailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document"style="max-width: 800px;">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Complete Order Details</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" id="orderModal">

              <table class="table" width="100%" id="table-modal"><div class="row">
                <div class="col-md-12">
                  <h3 class="color-333 mt-0 f_20i">Order Id: <b><span class="color-333" id="order_no"></span></b></h3>
                  <h3 class="color-333 mt-0 f_20i">Payment Id: <b><span class="color-333" id="payment_id"></span></b></h3>
                  
                            </div>

                              <div class="col-md-12 mt-10">

                                <div class="row">
                                    <div class="col-md-1">
                                        <img src="{{asset('assets/img/redcircle.png')}}">
                                    </div>
                                    <div class="col-md-11 pl-0">
                                        <h4 class=" mt-0 "><b>Order by: </b><span class="color-333" id="order_by"></span></h4>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-1">
                                        <img src="{{asset('assets/img/redcircle.png')}}">
                                    </div>
                                    <div class="col-md-11 pl-0">
                                        <h4 class=" mt-0 "><b>Package Name: </b><span class="color-333" id="package_name"></span></h4>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-1">
                                        <img src="{{asset('assets/img/redcircle.png')}}">
                                    </div>
                                    <div class="col-md-11 pl-0">
                                        <h4 class=" mt-0 "><b>Service Date: </b><span class="color-333" id="service_date"></span></h4>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-1">
                                        <img src="{{asset('assets/img/redcircle.png')}}">
                                    </div>
                                    <div class="col-md-11 pl-0">
                                        <h4 class=" mt-0 "><b>Service Time: </b><span class="color-333" id="service_time"></span><b> to </b><span class="color-333"id="service_endTime"></span></h4>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-1">
                                        <img src="{{asset('assets/img/redcircle.png')}}">
                                    </div>
                                    <div class="col-md-11 pl-0">
                                        <h4 class=" mt-0 "><b>Booking Date: </b><span class="color-333" id="order_date"></span></h4>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-1">
                                        <img src="{{asset('assets/img/redcircle.png')}}">
                                    </div>
                                    <div class="col-md-11 pl-0">
                                        <h4 class=" mt-0 "><b>Service Address: </b><span class="color-333" id="service_addr"></span></h4>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-1">
                                        <img src="{{asset('assets/img/redcircle.png')}}">
                                    </div>
                                    <div class="col-md-11 pl-0">
                                        <h4 class=" mt-0 "><b>Contact no: </b><span class="color-333" id="order_mobile"></span></h4>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-1">
                                        <img src="{{asset('assets/img/redcircle.png')}}">
                                    </div>
                                    <div class="col-md-11 pl-0">
                                        <h4 class=" mt-0 "><b>Contact Email: </b><span class="color-333" id="order_email"></span></h4>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-1">
                                        <img src="{{asset('assets/img/redcircle.png')}}">
                                    </div>
                                    <div class="col-md-11 pl-0">
                                        <h4 class=" mt-0 "><b>Order Status: </b><span class="color-333" id="order_status"></span></h4>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-1">
                                        <img src="{{asset('assets/img/redcircle.png')}}">
                                    </div>
                                    <div class="col-md-11 pl-0">
                                        <h4 class=" mt-0 "><b>Payment Status: </b><span class="color-333" id="payment_status"></span></h4>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-1">
                                        <img src="{{asset('assets/img/redcircle.png')}}">
                                    </div>
                                    <div class="col-md-11 pl-0">
                                        <h4 class=" mt-0 "><b>Total Amount: </b><span class="color-333" id="order_amount"></span></h4>

                                    </div>
                                </div><br>

                                <div class="row">
                                    <div class="col-md-1">
                                        
                                    </div>
                                    <div class="col-md-11 pl-0">
                                        <h4 class=" mt-0 "><b>Panel Before: </b><span class="color-333" ><img id="panel_before" height="250px"width="250px" /></span><b>Panel After :</b><span class="color-333"><img id="panel_after" height="250px" width="250px" /></span></h4>

                                    </div>
                                </div>
                        
                                
                            </div>
                        </div>
                    </table>
              
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary"data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
     

@endsection