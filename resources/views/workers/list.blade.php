@extends('partials.main')
@section('content')
   
     <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card card-plain">
                <div class="card-header card-header-primary">
                  <h4 class="card-title mt-0"> Worker List</h4>
                  <p class="card-category"> Here is the showing all Workers</p>
                </div>
                <form class="d-flex justify-content-end" method="get" action="{{route('filter-workers')}}" >
                    {{csrf_field()}}
                    
                    <div class="d-flex align-items-end flex-row-reverse"style="margin-top: 23px;">
                      <button type="submit" class="btn btn-white btn-raised btn-fab btn-round">
                        <i class="material-icons">search</i>
                      </button>
                      <input type="text" class="form-control" id="mobile"name="mobile" placeholder="Contact no" value="@if(!empty($inputs['mobile'])){{$inputs['mobile']}} @endif">

                      <input type="text" class="form-control " id="workerName"name="workerName" placeholder="Worker Name" value="@if(!empty($inputs['workerName'])){{$inputs['workerName']}} @endif">
                    </div>
                  </form>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead class="">
                        <th>Name</th>
                        <th>Photo</th>
                        <th>Mobile</th>
                        <th>Time</th>
                        <th>Action</th>
                      </thead>
                      <tbody>
                        @if(count($getWorkers) > 0)
                        @foreach($getWorkers as $key=>$value)
                        <tr>
                          <td>{{$value->name}}</td>
                          <td><a href="{{$value->photo}}"target="_blank">See Photo</a></td>
                          <td>{{$value->mobile}}</td>
                          <td>{{date("d-M-Y",$value->time)}}</td>
                          <td><div class="btn-group">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Action
                                </button>
                                <div class="dropdown-menu">
                                
                                  <a class="dropdown-item" href="{{route('showfor-assign-order',$value->id)}}"><i class="material-icons">touch_app</i>Assign New Order</a>

                                  <a class="dropdown-item" href="{{route('view-worker-tasks',$value->id)}}"><i class="material-icons">visibility</i>View all Assigned orders</a>

                                  <a class="dropdown-item" href="{{route('edit-worker',$value->id)}}"><i class="material-icons">edit</i>Edit</a>
                                  
                                  <div class="dropdown-divider"></div>
                                  <a class="dropdown-item" href="#"><i class="material-icons">delete</i>Delete</a>
                                </div>
                              </div>
                          </td>

                        </tr>
                        @endforeach
                        @else
                        <tr>
                          <td colspan="5"><center>Record not found !!</center></td>
                        </tr>
                        @endif
                      </tbody>
                    </table>
                    {{$getWorkers->links()}}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
     
@endsection