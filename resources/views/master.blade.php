<head>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" id="bootstrap-css">
<link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
</head>
<!------ Include the above in your HEAD tag ---------->

<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

<div class="nav-side-menu">
    <a href="/"><div class="brand">CTOS</div></a>
    <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
  
        <div class="menu-list">
  
            <ul id="menu-content" class="menu-content collapse out">
                
                <li  data-toggle="collapse" data-target="#maintenance" class="collapsed">
                    <a href="#"><i class="fa fa-life-ring fa-lg fa-fw sidebar-icon"></i> Security <span class="arrow"></span></a>
                </li>
                <ul class="sub-menu collapse" id="maintenance">
                    <li><a href="/security/basic"><i class="fa fa-angle-double-right"></i> Basic Security</a></li>
                    <li><a href="/security/protection"><i class="fa fa-angle-double-right"></i> Protection's Service</a></li>
                </ul> 
                
                <li data-target="#tools">
                    <a href="/services"><i class="fa fa-wrench fa-lg fa-fw sidebar-icon"></i> Service Management</a>
                </li>
                
                <li data-target="#help" >
                    <a href="/settings"><i class="fa fa-cogs fa-lg fa-fw sidebar-icon"></i> Settings</a>
                </li>
                
            </ul>
     </div>
</div>

<div class="main">
    @yield('content')
</div>