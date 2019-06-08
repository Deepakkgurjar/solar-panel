@extends('partials.main')
@section('content')
   
     <div class="content">
        <div class="container-fluid">
          <div class="row"style="justify-content: center;">
            
            <div class="col-md-8">
              <div class="card card-plain">
                <div class="card-header card-header-primary">
                  <h4 class="card-title mt-0"> Plant Profile</h4>
                  <p class="card-category"> Here is the showing Plant Details of a user </p>
                </div>

                <div class="card-body"style="margin-top: 5px; background-color: #bf46fd;border-radius: 10px;color:#ffff">
                  <h3>Plant capacity: <span>{{$plantProfile->plant_size}}</span> </h3>
                  <h4>Images</h4>
                  <div>
                    <p>Recent Order Images</p>
                    <img src="{{asset($plantImages->plant_before_img)}}" height="250px" width="250px"id="borderimg"/>
                    <img src="{{asset($plantImages->plant_after_img)}}" height="250px" width="250px"id="borderimg"/>
                   
                    <p>Plant Profile Images</p>
                    <img src="{{asset($plantImages->before_img)}}" height="250px" width="250px"id="borderimg"/>
                    <img src="{{asset($plantImages->after_img)}}" height="250px" width="250px"id="borderimg"/>
                  </div>

                  
                  <h4>No of Plants: <span>{{$plantProfile->no_of_plants}}</span> </h4>
                  <h4>Roof Type: <span>{{$plantProfile->roof_type}}</span> </h4>
                  <h4>Water Supply: <span>{{$plantProfile->water_supply}}</span> </h4>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
     
     
     
@endsection