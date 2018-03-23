<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$username = $password = "";
#$username_err = $password_err = "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{   font: 14px sans-serif;
                background-image: url("static/background.jpg");
                
                    background-size: 1500px 850px;



         }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>

    <div class="wrapper">
        <h2>Login</h2><br>
        <form action="<?php echo base_url();?>index.php/Login/process" method="POST">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" placeholder="Enter your username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php if (isset($username_err)) echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" placeholder="Enter your password" class="form-control">
                <span class="help-block"><?php if (isset($password_err)) echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary">
            </div>
            <p>Don't have an account? <a href="#">Sign up now</a>.</p>
        </form>
    </div>    
</body>
</html>