<html>
    <head>
        <title>ZeroMQ Chat</title>
        <style>
            body {
                padding: 5px;
                background-color: #E5E5E5;
                font-family: Verdana, Arial, Sans-Serif;
                color: #555;
            }

			#chat {
				display: none;
			}
			#chatwindow {
				width: 800px;
				height: 350px;
				overflow: scroll;
				margin: 5px auto;
				background: black;
				color: #02FF02;
				border: 1px solid black;
			}
			
			#chatwindow p {
			    margin: 0px 5px;
			}
			
			#chatform {
				width: 800px;
				margin: 0px auto;
			}
			
			#chatbox {
				width: 736px;
			}
			
			#datasrc {
			    display: none;
			}
			
			
        </style>
        <script lang="text/javascript" src="jquery-1.2.6.pack.js"></script>
        <script lang="text/javascript">
        function updateChat(response) {
			$('#chatwindow').append('<p>' + response + '</p>');
			$("#chatwindow").attr({ scrollTop: $("#chatwindow").attr("scrollHeight") });
		}
		
		$(document).ready(function(){
			myname = '';
			
			$("#nameform").submit(function(e) {
				myname = $('#namebox').val();
				$('#nameform').css('display', 'none');
				$('#chat').css('display', 'block');
				e.stopPropagation();
				e.preventDefault();
				$('body').append( '<iframe id="datasrc" src="chat.php?name=' + myname + '"></iframe>');
				$.post('/chat/send.php', {'name': myname, 'message': 'm:joined'});
			});
			$('#chatform').submit(function(e) {
				$.post('/chat/send.php', {'name': myname, 'message': $('#chatbox').val()});
				e.stopPropagation();
				e.preventDefault();
				$('#chatbox').val('');
			});
		});	
        </script>
    </head>
    <body>
        <form id="nameform">
            <label>Enter Your Name: <input id="namebox" name="namebox" type="textarea" maxlength="30" value="" /></label>
            <input type="submit" value="Join" />
        </form>
		<div id="chat">
			<div id="chatwindow">
			</div>
			<form id="chatform">
	            <input id="chatbox" name="chatbox" type="textarea" value="" /> 
				<input type="submit" value="Send" />
	        </form>
		</div>
    </body>
</html>