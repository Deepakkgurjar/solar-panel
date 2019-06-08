@extends('partials.main')
@section('content')
   
     <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card card-plain">
                <div class="card-header card-header-primary">
                  <h4 class="card-title mt-0"> Edit Time Slots</h4>
                  <p class="card-category"> Here is the showing all time slot's</p>
                  <div style="float: right; background-color: black;">

                    <a class="dropdown-item" style="color:#9c27b0;" href="{{route('add-time-slot')}}">
                    <i class="material-icons">add</i>Add Time Slots</a>
                  </div>
                </div>
                <p><small>Note:</small> Follow 24 Hrs. format</p>
                <div class="card-body">
                  <div class="table-responsive">
                    <form method="post" action="{{route('slot-save')}}" >
                      {{csrf_field()}}
                    <table class="table table-hover">
                      <thead class="">
                       
                        <th>ID</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        
                        <th>Delete</th>
                       
                      </thead>
                      <tbody>
                        @if(count($timeSloat) > 0)
                        @foreach($timeSloat as $key=>$value)
                        
                        <tr>
                          <input type="hidden" name="id[]" value="{{$value->id}}">
                          <td>{{$key+1}}</td>
                          <td>
                            <div class="input-group clockpicker "data-placement="bottom" data-align="top" data-autoclose="true">
                              <input type="text" class="form-control" value="{{date('H:i',$value->start_time)}}" name="startTime[]"autocomplete="off">
                                
                              </div>
                            </td>
                          <td>
                            <div class="input-group clockpicker " data-placement="bottom" data-align="top" data-autoclose="true">
                              <input type="text" class="form-control" value="{{date('H:i',$value->end_time)}}" name="endTime[]"autocomplete="off">
                                
                            </div>
                          </td >
                          
                          <td>
                            <a class="dropdown-item" href="{{route('delete-time-slot',$value->id)}}">
                              <i class="material-icons">close</i></a>
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
                      
                        <button class="btn btn-primary" type="submit">
                          <i class="material-icons">add_alarm</i>Save
                        </button>
                        
                  </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>


    
@endsection