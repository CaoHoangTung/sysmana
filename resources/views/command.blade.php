@extends('master')

@section('content')
    <div style="width: 100%">
        <div class="form-group" style="width: 100%">
            <label for="cmd">Enter command:</label>
            <input type="text" style="width: 100%" class="form-control" id="cmd">
        </div>
        <button type="submit" class="btn btn-default" id="submitCmd">Submit</button>
        <br><br>

        <div class="form-group" style="width: 100%">
            <label for="output">Output</label>
            <textarea type="text" style="width: 100%; min-height: 400px" class="form-control" id="output" disabled>Hello</textarea>
        </div>
    </div>
    
    <script>
        function submitCmd(){
            let cmd = $('#cmd').val();
            $('#cmd').val('');
            $('#output').prepend("\n------- EXECUTING -------\n")
            $.ajax({
                url: '/command',
                method: 'post',
                data: {
                    cmd: cmd,
                },
                success: function(res){
                    $(this).text();
                    console.log(res);
                    
                    res.forEach(function(line){
                        $('#output').prepend(line+"\n");
                    });
                    if (res.length === 0){
                        $('#output').prepend("NULL"+"<br>");
                    }
                },
                error: function(res){
                    console.log(res);
                    alert("Error");
                }
            });
        }

        $('#submitCmd').click(function(){
            submitCmd();
        });

        $('#cmd').keyup(function(e){
            if (e.keyCode==13)
                submitCmd();
        });
    </script>
@endsection