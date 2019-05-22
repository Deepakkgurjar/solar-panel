@extends('partials.main')
@section('content')
   
     <div class="content">
        <div class="container-fluid">
          <div class="row"style="justify-content: center;">
            <div class="col-md-6">
              <div class="card card-plain">
                <div class="card-header card-header-primary">
                  <h4 class="card-title mt-0">Edit Package</h4>
                  <p class="card-category"> Here you can update package details</p>
                </div>
                <div class="card-body">
                  <form action="" method="post">
                    {{csrf_field()}}
                    <input type="hidden" name="id" id="id" value="@if(!empty($packageDetail)) {{$packageDetail->id}} @endif">
                    <div class="form-group"> <!-- left unspecified, .bmd-form-group will be automatically added (inspect the code) -->
                      <label for="formGroupExampleInput" class="bmd-label-floating">Package Name</label>
                      <input type="text" class="form-control" id="packageName" name="packageName" value="@if(!empty($packageDetail)) {{$packageDetail->package_name}} @else -- @endif">
                    </div>
                    <div class="form-group"> <!-- manually specified --> 
                      <label for="formGroupExampleInput" class="bmd-label-floating">Package Type</label>
                      <input type="text" class="form-control" id="packageType" name="packageType" value="@if(!empty($packageDetail)) {{$packageDetail->package_type}} @else -- @endif">
                    </div>
                    <div class="form-group"> <!-- manually specified --> 
                      <label for="formGroupExampleInput" class="bmd-label-floating">Panel Capacity</label>
                      <input type="text" class="form-control" id="panelCapacity" name="panelCapacity" value="@if(!empty($packageDetail)) {{$packageDetail->panel_capacity}} @else -- @endif">
                    </div>
                    <div class="form-group"> <!-- manually specified --> 
                      <label for="formGroupExampleInput" class="bmd-label-floating">Prize</label>
                      <input type="text" class="form-control" id="prize" name="prize" value="@if(!empty($packageDetail)) {{$packageDetail->prize}} @else -- @endif">
                    </div>
                    <div>

                    <div class="form-group"> <!-- manually specified --> 
                      <label for="formGroupExampleInput" class="bmd-label-floating">GST</label>&nbsp;&nbsp;
                      <label>@if(!empty($packageDetail)) {{$packageDetail->gst}} @else <?php echo 'nill';?> @endif</label>
                      
                      <select class="form-control" id="gst" name="gst">
                        <option>18%</option>
                        <option>20%</option>
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