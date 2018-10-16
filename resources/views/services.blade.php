@extends('master')

@section('content')
    <h1>Services</h1>  

    <!-- MAIN DATA -->

    <table id="table_id" class="display">
        <thead>
            <tr>
                <th>Service Name</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($services as $key => $service)
            <tr>
                <td>{{$service["name"]}}</td>
                <td class="sbutton" >
                    <label class="switch">
                        <input class="sinput" type="checkbox" value1={{$service["name"]}} value2={{$service["status"]}} value={{$service["status"]}} {{$service["status"]?"checked":""}}>
                        <span class="slider round"></span>
                    </label>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        $('.sbutton .switch .sinput').click(function(){
            var service = $(this).attr('value1');
            var status = $(this).val();
            $(this).val(status=="1"?"0":"1");
            var url = '/services/'+service+"/"+(status=="1"?"0":"1");

            $.ajax({
                method: 'get',
                url: url,
                success: function(res){
                    alert("SUCCESS "+res);
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

@endsection