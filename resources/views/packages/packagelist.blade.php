@extends('partials.main')
@section('content')
   
     <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card card-plain">
                <div class="card-header card-header-primary">
                  <h4 class="card-title mt-0"> Package List</h4>
                  <p class="card-category"> Here is the showing all Packages</p>
                </div>
                  <form method="get" action="{{route('filter-packages')}}" class="d-flex justify-content-end">
                      {{csrf_field()}}
                    <div class="d-flex align-items-end flex-row-reverse"style="margin-top: 23px;">
                      
                      <button type="submit" class="btn btn-white btn-raised btn-fab btn-round">
                        <i class="material-icons">search</i>
                      </button>

                      <input type="text" class="form-control" id="pPrize"name="pPrize" placeholder="Prize" value="@if(!empty($inputs['pPrize'])) {{$inputs['pPrize']}} @endif" autocomplete="false">

                      <input type="text" class="form-control" id="pType"name="pType" placeholder="Type" value="@if(!empty($inputs['pType'])){{$inputs['pType']}} @endif">

                      <input type="text" class="form-control " id="pName"name="pName" placeholder="Name" value="@if(!empty($inputs['pName'])){{$inputs['pName']}} @endif">
                      
                    </div>
                  </form>
                </div>
              </div>
                
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead class="">
                        <th>Name</th>
                        <th>Type</th>
                        <th>Capacity</th>
                        <th>Prize</th>
                        <th>GST %</th>
                        <th>Active</th>
                        <th>Action</th>
                      </thead>
                      <tbody>
                        @if(count($allPackages) > 0)
                        @foreach($allPackages as $key=>$value)
                        <tr>
                          <td>{{$value->package_name}}</td>
                          <td>{{$value->package_type}}</td>
                          <td>{{$value->panel_capacity}}</td>
                          <td>{{$value->prize}}</td>
                          <td>{{$value->gst}}</td>
                          <td>@if($value->active=='y') Yes @else Not @endif</td>
                          <td><div class="btn-group">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Action
                                </button>
                                <div class="dropdown-menu">
                                  
                                  <a class="dropdown-item" href="{{route('edit-package',$value->id)}}"><i class="material-icons">edit</i>Edit</a>
                                  @if($value->active=='y')
                                  <div class="dropdown-divider"></div>
                                  <a class="dropdown-item" href="{{route('package-activation',$value->id)}}"><i class="material-icons">voice_over_off </i>Deactivate</a>
                                  @else
                                  <div class="dropdown-divider"></div>
                                  <a class="dropdown-item" href="{{route('package-activation',$value->id)}}"><i class="material-icons">record_voice_over </i>Activate</a>
                                  @endif
                                </div>
                              </div>
                          </td>

                        </tr>
                        @endforeach
                        @else
                        <tr>
                          <td colspan="7"><center>No Record Found</center></td>
                        </tr>
                        @endif
                      </tbody>
                    </table>
                    {{$allPackages->links()}}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
     
@endsection