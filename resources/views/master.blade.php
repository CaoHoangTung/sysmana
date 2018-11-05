<head>
<script src="/js/jquery-1.11.1.min.js"></script>
<script src="/js/bootstrap.min.js"></script>

<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" id="bootstrap-css">
<link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
</head>
<!------ Include the above in your HEAD tag ---------->

<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

<div class="nav-side-menu">
    <a href="/">
        <div class="brand"><img src="/img/logo.png" width="60px" height="60px">CTOS</div>
    </a>
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

                <li  data-toggle="collapse" data-target="#localmanager" class="collapsed">
                    <a href="#"><i class="fa fa-user fa-lg fa-fw sidebar-icon"></i> Local Manager <span class="arrow"></span></a>
                </li>
                <ul class="sub-menu collapse" id="localmanager">
                    <li><a href="#"><i class="fa fa-angle-double-right"></i> Parent Control</a></li>
                    <li><a href="#"><i class="fa fa-angle-double-right"></i> Local Settings</a></li>
                </ul> 

                <li data-target="#tools">
                    <a href="/command"><i class="fa fa-terminal fa-lg fa-fw sidebar-icon"></i> Command Execute</a>
                </li>

                <li data-target="#tools">
                    <a href="/services"><i class="fa fa-wrench fa-lg fa-fw sidebar-icon"></i> Service Management</a>
                </li>
                
                <li data-target="#help" >
                    <a href="/settings"><i class="fa fa-cogs fa-lg fa-fw sidebar-icon"></i> Settings</a>
                </li>
                <div style="text-align:center; margin-top: 10px">
                    <label class="switch">
                        <input type="checkbox" id="hackerMode">
                        <span class="slider"></span>
                    </label>
                </div>
            </ul>
     </div>
</div>

<div class="main">
    @yield('content')
</div>
<script src="/js/MessageBox.js">
        
    </script>

<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();

});

$('#hackerMode').on('click',function(){
    var checked = this.checked;

    $.ajax({
        url: '/smode/'+(checked?"1":"0"),
        method: 'post',
        success: function(res){
            console.log("Special mode "+res);
        },
        error: function(res){
            console.log(res);
        }
    });

    if (checked){
        $('body').css('color','green');
        $('body').css('background','black');
    }
    else{
        $('body').css('color','#000');
        $('body').css('background','#ebedef');
    }
});
</script>

<style>
.switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
        }

        .switch input {display:none;}

        .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
        }

        .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
        }

        input:checked + .slider {
        background-color: #2196F3;
        }

        input:focus + .slider {
        box-shadow: 0 0 1px #2196F3;
        }

        input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
        border-radius: 34px;
        }

        .slider.round:before {
        border-radius: 50%;
        }
</style>