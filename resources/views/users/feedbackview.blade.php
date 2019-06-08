@extends('partials.main')
@section('content')
   
     <div class="content">
        <div class="container-fluid">
          <div class="row" style="justify-content: center;">
            <div class="col-md-5">
              <div class="card card-profile">
                <div class="card-avatar">
                  <img class="img" src="{{asset($feedback->userData->profile_img)}}">
                </div>
                <div class="card-body">
                  <h6 class="card-category text-gray">{{$feedback->userData->full_name}}</h6>
                  <h6 class="card-title">Address: {{$feedback->userData->address}}</h6>
                  <p class="card-description">
                    To order no : {{$feedback->orderData->order_no}}<br>
                    @if(!empty($feedback->satisfied) && $feedback->satisfied== 1)

                      How Satisfied :<img src="{{asset('assets/img/great.png')}}"> Great<br>

                    @elseif(!empty($feedback->satisfied) && $feedback->satisfied== 2)

                      How Satisfied :<img src="{{asset('assets/img/good.png')}}"> Good<br>

                    @elseif(!empty($feedback->satisfied) && $feedback->satisfied== 3)

                      How Satisfied :<img src="{{asset('assets/img/ok.png')}}"> Okay<br>

                    @elseif(!empty($feedback->satisfied) && $feedback->satisfied== 4)

                      How Satisfied :<img src="{{asset('assets/img/bad.png')}}"> Bad<br>

                    @elseif(!empty($feedback->satisfied) && $feedback->satisfied== 5)

                      How Satisfied :<img src="{{asset('assets/img/tarrible.png')}}"> Terrible<br>

                    @endif
                    
                    How Like : {{$feedback->how_like}}<br>
                    Message : {{$feedback->message}}
                  </p>
                 
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      
@endsection