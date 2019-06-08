@extends('partials.main')
@section('content')
   
     <div class="content">
        <div class="container-fluid">
          <div class="row"style="justify-content: center;">
            <div class="col-md-6">
              <div class="card card-plain">
                <div class="card-header card-header-primary">
                  <h4 class="card-title mt-0">Add Worker</h4>
                  <p class="card-category"> Here you can add more Workers </p>
                </div>
                <div class="card-body">
                  <form action="{{route('save-worker')}}" method="post"enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group"> <!-- left unspecified, .bmd-form-group will be automatically added (inspect the code) -->
                      <label for="formGroupExampleInput" class="bmd-label-floating">Name</label>
                      <input type="text" class="form-control" id="workerName" name="workerName">
                    </div>
                    <div class="form-group"> <!-- manually specified --> 
                      <label for="formGroupExampleInput" class="bmd-label-floating">Mobile no</label>
                      <input type="text" class="form-control" id="workerMobile" name="workerMobile">
                    </div>
                    <br>
                    <label for="formGroupExampleInput" class="bmd-label-floating">Worker Photo</label>
                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                      <div class="fileinput-new thumbnail img-raised">
                          <div class="fileinput-preview fileinput-exists thumbnail img-raised imgprevi"></div>
                      
                      </div>
                      
                      <div><br>
                          <span class="btn btn-raised btn-round btn-default btn-file">
                              <input type="file" name="workerPhoto" id="workerPhoto">
                              
                          </span>
                          
                      </div>
                  </div>
                    <div>
                    <br><br>
                    <div>
                      <a href="{{ url()->previous() }}" class="btn btn-default">Cancel</a>
                      <button type="submit" class="btn btn-primary btn-raised">Submit</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
     
@endsection