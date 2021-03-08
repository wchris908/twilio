<?php session_start(); /* Starts the session */
/* Check Login form submitted */
if (isset($_POST['Submit'])) {
    /* Define username and associated password array */
    $logins = array('Chris' => '123456');

    /* Check and assign submitted Username and Password to new variable */
    $Username = isset($_POST['Username']) ? $_POST['Username'] : '';
    $Password = isset($_POST['Password']) ? $_POST['Password'] : '';

    /* Check Username and Password existence in defined array */
    if (isset($logins[$Username]) && $logins[$Username] == $Password) {
        /* Success: Set session variables and redirect to Protected page  */
        $_SESSION['UserData']['Username'] = 'Chris';
        $_SESSION['UserData']['Password'] = $logins[$Username];
        header("location:index.php");
        exit;
    } else {
        /*Unsuccessful attempt: Set error message */
        $msg = "<span style='color:red'>Invalid Login Details</span>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body {
            font: 14px sans-serif;
        }

        .wrapper {
            /* width: 350px; */
            padding: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="wrapper col-sm-4">
                <h2 style="text-align: center;">Login</h2>
                <p>Please fill in your credentials to login.</p>
                <?php if (isset($msg)) { ?>
                    <p><?php echo $msg; ?></p>
                <?php } ?>
                <form action="" method="post">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="Username" class="form-control" value="">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="Password" class="form-control">
                    </div>
                    <div class="form-group">
                        <input name="Submit" type="submit" class="btn btn-primary" value="Login">
                    </div>
                    <!-- <p>Don't have an account? <a href="register.php">Sign up now</a>.</p> -->
                    <p>Username: 'Chris' Password: '123456'</p>
                </form>
            </div>
            <div class="col-sm-4"></div>
        </div>
    </div>
</body>

</html>