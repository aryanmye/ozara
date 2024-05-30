<?php
include('connect.php');
function validateUsername($username)
{
    return preg_match('/^[a-zA-Z]+$/', $username);
}

function validatePassword($password)
{
    // Validate password length and pattern
    if (strlen($password) === 8 && preg_match('/[A-Z]/', $password) && preg_match('/[^a-zA-Z0-9]/', $password)) {
        return true;
    }
    return false;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    $phone = $_POST["phone"];

    // Check if username already exists
    $existque = "SELECT * FROM `users` WHERE username='$username';";
    $result = mysqli_query($conn, $existque);
    $numrows = mysqli_num_rows($result);

    if ($numrows > 0) {
        $showerr = "Account already exists";
    } else {
        // Validate username
        if (!validateUsername($username)) {
            $showcharerr = "Username invalid! Your username should consist only of letters.";
        } else {
            // Validate password
            if (!validatePassword($password)) {
                $showerr = "Password must be 8 characters long, contain at least one uppercase letter, and one symbol.";
            } else {
                // Check if passwords match
                if ($password != $cpassword) {
                    $showerr = "Passwords do not match";
                } else {
                    // Insert user data into database
                    $sql = "INSERT INTO `users` (`firstname`, `lastname`, `username`, `email`, `password`, `phone`)
                            VALUES ('$firstname', '$lastname', '$username', '$email', '$password', '$phone')";
                    $result = mysqli_query($conn, $sql);

                    if ($result) {
                        // Retrieve inserted user data
                        $userId = mysqli_insert_id($conn);
                        $user_data = array(
                            'user_id' => $userId,
                            'firstname' => $firstname,
                            'lastname' => $lastname,
                            'username' => $username,
                            'email' => $email,
                        );

                        // Set session data
                        $_SESSION['user_data'] = $user_data;
                        header("Location: index.php");
                        exit();
                    } else {
                        $showerr = "Error: " . $sql . "<br>" . $conn->error;
                    }
                }
            }
        }
    }
}
?>



<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> Sign Up</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

	<!-- CSS here -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/owl.carousel.min.css">
	<link rel="stylesheet" href="assets/css/slicknav.css">
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <link rel="stylesheet" href="assets/css/hamburgers.min.css">
    <link rel="stylesheet" href="assets/css/gijgo.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/animated-headline.css">
	<link rel="stylesheet" href="assets/css/magnific-popup.css">
	<link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
	<link rel="stylesheet" href="assets/css/themify-icons.css">
	<link rel="stylesheet" href="assets/css/slick.css">
	<link rel="stylesheet" href="assets/css/nice-select.css">
	<link rel="stylesheet" href="assets/css/style.css">
</head>
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background: linear-gradient(to bottom, #333, #000); /* Dark grey to black gradient */
    color: #fff;
}

.signup-container {
    background-color: #1e1e1e;
    padding: 2em;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    text-align: center;
    width: 100%;
    max-width: 400px;
}

h1 , h2{
    margin-bottom: 1em;
    color: #ff0000; /* Red color */
}

form {
    display: flex;
    flex-direction: column;
}

input {
    padding: 0.8em;
    margin-bottom: 1em;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 1em;
}

input:focus {
    border-color: #ff0000; /* Red color */
    outline: none;
}

button {
    padding: 0.8em;
    border: none;
    border-radius: 5px;
    background-color: #ff0000; /* Red color */
    color: #fff;
    font-size: 1em;
    cursor: pointer;
    transition: background-color 0.3s;
}

button:hover {
    background-color: #cc0000; /* Darker red */
}
</style>

<body>
<div class="signup-container">
         <h1 style="font-weight:bold;">Ozara Group Of Companies</h1>
         <h2>Sign Up</h2>
        <form method="post">
            <input type="text" name="firstname" placeholder="Firstname" required>
            <input type="text" name="lastname" placeholder="Lastname" required>
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="cpassword" placeholder="Confirm Password" required>
            <input type="number" name="phone" placeholder="phone" required>
            <button type="submit" name="submit" >Sign Up</button>
        </form>
    </div>
</body>
</html>