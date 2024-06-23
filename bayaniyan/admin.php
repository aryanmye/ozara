


<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include('smtp/PHPMailerAutoload.php');

function smtp_mailer($to, $subject, $message) {
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587;
    $mail->IsHTML(true);
    $mail->CharSet = 'UTF-8';
    $mail->Username = "jadhavaryan467@gmail.com";
    $mail->Password = "oozzyqfwnpufjuqi";
    $mail->SetFrom("jadhavaryan467@gmail.com");
    $mail->Subject = $subject;
    $mail->Body = $message;
    $mail->AddAddress($to);
    $mail->SMTPOptions = array('ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => false
    ));
    if (!$mail->Send()) {
        return $mail->ErrorInfo;
    } else {
        return 'Sent';
    }
} 
?>


<?php
session_start();
include 'connect.php';
function generateTrackingId() {
    return uniqid('sender_', true);
}
// Check if user is logged in and if the username matches "ozaraadmin"
if (!isset($_SESSION['user_data']) || $_SESSION['user_data']['username'] !== 'ozaraadmin') {
    header("Location: login.html"); // Redirect to login page
    exit(); // Ensure that no further code is executed
}
// Initialize the tracking ID
$trackingId = generateTrackingId();
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    if (isset($_POST["form-type"]) && $_POST["form-type"] == "sender") {
    $sname=$_POST["sender-name"];
    $smail=$_POST["sender-email"];
    $status=$_POST["sender-status"];
    $dispatch=$_POST["dispatched-date"];
    $track_id=$_POST["track_id"];
    $sql= "INSERT INTO `sender` (`name`, `email`, `status`, `dispatch`, `track_id`) VALUES ('$sname', '$smail', '$status', '$dispatch', '$track_id')";
    $result=mysqli_query($coni,$sql);
    if($result)
    {
            $subject="Your SENDER Tracking ID";
            $msg="Hey sender , your tracking ID is $trackingId";
            $message = "
            <html>
            <head>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        margin: 0;
                        padding: 0;
                        background-color: #f4f4f4;
                    }
                    .container {
                        padding: 20px;
                        background-color: #ffffff;
                        border: 1px solid #dddddd;
                        margin: 10px auto;
                        width: 80%;
                        max-width: 600px;
                        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
                    }
                    .header {
                        background-color: #4CAF50;
                        color: white;
                        padding: 10px 0;
                        text-align: center;
                    }
                    .content {
                        padding: 20px;
                    }
                    .content p {
                        line-height: 1.6;
                    }
                    .footer {
                        text-align: center;
                        padding: 10px;
                        background-color: #f4f4f4;
                        border-top: 1px solid #dddddd;
                    }
                </style>
            </head>
            <body>
                <div class='container'>
                    <div class='header'>
                        <h2>Sender ID</h2>
                    </div>
                    <div class='content'>
                        <p><strong>Name:</strong> $sname</p>
                        <p><strong>Subject:</strong> $subject</p>
                        <p><strong>Message:</strong> $msg</p>
                    </div>
                    <div class='footer'>
                         <p>This email was sent from Bayanihan Express Cargo.</p>
                    </div>
                </div>
            </body>
            </html>";
            $to = $smail;
            $result = smtp_mailer($to, $subject, $message);
        
            if ($result === 'Sent') {
                echo "<script>alert('Mail sent successfully!');</script>";
                header("Location:admin.php");
            } else {
                echo "<script>alert('Mail sending failed: " . $result . "');</script>";
            }
        }

    }
}

function rgenerateTrackingId() {
    return uniqid('receiver_', true);
}

// Initialize the tracking ID
$rtrackingId = rgenerateTrackingId();
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    if (isset($_POST["form-type"]) && $_POST["form-type"] == "receiver") {
    $rname=$_POST["receiver-name"];
    $rmail=$_POST["receiver-email"];
    $rstatus=$_POST["receiver-status"];
    $rdispatch=$_POST["rdispatched-date"];
    $restimate=$_POST["estimate-date"];
    $rtrack_id=$_POST["rtrack_id"];
    $sql= "INSERT INTO `receiver` (`name`, `email`, `status`, `dispatch_date`, `estimate_date`, `rtrack_id`) VALUES ('$rname', '$rmail', '$rstatus', '$rdispatch', '$restimate', '$rtrack_id')";
    $result=mysqli_query($coni,$sql);
    if($result)
    {
            $subject="Your RECEIVER Tracking ID";
            $msg="Hey receiver , your tracking ID is $rtrackingId";
            $message = "
            <html>
            <head>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        margin: 0;
                        padding: 0;
                        background-color: #f4f4f4;
                    }
                    .container {
                        padding: 20px;
                        background-color: #ffffff;
                        border: 1px solid #dddddd;
                        margin: 10px auto;
                        width: 80%;
                        max-width: 600px;
                        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
                    }
                    .header {
                        background-color: #4CAF50;
                        color: white;
                        padding: 10px 0;
                        text-align: center;
                    }
                    .content {
                        padding: 20px;
                    }
                    .content p {
                        line-height: 1.6;
                    }
                    .footer {
                        text-align: center;
                        padding: 10px;
                        background-color: #f4f4f4;
                        border-top: 1px solid #dddddd;
                    }
                </style>
            </head>
            <body>
                <div class='container'>
                    <div class='header'>
                        <h2>Receiver ID</h2>
                    </div>
                    <div class='content'>
                        <p><strong>Name:</strong> $sname</p>
                        <p><strong>Subject:</strong> $subject</p>
                        <p><strong>Message:</strong> $msg</p>
                    </div>
                    <div class='footer'>
                        <p>This email was sent from Bayanihan Express Cargo.</p>
                    </div>
                </div>
            </body>
            </html>";
            $to = $smail;
            $result = smtp_mailer($to, $subject, $message);
        
            if ($result === 'Sent') {
                echo "<script>alert('Mail sent successfully!');</script>";
                header("Location:admin.php");
            } else {
                echo "<script>alert('Mail sending failed: " . $result . "');</script>";
            }
        }
}
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sender and Receiver Forms</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #f4f4f9;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 80%;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            margin-top: 20px;
        }

        .form-container {
            display: flex;
            width: 100%;
            justify-content: space-between;
            margin-top: 20px;
        }

        .form-section {
            flex: 1;
            padding: 20px;
            margin: 10px;
            background-color: #e9ecef;
            border-radius: 8px;
        }

        .form-section h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .form-section form {
            display: flex;
            flex-direction: column;
        }

        .form-section form label {
            margin-bottom: 5px;
            color: #666;
        }

        .form-section form input,
        .form-section form textarea,
        .form-section form select {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-section form button {
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .form-section form button:hover {
            background-color: #0056b3;
        }

        @media (max-width: 768px) {
            .form-container {
                flex-direction: column;
            }
        }

        h1 {
            color: #007bff;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
    <a class="navbar-brand" href="#">BAYANIHAN TRACKING ADMIN</a>

    <form class="form-inline my-2 my-lg-0" action="logoutadmin.php" method="post">
      
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Log Out</button>
    </form>
  </div>
</nav>
    <h1>Add Tracking Record</h1>
    <div class="container">
        <div class="form-container">
            <div class="form-section">
                <h2>Sender's Information</h2>
                <form method="post">
                <input type="hidden" name="form-type" value="sender">
                    <label for="sender-name">Name:</label>
                    <input type="text" id="sender-name" name="sender-name" required>

                    <label for="sender-email">Email:</label>
                    <input type="email" id="sender-email" name="sender-email" required>

                    <label for="sender-status">Status:</label>
                    <select id="sender-status" name="sender-status" required>
                        <option value="packed">Packed</option>
                        <option value="dispatched">Dispatched</option>
                        <option value="delivered">Delivered</option>
                    </select>

                    <label for="dispatched-date">Dispatched Date:</label>
                    <input type="date" id="dispatched-date" name="dispatched-date" required>

                    <label for="track-id">Tracking Id:</label>
        <input type="text" id="track_id" name="track_id" value="<?php echo $trackingId; ?>" readonly>

                    <button type="submit">Send</button>
                </form>
            </div>
            <div class="form-section">
                <h2>Receiver's Information</h2>
                <form method="post">
                <input type="hidden" name="form-type" value="receiver">
                    <label for="receiver-name">Name:</label>
                    <input type="text" id="receiver-name" name="receiver-name" required>

                    <label for="receiver-email">Email:</label>
                    <input type="email" id="receiver-email" name="receiver-email" required>

                    <label for="receiver-status">Status:</label>
                    <select id="receiver-status" name="receiver-status" required>
                        <option value="packed">Packed</option>
                        <option value="dispatched">Dispatched</option>
                        <option value="delivered">Delivered</option>
                    </select>

                    <label for="rdispatched-date">Dispatched Date:</label>
                    <input type="date" id="rdispatched-date" name="rdispatched-date" required>

                    <label for="estimate-date">Estimated Delivery Date:</label>
                    <input type="date" id="estimate-date" name="estimate-date" required>

                    <label for="rtrack-id">Tracking Id:</label>
                    <input type="text" id="rtrack_id" name="rtrack_id" value="<?php echo $rtrackingId; ?>" readonly>

                    <button type="submit">Send</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
