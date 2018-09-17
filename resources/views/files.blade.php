@extends('master')

@section('content')
    <h1>Files</h1>  

    <!-- MAIN DATA -->

    <table id="table_id" class="display">
        <thead>
            <tr>
                <th>File name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($files as $key => $file)
            <tr>
                <td id="fileName">{{$file}}</td>
                <td>
                    <a href="/files/edit?f={{urlencode($file)}}">
                        <button type="button" class="btn btn-primary">Edit</button>
                    </a>
                    <a href="#">
                        <button type="button" class="btn btn-danger" id="change">Change</button>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    

    <!-- _________________________________________________ -->

    <!-- file for style and animations -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatable/datatable.css') }}">
    
    <script type="text/javascript" charset="utf8" src="{{ asset('js/datatable/datatable.js') }}"></script>

    <script>
        var fileName = $('#fileName').html();
        $('#change').click(function(){
            $('#fileName').html(''+
                '<form method="post" action="/change/url">'+
                    '@csrf'+
                    '<input value="'+fileName+'" name="f">'+
                    '<button type="submit" class="btn btn-primary">Confirm</button>'+
                    '<button type="button" class="btn btn-danger" id="cancel">Cancel</button>'+
                '<form>');
                $('#cancel').click(function(){
            $('#fileName').html(fileName);
        });
        });
        
    </script>

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