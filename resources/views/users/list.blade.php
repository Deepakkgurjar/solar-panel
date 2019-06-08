@extends('partials.main')
@section('content')
   
     <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card card-plain">
                <div class="card-header card-header-primary">
                  <h4 class="card-title mt-0"> Users List</h4>
                  <p class="card-category"> Here is the showing all Android Users</p>
                </div>
               
                <form class="d-flex justify-content-end" method="get" action="{{route('filter-user-list')}}" >
                    {{csrf_field()}}
                    <div class="d-flex align-items-end flex-row-reverse" style="margin-top: 23px;">
                      <button type="submit" class="btn btn-white btn-raised btn-fab btn-round">
                        <i class="material-icons">search</i>
                      </button>
                      
                      <input type="text" class="form-control " id="address"name="address" placeholder="Address" value="@if(!empty($inputs['address'])) {{$inputs['address']}} @endif">

                      <input type="text" class="form-control" id="email"name="email" placeholder="Email Address" value="@if(!empty($inputs['email'])){{$inputs['email']}} @endif">

                      <input type="text" class="form-control" id="mobile"name="mobile" placeholder="Contact no" value="@if(!empty($inputs['mobile'])){{$inputs['mobile']}} @endif">

                      <input type="text" class="form-control " id="userName"name="userName" placeholder="Name" value="@if(!empty($inputs['userName'])){{$inputs['userName']}} @endif">
                    </div>
                  </form>

                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead class="">
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile No</th>
                        <th>Address Type</th>
                        <th>Address</th>
                        <th>Document Image</th>
                        <th>Profile Image</th>
                        <th>Action</th>
                      </thead>
                      <tbody>
                        @if(count($getUsers) > 0)
                        @foreach($getUsers as $key=>$value)
                        <tr>
                          <td>{{$value->full_name}}</td>
                          <td>@if(empty($value->email)) -- @else {{$value->email}} @endif</td>
                          <td>{{$value->mobile_no}}</td>
                          <td>@if(empty($value->address_type)) -- @else {{$value->address_type}} @endif</td>
                          <td>@if(empty($value->address)) -- @else {{$value->address}} @endif</td>
                          <td>@if(empty($value->document)) -- @else <a href="{{asset($value->document)}}" target="blank">See Document</a> @endif</td>
                          <td>@if(empty($value->profile_img)) -- @else <a href="{{asset($value->profile_img)}}" target="blank">See Profile Image</a> @endif</td>
                          
                          <td><div class="btn-group">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Action
                                </button>
                                <div class="dropdown-menu">
                                  
                                  <a class="dropdown-item" href="{{route('view-user-orders',$value->id)}}"><i class="material-icons">rowing </i>Orders</a>

                                  <a class="dropdown-item" href="{{route('view-plant-profile',$value->id)}}"><i class="material-icons">rowing </i>Plant Profile</a>
                                  
                                 
                              </div>
                          </td>

                        </tr>
                        @endforeach
                        @else
                        <tr>
                          <td colspan="8"><center>Record not found !!</center></td>
                        </tr>
                        @endif
                      </tbody>
                    </table>
                    {{ $getUsers->appends(Illuminate\Support\Facades\Input::except('page'))->links() }}
                    <!-- {{$getUsers->links()}} -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
     
@endsection