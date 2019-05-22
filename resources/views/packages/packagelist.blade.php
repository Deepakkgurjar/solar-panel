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
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead class="">
                        <th>Name</th>
                        <th>Type</th>
                        <th>Capacity</th>
                        <th>Prize</th>
                        <th>GST %</th>
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
                          <td><div class="btn-group">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Action
                                </button>
                                <div class="dropdown-menu">
                                  
                                  <a class="dropdown-item" href="{{route('edit-package',$value->id)}}"><i class="material-icons">edit</i>Edit</a>
                                  
                                  <div class="dropdown-divider"></div>
                                  <a class="dropdown-item" href="#"><i class="material-icons">delete</i>Delete</a>
                                </div>
                              </div>
                          </td>

                        </tr>
                        @endforeach
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