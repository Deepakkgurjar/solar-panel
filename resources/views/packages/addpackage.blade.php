@extends('partials.main')
@section('content')
   
     <div class="content">
        <div class="container-fluid">
          <div class="row"style="justify-content: center;">
            <div class="col-md-6">
              <div class="card card-plain">
                <div class="card-header card-header-primary">
                  <h4 class="card-title mt-0">Add Package</h4>
                  <p class="card-category"> Here you can add more packages in your list </p>
                </div>
                <div class="card-body">
                  <form action="{{route('save-package')}}" method="post">
                    {{csrf_field()}}
                    
                    <div class="form-group"> <!-- left unspecified, .bmd-form-group will be automatically added (inspect the code) -->
                      <label for="formGroupExampleInput" class="bmd-label-floating">Package Name</label>
                      <input type="text" class="form-control" id="packageName" name="packageName">
                    </div>
                    <div class="form-group"> <!-- manually specified --> 
                      <label for="formGroupExampleInput" class="bmd-label-floating">Package Type</label>
                      <input type="text" class="form-control" id="packageType" name="packageType">
                    </div>
                    <div class="form-group"> <!-- manually specified --> 
                      <label for="formGroupExampleInput" class="bmd-label-floating">Panel Capacity</label>
                      <input type="text" class="form-control" id="panelCapacity" name="panelCapacity">
                    </div>
                    <div class="form-group"> <!-- manually specified --> 
                      <label for="formGroupExampleInput" class="bmd-label-floating">Prize</label>
                      <input type="text" class="form-control" id="prize" name="prize">
                    </div>
                    <div>

                    <div class="form-group"> <!-- manually specified --> 
                      <label for="formGroupExampleInput" class="bmd-label-floating">GST</label>&nbsp;&nbsp;
                      
                      
                      <select class="form-control" id="gst" name="gst" style="width: 50px;">
                        <option value="18%">18%</option>
                        <option value="20%">20%</option>
                        <option value="22%">22%</option>
                      </select>
                    </div>
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