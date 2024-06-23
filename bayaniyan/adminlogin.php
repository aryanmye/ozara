<?php
session_start();

include 'connect.php';

$showerr = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $err = "";

    // Check if the keys are set before using them
    $form_username = isset($_POST["uname"]) ? $_POST["uname"] : "";
    $form_password = isset($_POST["password"]) ? $_POST["password"] : "";

    // Use prepared statements to prevent SQL injection
    $stmt = $coni->prepare("SELECT * FROM `user` WHERE username=? AND password=?");
    $stmt->bind_param("ss", $form_username, $form_password);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    $num = $result->num_rows;

    if ($num) {
        $re = $result->fetch_assoc();
        $user_data = array(
            'user_id' => $re['id'],
            'username' => $re['username'],
        
        );
        $_SESSION['user_data'] = $user_data;

        // Redirect to turf.php after successful login
        header('Location:admin.php');
        exit();
    } else {
        $showerr = "Invalid Email / Password";
        $_SESSION['error'] = "Invalid Email / Password";
       
    }
}
?>