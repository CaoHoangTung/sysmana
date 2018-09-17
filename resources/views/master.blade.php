<head>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" id="bootstrap-css">
<link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
</head>
<!------ Include the above in your HEAD tag ---------->

<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

<div class="nav-side-menu">
    <div class="brand">SysCheck</div>
    <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
  
        <div class="menu-list">
  
            <ul id="menu-content" class="menu-content collapse out">
                <!-- <li>
                  <a href="#"><i class="fa fa-dashboard fa-lg fa-fw sidebar-icon"></i> Dashboard</a>
                </li>
                
                <li>
                  <a href="#"><i class="fa fa-calendar fa-lg fa-fw sidebar-icon"></i> Scheduler</a>
                </li>
                
                <li>
                  <a href="#"><i class="fa fa-bar-chart fa-lg fa-fw sidebar-icon"></i> Statistics</a>
                </li>
                
                <li  data-toggle="collapse" data-target="#manage" class="collapsed">
                    <a href="#"><i class="fa fa-puzzle-piece fa-lg fa-fw sidebar-icon"></i> Manage <span class="arrow"></span></a>
                </li>
                <ul class="sub-menu collapse" id="manage">
                    <li><a href="#"><i class="fa fa-angle-double-right"></i> Devices</a></li>
                    <li><a href="#"><i class="fa fa-angle-double-right"></i> Groups</a></li>
                    <li><a href="#"><i class="fa fa-angle-double-right"></i> SIM Cards</a></li>
                    <li><a href="#"><i class="fa fa-angle-double-right"></i> Users</a></li>
                </ul>
                
                <li  data-toggle="collapse" data-target="#settings" class="collapsed">
                    <a href="#"><i class="fa fa-sliders fa-lg fa-fw sidebar-icon"></i> Settings <span class="arrow"></span></a>
                </li>
                <ul class="sub-menu collapse" id="settings">
                    <li><a href="#"><i class="fa fa-angle-double-right"></i> General</a></li>
                    <li><a href="#"><i class="fa fa-angle-double-right"></i> Security</a></li>
                    <li><a href="#"><i class="fa fa-angle-double-right"></i> Notifications</a></li>
                </ul>
                
                <li  data-toggle="collapse" data-target="#maintenance" class="collapsed">
                    <a href="#"><i class="fa fa-cogs fa-lg fa-fw sidebar-icon"></i> Maintenance <span class="arrow"></span></a>
                </li>
                <ul class="sub-menu collapse" id="maintenance">
                    <li><a href="#"><i class="fa fa-angle-double-right"></i> Operation Logs</a></li>
                    <li><a href="#"><i class="fa fa-angle-double-right"></i> Events and Alarms</a></li>
                    <li><a href="#"><i class="fa fa-angle-double-right"></i> Backup and Restore</a></li>
                </ul> -->
                
                <li data-target="#tools">
                    <a href="/services"><i class="fa fa-wrench fa-lg fa-fw sidebar-icon"></i> Service Management</a>
                </li>
                
                <li data-target="#help" >
                    <a href="/files"><i class="fa fa-life-ring fa-lg fa-fw sidebar-icon"></i> File Management</a>
                </li>
                <!-- <ul class="sub-menu collapse" id="help">
                    <li><a href="#"><i class="fa fa-angle-double-right"></i> Documentation</a></li>
                    <li><a href="#"><i class="fa fa-angle-double-right"></i> Customer Support <small><i class="fa fa-external-link"></i></small></a></li>
                </ul> -->
            </ul>
     </div>
</div>

<div class="main">
    @yield('content')
</div>