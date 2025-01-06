<?php
include "connection1.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        h1 {
            margin-bottom: 20px;
        }

        label {
            display: block;
            text-align: left;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
    
</head>

<body>
    <div class="container">
        <h1>Login</h1>
        <form action="" name="forml" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password">
            <input type="submit" name="login" value="Login"><br>&nbsp;&nbsp;&nbsp;&nbsp;
           
            <div class="alert alert-danger" id="failure" style="margin-top:10px; display:none;">
                <strong>Does not match</strong> Invalid Username or Password.
            </div>
        </form>
    </div>
    <?php
    if (isset($_POST["login"])) {
        $count = 0;
        $res = mysqli_query($link, "select * from admin_user where username='$_POST[username]' && password='$_POST[password]'");
        $count = mysqli_num_rows($res);
        if ($count == 0) {
    ?>
            <script type="text/javascript">
                document.getElementById("failure").style.display = "block";
            </script>
        <?php
        } else {
        ?>
            <script type="text/javascript">
                window.location = "Students_Score.php";
            </script>
    <?php
        }
    }
    ?>
</body>

</html>