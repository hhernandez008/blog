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
					url: 'http://edenprime.cloudapp.net/blog/register_user.php',
					data:
					{
						email: $('#email').val(),
						display_name: $('#username').val(),
						password: $('#password').val()
					},
					success: function(result)
					{
						$('#feedback').html('');
						if (result.success)
							$('#feedback').append($('<p>').text(result.data.display_name + " added."));
						else
							for (var i = 0; i < result.errors.length; i++)
								$('#feedback').append($('<p>').text(result.errors[i]));
					},
					error: function(result)
					{
						$('#feedback').html('');
						$('#feedback').append(result);
					}
				});
    		});

    		$('body').on('click', '#login', function()
    		{
    			$.ajax(
				{
					method: 'POST',
					dataType: 'json',
					url: 'http://edenprime.cloudapp.net/blog/login_user.php',
					data:
					{
						email: $('#l_email').val(),
						password: $('#l_password').val()
					},
					success: function(result)
					{
						$('#feedback').html('');
						if (result.success)
							$('#feedback').append($('<p>').text(result.data.username + " logged in."));
						else
							for (var i = 0; i < result.errors.length; i++)
								$('#feedback').append($('<p>').text(result.errors[i]));
					},
					error: function(result)
					{
						$('#feedback').html('');
						$('#feedback').append(result);
					}
				});
    		});

    		$('body').on('click', '#read', function()
    		{
    			$.ajax(
				{
					method: 'POST',
					dataType: 'json',
					url: 'read_one_blog.php',//'http://edenprime.cloudapp.net/blog/read_one_blog.php',
					data:
					{
						id: $('#blog_id').val(),
						auth_token: $('#auth_token').val()
					},
					success: function(result)
					{
						$('#feedback').html(" ");

						if (result.success)
						{
							for (var i = 0; i < result.errors.length; i++)
								$('#feedback').append($('<p>').text(result.errors[i]));

							$('#feedback').append($('<h1>').text(result.data.title));
							$('#feedback').append($('<h2>').text('written by ' + result.data.uid));
							$('#feedback').append($('<h3>').text('This blog is' + (result.data.public ? ' ' : ' NOT ') + 'public.'));
							$('#feedback').append($('<p>').text(result.data.text));
							$('#feedback').append($('<p>').text('Tags: '));
							for (var i = 0; i < result.data.tags.length; i++)
								$('#feedback').append($('<span>').text(result.data.tags[i] + ','));
						}
						else
							for (var i = 0; i < result.errors.length; i++)
								$('#feedback').append($('<p>').text(result.errors[i]));
					},
					error: function(result)
					{
						$('#feedback').html('');
						$('#feedback').append(result);
					}
				});
    		});

    		$('body').on('click', '#list', function()
    		{
    			$.ajax(
				{
					method: 'POST',
					dataType: 'json',
					url: 'list_blogs.php', //'http://edenprime.cloudapp.net/blog/read_one_blog.php',
					data:
					{
						tag: $('#tag').val(),
						count: $('#count').val(),
						auth_token: $('#list_auth_token').val()
					},
					success: function(result)
					{
						$('#feedback').html(" ");

						if (result.success)
						{
							for (var i = 0; i < result.errors.length; i++)
								$('#feedback').append($('<p>').text(result.errors[i]));

							for (var i = 0; i < result.data.length; i++)
							{
								$('#feedback').append($('<h1>').text(result.data[i].title));
								$('#feedback').append($('<h2>').text('written by ' + result.data[i].uid));
								$('#feedback').append($('<h3>').text('This blog is' + (result.data[i].public ? ' ' : ' NOT ') + 'public.'));
								$('#feedback').append($('<p>').text(result.data[i].summary));
								$('#feedback').append($('<p>').text('Tags: '));
								for (var j = 0; j < result.data[i].tags.length; j++)
									$('#feedback').append($('<span>').text(result.data[i].tags[j] + ','));
							}
						}
						else
							for (var i = 0; i < result.errors.length; i++)
								$('#feedback').append($('<p>').text(result.errors[i]));
					},
					error: function(result)
					{
						$('#feedback').html('');
						$('#feedback').append(result);
					}
				});
    		});
    	});
    </script>
</head>
<body>
    <p>REGISTER</p>
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

    <hr />
    <p>READ A BLOG</p>
    Blog id: <input type="number" name="id" id="blog_id" /><br />
    Auth Token: <input type="password" name="auth_token" id="auth_token" /><br />
    <button id="read">READ BLOG</button>

    <hr />
    <p>LIST BLOGS</p>
    Tag: <input type="text" name="tag" id="tag" /><br />
    Count: <input type="number" name="count" id="count" /><br />
    Auth Token: <input type="password" name="auth_token" id="list_auth_token" /><br />
    <button id="list">LIST BLOGS</button>

    <hr />
    <div id="feedback">

    </div>
</body>
</html>