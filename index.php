<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION['UserData']['Username'])) {
    header("location: login.php");
    exit;
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://media.twiliocdn.com/sdk/js/client/v1.6/twilio.min.js"></script>
    <style type="text/css">
        body {
            font: 14px sans-serif;
            text-align: center;
        }

        .call-wrapper {
            padding: 40px;
        }

        .tab-content {
            margin-top: 20px;
        }

        .msg-wrapper {
            padding: 40px;
        }
    </style>
</head>

<body>
    <div class="row page-header">
        <h1>Hi, <b><?php echo $_SESSION['UserData']['Username']; ?></b>. Welcome to our site.</h1>
        <p>
            <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
        </p>
    </div>
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#home">Phonecall</a></li>
        <li><a data-toggle="tab" href="#menu1">Message</a></li>
        <li><a data-toggle="tab" href="#menu2">History</a></li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane fade in active" id="home">
            <h3>Twilio Calling</h3>
            <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            <div class="call-wrapper">
                <div class="row">
                    <div class="col-md-5 order-md-2 mb-4">
                        <!-- <form action="phonecall.php" method="post"> -->
                        <div class="form-inline">
                            <input class="form-control input-lg" type="text" name='number'>
                            <!-- <input class="btn btn-primary" type="submit" value="Call"> -->
                            <button class="btn btn-primary btn-lg call-customer-button">
                                <span class="glyphicon glyphicon-earphone"></span> Call
                            </button>
                        </div>
                        <!-- </form> -->
                    </div>
                    <div class="col-md-5 order-md-2 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group row">
                                    <!-- <label for="call-status" class="col-3 col-form-label">Status</label> -->
                                    <div class="col-9">
                                        <input id="call-status" class="form-control" type="text" placeholder="Connecting to Twilio..." readonly>
                                    </div>
                                </div>
                                <button class="btn btn-lg btn-success answer-button" disabled>Answer call</button>
                                <button class="btn btn-lg btn-danger hangup-button" disabled onclick="hangUp()">Hang up</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div id="menu1" class="tab-pane fade">
            <h3>Twilio messaging</h3>
            <div class="msg-wrapper">
                <form action="" method="post">
                    <div class="form-group">
                        <input type="text" id="sms_number" class="form-control" placeholder="Enter phone number">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" id="message" cols="40" rows="6"></textarea>
                    </div>
                    <input type="button" class="btn btn-lg btn-primary" value="Submit" id="send_message">
                </form>
            </div>
        </div>
        <div id="menu2" class="tab-pane fade">
            <h3>History(Calling & Messaging)</h3>
            <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
        </div>
    </div>
    
</body>

</html>
<script type="text/javascript" src="quickstart.js"></script>
<script type="text/javascript">
    $('#send_message').click(function() {
        $.ajax({
            type: "POST",
            url: "sendtext.php",
            data: {
                number: $('#sms_number').val(),
                message: $('#message').val(),
            },
            success: function() {
                $('.toast').toast("show");
            }
        });
    });
</script>