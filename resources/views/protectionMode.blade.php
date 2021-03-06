@extends('master')

@section('content')
    <h1>Protection Mode</h1>  
        <div class="content">
            <div class="form-group" style="width: 80%">
                <label for="cmd">Get Facebook ID:</label>
                <input type="text" style="width: 100%" class="form-control" id="fbUrl" placeholder="https://facebook.com/proxyht" required>
            </div>

            <button type="submit" class="btn btn-default" id="submitFBUrl">Submit</button>
            <span id="responseFBMsg"></span><br><br>

            <p>Pac Bot <span><a href="#" data-toggle="tooltip" title="Protect you from malwares, trojans, downloads from internet"><i class="fa fa-info"></i></a></span></p>
            <label class="switch" style="margin-bottom: 30px">
                <input type="checkbox" class="switcher" id="pacbot" @if($pacbot) checked @endif>
                <span class="slider round"></span>
            </label>

            <p>Squid Service <span><a href="#" data-toggle="tooltip" title="Protect you from malwares, trojans, downloads from internet"><i class="fa fa-info"></i></a></span></p>
            <label class="switch" style="margin-bottom: 30px">
                <input type="checkbox" class="switcher" id="squid_service" @if($squid) checked @endif>
                <span class="slider round"></span>
            </label>

            <p>ClamAV Service <span><a href="#" data-toggle="tooltip" title="Protect you from malwares, trojans, downloads from internet"><i class="fa fa-info"></i></a></span></p>
            <label class="switch" style="margin-bottom: 30px">
                <input type="checkbox" class="switcher" id="clam_av" @if($clamAV) checked @endif>
                <span class="slider round"></span>
            </label>

            <p>HTTP Access Deny Blockfiles <span><a href="#" data-toggle="tooltip" title="Protect you from malwares, trojans, downloads from internet"><i class="fa fa-info"></i></a></span></p>
            <label class="switch" style="margin-bottom: 30px">
                <input type="checkbox" class="switcher" id="http_access" @if($http_access) checked @endif>
                <span class="slider round"></span>
            </label>          

            <div class="tab">
                <button class="tablinks" onclick="getFile(event,2)">File Filter</button>
                <button class="tablinks" onclick="getFile(event,3)">Block Web (by keyword)</button>
            </div>
    
                <div id="2" class="tabcontent">
                    <form method='post' action="/files/edit" id="fileEditor">
                        <input type="hidden" name="file" value="2">
                        <textarea class="texteditor" name='content' placeholder="">Loading</textarea>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
                <div id="3" class="tabcontent">
                    <form method='post' action="/files/edit" id="fileEditor">
                        <input type="hidden" name="file" value="3">
                        <textarea class="texteditor" name='content' placeholder="">Loading</textarea>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
        </div>

    <script>
        function getFile(evt,fileName){
            $('.btn-primary').prop('disabled',true);
            $('.fileName').val(fileName);
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(fileName).style.display = "block";
            evt.currentTarget.className += " active";

            $.ajax({
                url: "/files/view",
                method: 'get',
                data: {
                    file: fileName,
                },  
                success: function(res){
                    $('#'+fileName+' textarea').text(res);
                    $('.btn-primary').prop('disabled',false);
                    console.log(res);
                },
                error: function(res){
                    alert("Server Error");
                    console.log(res);
                }
            });
        }
    </script>

    <style>
    /* Style the tab */
    .tab {
        overflow: hidden;
        border: 1px solid #ccc;
        background-color: #f1f1f1;
    }

    /* Style the buttons inside the tab */
    .tab button {
        background-color: inherit;
        float: left;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 14px 16px;
        transition: 0.3s;
        font-size: 17px;
    }

    /* Change background color of buttons on hover */
    .tab button:hover {
        background-color: #ddd;
    }

    /* Create an active/current tablink class */
    .tab button.active {
        background-color: #ccc;
    }

    /* Style the tab content */
    .tabcontent {
        display: none;
        padding: 6px 12px;
        border: 1px solid #ccc;
        border-top: none;
    }
    </style>

    <style>
        .texteditor{
            width: 100%;
            min-height: 500px;
            margin: 10px 0 10px 0;
            white-space: nowrap;
        }
        .fileurl{
            height: 33px;
            margin-right: 5px;
        }
    </style>

    <style>
        .content{
            background: white;
            width: 80vw;
            padding: 30px;
            margin-top: 20px;
        }

        @media(max-width: 767px){
            .content{
                width: 95vw;
            }
        }
    </style>

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

    <!-- _________________________________________________ -->

    <script>
        $('.switcher').on('click',function(){
            let msg = new MessageBox('Loading',"good");
            msg.show();
            $.ajax({
                url: '/security/basic/'+this.id+'/'+(this.checked?"1":"0"),
                method: 'get',
                success: function(res){
                    msg = new MessageBox('Success','good');
                    msg.show();
                    console.log(res);
                },
                error: function(res){
                    msg = new MessageBox('Error occured','bad');
                    msg.show();
                    console.log(res);
                }
            })
        });

        function submitFBUrl(){
            $('#responseFBMsg').text("Processing");
            let url = $('#fbUrl').val();
            $.ajax({
                url: '/security/protection/getfbid',
                method: 'post',
                data: {
                    url: url,
                },
                success: function(res){
                    console.log(res);
                    $('#responseFBMsg').html("ID: "+"<b>"+res+"</b>");
                },
                error: function(res){
                    $('#responseFBMsg').html("Internal error");
                    console.log(res);
                }
            })
        }

        $('#submitFBUrl').on('click',function(){
            submitFBUrl();
        });

        $('#fbUrl').keyup(function(e){
            if (e.keyCode==13)
                submitFBUrl();
        });
    </script>


@endsection