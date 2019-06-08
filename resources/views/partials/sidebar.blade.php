<div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">
            
            <ul class="navbar-nav">
              
              <li class="nav-item dropdown">
                <a class="nav-link" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="material-icons">notifications</i>
                  <span class="notification">5</span>
                  <p class="d-lg-none d-md-block">
                    Some Actions
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="#">Mike John responded to your email</a>
                  <a class="dropdown-item" href="#">You have 5 new tasks</a>
                  <a class="dropdown-item" href="#">You're now friend with Andrew</a>
                  <a class="dropdown-item" href="#">Another Notification</a>
                  <a class="dropdown-item" href="#">Another One</a>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link" href="#pablo" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  
                  {{Auth::user()->email}}&nbsp;
                  <i class="material-icons">person</i>
                  <p class="d-lg-none d-md-block">
                    Account
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                 
                 
                  <a class="dropdown-item" href="{{route('logout')}}">Log out</a>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <br><br><br>
<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="purple" data-background-color="white" data-image="../assets/img/sidebar-1.jpg">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
      <div class="logo">
        <a href="#" class="simple-text logo-normal">
          Solar Panel
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item active  ">
            <a class="nav-link" href="{{route('dashboard')}}">
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          </li>

          <li class="nav-item ">
            <a class="nav-link" data-toggle="collapse" href="#packageDropdown" aria-controls="collapseExample"><i class="material-icons">check_box_outline_blank</i>
              <p>Packages</p>
          </a>
          <div class="collapse" id="packageDropdown">
          <div class="card card-body" style="margin-bottom: 0px; margin-top: 0px;">
            <a class="nav-link" href="{{route('add-package')}}">
              <p>Add Packages</p>
            </a>
            <a class="nav-link" href="{{route('list-packages')}}">
              <p>Packages List</p>
            </a>
          </div>
          </div>
          </li>

          <li class="nav-item ">
            <a class="nav-link" data-toggle="collapse" href="#workerDropdown" aria-controls="collapseExample"><i class="material-icons">person</i>
              <p>Workers</p>
          </a>
          <div class="collapse" id="workerDropdown">
          <div class="card card-body" style="margin-bottom: 0px; margin-top: 0px;">
            <a class="nav-link" href="{{route('add-worker')}}">
              <p>Add Workers</p>
            </a>
            <a class="nav-link" href="{{route('list-workers')}}">
              <p>workers List</p>
            </a>
          </div>
          </div>
          </li>

          <li class="nav-item ">
            <a class="nav-link" href="{{route('user-list')}}">
              <i class="material-icons">person</i>
              <p>User Profile</p>
            </a>
          </li>

          <li class="nav-item ">
            <a class="nav-link" href="{{route('view-all-orders')}}">
              <i class="material-icons">shopping_cart</i>
              <p>All Orders</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="{{route('cleaning-history')}}">
              <i class="material-icons">rowing</i>
              <p>Cleaning History</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="{{route('payment-history')}}">
              <i class="material-icons">account_balance_wallet</i>
              <p>Payment History</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="{{route('show-time-sloats')}}">
              <i class="material-icons">alarm</i>
              <p>Time Slots</p>
            </a>
          </li>
        </ul>
      </div>
    </div>