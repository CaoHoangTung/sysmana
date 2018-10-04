@extends('master')

@section('content')
<h1>MANAGE YOUR SYSTEM</h1>

<div id="content"></div>

<style>
    #report{
        width: 90vw;
        display: inline-block;
        min-height: 1500px;
    }
    @media(max-width: 958px){
        #report{
            width: 100%;
        }
    }
</style>

<script type="text/javascript">
    $(document).ready(function(){
        document.getElementById("content").innerHTML='<object id="report" style="width: 95%" type="text/html" data="/linfo" ></object>';
    });
</script>  
@endsection