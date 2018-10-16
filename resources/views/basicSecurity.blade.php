@extends('master')

@section('content')
    <h1>Basic Security</h1>  
        <div class="content">
            <table id="table_id" class="display">
                <thead>
                    <tr>
                        <th>Mode Name</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($modes as $key => $mode)
                    <tr>
                        <td>{{$mode["name"]}} <span><a href="#" data-toggle="tooltip" title="{{$mode['info']}}"><i class="fa fa-info"></i></a></span></td>
                        <td class="sbutton">
                            <label class="switch">
                                <input class="sinput" type="checkbox" value1={{$mode["code"]}} value2={{$mode["status"]}} value={{$mode["status"]}} {{$mode["status"]=="1"?"checked":""}}>
                                <span class="slider round"></span>
                            </label>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <br><br>
            <h3>IP Outside Manager</h3><br>
            <div class="tab">
                <button class="tablinks" onclick="getFile(event,0)">Deny</button>
                <button class="tablinks" onclick="getFile(event,1)">Allow</button>
            </div>
    
                <div id="0" class="tabcontent">
                    <form method='post' action="/files/edit" id="fileEditor">
                        <input type="hidden" name="file" value="0">
                        <textarea class="texteditor" name='content' placeholder="Deny">Loading</textarea>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
                <div id="1" class="tabcontent">
                    <form method='post' action="/files/edit" id="fileEditor">
                        <input type="hidden" name="file" value="1">
                        <textarea class="texteditor" name='content' placeholder="Allow">Loading</textarea>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
        </div>

    <script>
        function getFile(evt,fileName){
            $('.btn-primary').prop('disabled',true);
            $('.fileName').val(fileName==="f1"?"1":"2");
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

    <script>
        $('.sbutton .switch .sinput').click(function(){
            var service = $(this).attr('value1');
            var status = $(this).val();
            $(this).val(status=="1"?"0":"1");
            var url = '/security/basic/'+service+"/"+(status=="1"?"0":"1");
            
            console.log(url);
            $.ajax({
                method: 'get',
                url: url,
                success: function(res){
                    alert("SUCCESS");
                },
                error: function(res){
                    console.log(res);
                }
            });
        });
    </script>

    <!-- _________________________________________________ -->

    <!-- file for style and animations -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatable/datatable.css') }}">
    
    <script type="text/javascript" charset="utf8" src="{{ asset('js/datatable/datatable.js') }}"></script>

    <script>
        $(document).ready( function () {
            $('#table_id').DataTable();
        } );
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
@endsection