@extends('partials.main')
@section('content')
   
     <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card card-plain">
                <div class="card-header card-header-primary">
                  <h4 class="card-title mt-0"> Time Slots</h4>
                  <p class="card-category"> Here is the showing all time slot's</p>
                  <div style="float: right; background-color: black;">
                    <a class="dropdown-item" style="color:#9c27b0;" href="{{route('edit-time-slot')}}">
                    <i class="material-icons">edit</i>Edit Time Slots</a>
                  </div>
                  
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead class="">
                       
                        <th>ID</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Visible</th>
                        <th>Action</th>
                      </thead>
                      <tbody>
                        @if(count($timeSloat) > 0)
                        @foreach($timeSloat as $key=>$value)

                        <tr>
                          <td>{{$key+1}}</td>
                          <td>{{date("H:i:A",$value->start_time)}}</td>
                          <td>{{date("H:i:A",$value->end_time)}}</td>
                          <td>@if($value->active=='y')Yes @else No @endif</td>
                          <td><div class="btn-group">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Action
                                </button>
                                <div class="dropdown-menu">
                                  
                                  @if($value->active =='y')
                                    <a class="dropdown-item" href="{{route('slot-hide',$value->id)}}">
                                      <i class="material-icons">alarm_off</i>Hide</a>
                                  @else
                                    <a class="dropdown-item" href="{{route('slot-show',$value->id)}}">
                                      <i class="material-icons">alarm</i>Show</a>
                                  @endif

                                  
                                </div>
                              </div>
                          </td>
                        </tr>
                        @endforeach

                        @else
                        <tr>
                          <td>No Orders Found</td>
                        </tr>
                        @endif
                      </tbody>
                    </table>
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>


    
@endsection