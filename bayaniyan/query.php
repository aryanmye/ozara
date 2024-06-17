
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $query = $_POST['query'];
    $emaile = $_POST['emaile'];
    
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
                <h2>New Query By User</h2>
            </div>
            <div class='content'>
                <p><strong>Query Of User:</strong> $query</p>
                <p><strong>Email:</strong> $emaile</p>
            </div>
            <div class='footer'>
                <p>This email was sent from your website's quote enquiry form.</p>
            </div>
        </div>
    </body>
    </html>";
    $to="aryanjadhav686@gmail.com";
    $subject="New Query By User";
    $result = smtp_mailer($to, $subject, $message);

    if ($result === 'Sent') {
        echo "<script>alert('Mail sent successfully!');</script>";
        header("Location:index.html");
    } else {
        echo "<script>alert('Mail sending failed: " . $result . "');</script>";
    }
}
?>