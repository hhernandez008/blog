<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Test Me!</title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script>
    	document.addEventListener("DOMContentLoaded", function()
    	{
    		$('body').on('click', '#register', function()
    		{
    			$.ajax(
				{
					method: 'POST',
					dataType: 'json',
					url: 'register_user.php',
					data:
					{
						email: $('#email').val(),
						display_name: $('#username').val(),
						password: $('#password').val()
					},
					success: function(result)
					{
						if (result.success)
							$('body').append($('<p>').text(result.data.display_name + " added."));
						else
							for (var i = 0; i < result.errors.length; i++)
								$('body').append($('<p>').text(result.errors[i]));
					},
					error: function(result)
					{
						$('body').append(result);
					}
				});
    		});

    		$('body').on('click', '#login', function()
    		{
    			$.ajax(
				{
					method: 'POST',
					dataType: 'json',
					url: 'login_user.php',
					data:
					{
						email: $('#l_email').val(),
						password: $('#l_password').val()
					},
					success: function(result)
					{
						if (result.success)
							$('body').append($('<p>').text(result.data.username + " logged in."));
						else
							for (var i = 0; i < result.errors.length; i++)
								$('body').append($('<p>').text(result.errors[i]));
					},
					error: function(result)
					{
						$('body').append(result);
					}
				});
    		});
    	});
	</script>
</head>
<body>
    <p>LOGIN</p>
    Email: <input type="email" name="email" id="email" /><br />
    Username: <input type="text" name="display_name" id="username" /><br />
    Password: <input type="password" name="password" id="password" /><br />
    <button id="register">REGISTER</button>
    <br />

    <hr />
    <p>LOGIN</p>
    Email: <input type="email" name="email" id="l_email" /><br />
    Password: <input type="password" name="password" id="l_password" /><br />
    <button id="login">LOGIN</button>
</body>
</html>