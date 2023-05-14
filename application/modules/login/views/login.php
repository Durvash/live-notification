<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        * {
            box-sizing: border-box;
        }

        input[type=text],
        input[type=password],
        select,
        textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-top: 6px;
            margin-bottom: 16px;
            resize: vertical;
        }

        input[type=submit] {
            background-color: #04AA6D;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type=submit]:hover {
            background-color: #45a049;
        }

        .container {
            border-radius: 5px;
            background-color: #f2f2f2;
            padding: 20px;
            position: fixed;
            top: 50%;
            left: 50%;
            /* bring your own prefixes */
            transform: translate(-50%, -50%);
        }

        .info {
            padding: 5px 10px;
            font-size: smaller;
            color: crimson;
            line-height: 5px;
            background-color: bisque;
            margin: 20px 0px;
        }
    </style>
    <title>Login</title>
</head>

<body>
    <div class="container">
        <div class="info">
            <p>Username : manager / admin</p>
            <p>Password : 123456</p>
        </div>

        <form id="loginForm">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Username">

            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Password">

            <input type="submit" value="Submit">
        </form>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#loginForm').submit(function(event) {
            event.preventDefault();
            let username = $('#username').val();
            let password = $('#password').val();

            let formData = {
                username: username,
                password: password
            };

            $.ajax({
                url: '<?php echo base_url("/authenticate") ?>',
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        window.location.href = '<?php echo base_url("/home") ?>';
                    } else {
                        alert('Invalid credentials. Please try again.');
                    }
                },
                error: function() {
                    alert('An error occurred. Please try again later.');
                }
            });
        });
    });
</script>


</html>