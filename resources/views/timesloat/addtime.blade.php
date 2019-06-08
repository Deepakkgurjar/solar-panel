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
                  
                </div>
                <p><small>Note:</small> Follow 24 Hrs. format</p>
                <div class="card-body">
                  <div class="table-responsive">
                    <form method="post" action="{{route('slot-update')}}" >
                            {{csrf_field()}}
                            
                    <table class="table table-hover">
                      <thead class="">
                        <th>Start Time</th>
                        <th>End Time</th>
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                            <div class="input-group clockpicker "data-placement="bottom" data-align="top" data-autoclose="true">
                              <input type="text" class="form-control" value="" name="startTime"autocomplete="off">
                                
                              </div>
                            </td>
                          <td>
                            <div class="input-group clockpicker " data-placement="bottom" data-align="top" data-autoclose="true">
                              <input type="text" class="form-control" value="" name="endTime" autocomplete="off">
                            </div>
                          </td >
                        </tr>
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