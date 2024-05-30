<?php
include 'connect.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $err = "";

    // Check if the keys are set before using them
    $form_username = isset($_POST["uname"]) ? $_POST["uname"] : "";
    $form_password = isset($_POST["password"]) ? $_POST["password"] : "";

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM `users` WHERE username=? AND password=?");
    $stmt->bind_param("ss", $form_username, $form_password);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    $num = $result->num_rows;

    if ($num) {
        $re = $result->fetch_assoc();
        $user_data = array(
            'user_id' => $re['id'],
            'firstname' => $re['firstname'],
            'lastname' => $re['lastname'],
            'username' => $re['username'],
            'email' => $re['email'],
        );
        $_SESSION['user_data'] = $user_data;

        // Redirect to turf.php after successful login
        header('Location:index.php');
        exit();
    } else {
        $showerr = "Invalid Email / Password";
        $_SESSION['error'] = "Invalid Email / Password";
       
    }
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    
</head>
<style>
body {
    margin: 0;
    font-family: Arial, sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: #121212;
}

.container {
    display: flex;
    width: 80%;
    height: 80vh;
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}

.left-section {
    flex: 1;
    position: relative;
    overflow: hidden;
}

.background-video {
    width: 100%;
    height: 100%;
    object-fit: cover;
    position: absolute;
    top: 0;
    left: 0;
    z-index: -1;
}

.overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.6);
    display: flex;
    justify-content: center;
    align-items: center;
}

.company-name {
    color:white;
    font-size: 3em;
    text-align: center;
}

.right-section {
    flex: 1;
    background-color: #1e1e1e;
    display: flex;
    justify-content: center;
    align-items: center;
}

.login-form {
    width: 80%;
    max-width: 400px;
    background-color: #2e2e2e;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.5);
}

.login-form h2 {
    color: #ff0000;
    margin-bottom: 20px;
    text-align: center;
}

.login-form label {
    color: #ffffff;
    margin-top: 10px;
}

.login-form input {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
   
    border-radius: 4px;
    background-color: #3e3e3e;
    color: #ffffff;
}

.login-form button {
    width: 100%;
    padding: 10px;
    margin-top: 20px;
    border: none;
    border-radius: 4px;
    background-color: #ff0000;
    color: white;
    font-size: 16px;
    cursor: pointer;
}

.login-form button:hover {
    background-color: #cc0000;
}

.signup-prompt {
    margin-top: 20px;
    color: #ffffff;
    text-align: center;
}

.signup-prompt a {
    color: #ff0000;
    text-decoration: none;
}

.signup-prompt a:hover {
    text-decoration: underline;
}

</style>
<body>
    
<div class="container">
        <div class="left-section">
            <video autoplay muted loop class="background-video">
                <source src="your-video-url.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            <div class="overlay">
                <h1 class="company-name">Your Company</h1>
            </div>
        </div>
        <div class="right-section">
            <div class="login-form">
                <h2>Hey! Welcome back</h2>
                <form method="post">
                    <label for="username">Username</label>
                    <input type="text" id="uname" name="uname" required>
                    
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                    
                    <button type="submit">Login</button>
                    <p class="signup-prompt">Don't have an account? <a href="signup.html">Sign up</a></p>                </form>
            </div>
        </div>
    </div>
</body>
</html>