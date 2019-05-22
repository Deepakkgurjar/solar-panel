
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="{{asset('assets/loginRegister/img/login.png')}}" type="image/png">
  <title>Login</title>

  <!-- Custom fonts for this template-->
  <link href="{{asset('assets/loginRegister/css/all.css')}}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{asset('assets/loginRegister/css/sb-admin-2.min.css')}}" rel="stylesheet">
  <style type="text/css">
    .header{
      margin: 50px;
    }
  </style>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

<body class="bg-gradient-primary">

  <div class="container">
    <div class="header">
                
              </div>
    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-6 col-lg-6 col-md-6">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row" >
              <div class="col-lg-12">
                <div class="p-5">
                  <div class="text-center">
                    <h2 align="center" style="color:blue; font-family: Times New Roman;">Login</h2>
                  </div>
                 
                  
                  <form class="user" action="{{route('adminlogin')}}" method="post">
                    {{csrf_field()}}
                    <div class="form-group">
                      <input type="email" class="form-control form-control-user" id="email" name="email" placeholder="Enter Email Address..." style="font-weight: bold;">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password" style="font-weight: bold;">
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary btn-user btn-block">Login</button>
                    <p align="center">Click Here if you forgot your password<a href="{{route('forgot-password')}}">Forget Password</a></p>
                   
                  </form>
      
                </div>
              </div>
            
          </div>
        </div>

      </div>

    </div>

  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  <script>
  @if($errors->any())
    toastr.error("{{ $errors->first() }}");
  @endif
  @if(Session::has('message'))
      toastr.success("{{ Session::get('message') }}");
  @endif
  
  @if(Session::has('error'))
      toastr.error("{{ Session::get('error') }}");
  @endif

</script>

</body>

</html>
