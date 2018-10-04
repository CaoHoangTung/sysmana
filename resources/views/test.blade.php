@extends('master')

@section('content')
  <link rel="stylesheet" type="text/css" href="/css/cmd.min.css">
  <style type="text/css">
    body {
      background-color: #444;
    }
    #cmd1, #cmd2 {
      width:  100%;
      height: 90vh;
      margin: 10px;
    }
  </style>

  <!-- <div id="cmd1"></div> -->
  <div id="cmd2"></div>

  <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
  <script type="text/javascript" src="/js/cmd.min.js"></script>
  <script type="text/javascript">
    // var interface1 = new Cmd({
    //   selector: '#cmd1',
    //   dark_css: 'cmd_dark.min.css',
    //   light_css: 'cmd_light.min.css',
    //   history_id: 'interface1'
    // });
    var interface2 = new Cmd({
      selector: '#cmd2',
      dark_css: 'dist/cmd_dark.min.css',
      light_css: 'dist/cmd_light.min.css',
      history_id: 'interface2',
      tabcomplete_url: 'tabcomplete.json',
      remote_cmd_list_url: 'commands.json',
      external_processor: function(input, cmd)  {
        
        if (input) {
          setTimeout(function() {
            $.ajax({
              url: '/security/cmd',
              method: 'post',
              data: {
                cmd: input,
              },
              success: function(res){
                cmd.handleResponse({
                  cmd_out:res==""?"Invalid command":res
                });
                console.log(res);
              },
              error: function(res){
                cmd.handleResponse({
                  cmd_out: "SERVER ERROR: "
                }); 
                console.log(res);
              }
            })
          }, 1000);
          return true;
        }
      }
    });
    // Customise the prompt string (PS1)
    interface1.setPrompt('? ');
    // Run an arbitrary command string
    $('button').on('click', function () {
      interface1.handleInput('invert');
    });
  </script>
@endsection