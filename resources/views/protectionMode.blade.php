@extends('master')

@section('content')
    <h1>Protection Mode</h1>  
        <div class="content">
            
            <h3>Command Prompt</h3><br>
            <form>
                <label for="Command">Command</label><br>
                <input type="text" name="cmd">
            </form>
            <form method='post' action="/files/edit?f=">
                @csrf
                <label for="Output">Output</label><br>
                <textarea class="texteditor" name='content'></textarea>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>

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

        input,textarea{
            color: white;
            background: black;
            padding: 10px;
            width: 100%;
        }

        @media(max-width: 767px){
            .content{
                width: 95vw;
            }
        }
    </style>
@endsection