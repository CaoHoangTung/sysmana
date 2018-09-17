@extends('master');

@section('content')
    <h1>Edit</h1><br>
    <form method='get' action='/files/edit'>
        @csrf
        <input class="fileurl" value={{$fileUrl}} id="file" name='f'>
        <button type="submit" class="btn btn-success">Browse</button>
    </form>
    <p style='color:red'>{{$msg}}</p>
    <form method='post' action="/files/edit?f={{urlencode($fileUrl)}}">
        @csrf
        <textarea class="texteditor" name='content'>{{$fileContent}}</textarea>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
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
@endsection