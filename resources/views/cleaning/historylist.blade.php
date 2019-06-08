@extends('partials.main')
@section('content')
   
     <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              
                <form class="form-group col-md-12 row" action="{{route('cleaning-history-filter')}}" method="post">
                  {{csrf_field()}}

                  <div class="form-group col-md-4">
                    <label class="label-control">From</label>
                    <input type="text" class="form-control datetimepicker" id="fromclean" name="fromclean" value="@if(!empty($fromValue)) {{$fromValue}} @endif" />
                  </div>
                  <div class="form-group col-md-4">
                    <label class="label-control">To</label>
                    <input type="text" class="form-control datetimepicker" id="toclean" name="toclean" value="@if(!empty($toValue)) {{$toValue}} @endif"/>
                  </div>
                  <div class="form-group">
                    <button class="btn btn-primary"><i class="material-icons">search</i>Search</button>
                  </div>
                </form>
              
          
              <div class="card card-plain">
                <div class="card-header card-header-primary">
                  <h4 class="card-title mt-0">Cleaning History</h4>
                  <p class="card-category"> Here is the showing all recent cleanings</p>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead class="">
                       
                        <th>Order Id</th>
                        <th>Service Date</th>
                        <th>Service Time</th>
                        <th>Address</th>
                        <th>Cleaning Date</th>
                        <th>Cleaning Time</th>
                        <th>Action</th>
                      </thead>
                      <tbody>
                        @if(count($cleaningHistory) > 0)
                        @foreach($cleaningHistory as $key=>$value)
                        <tr>
                          <td>{{$value->orders->id}}</td>
                          <td>{{$value->orders->service_date}}</td>
                          <td>{{date("h:i A",$value->orders->timeslot->start_time)}} to {{date("h:i A",$value->orders->timeslot->end_time)}}</td>
                          <td>{{$value->orders->address}}</td>
                          <td>{{date("d-m-Y",$value->cleaning_time)}}</td>
                          <td>{{date("h:m A",$value->cleaning_time)}}</td>
                          <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Action
                                </button>
                                <div class="dropdown-menu">
                                  <a class="dropdown-item viewOrderDetails" id="viewOrderDetails" data-toggle="modal" data-target="#OrderDetailModal" data-order_id="{{$value->orders->id}}"><i class="material-icons">visibility</i>View Order Details</a>
                                  
                                </div>
                              </div>
                          </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                          <td colspan="5"><center>No Cleaning History</center> </td>
                        </tr>
                        @endif
                 
                      </tbody>
                    </table>
                    {{$cleaningHistory->links()}}
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