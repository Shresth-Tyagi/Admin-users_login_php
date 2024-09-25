<?php
session_start();
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST["email"]; 
    $password = md5($_POST['password']);

    $stmt = $conn->prepare("SELECT id, password, role FROM `registrations` WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $db_password, $role);
        $stmt->fetch();

        if ($password === $db_password) {
            // Correct password & set session variables
            $_SESSION['email'] = $email;
            $_SESSION['role'] = $role;
            $_SESSION['user_id'] = $user_id; 

            header("Location: dashboard.php");
            exit();
        } else {
            echo '<script>alert("Password is incorrect")</script>';
        }
    } else {
        echo '<script>alert("Email not found")</script>';
    }

    $stmt->close();
    $conn->close();
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f3f3;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .main {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            padding: 20px;
            width: 300px;
        }

        .main h2 {
            color: #4caf50;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        select {
            width: 100%;
            margin-bottom: 15px;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        button[type="submit"] {
            padding: 15px;
            border-radius: 10px;
            border: none;
            background-color: #4caf50;
            color: white;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }
        
#name_id{
    color: red;
}
#email_id{
    color: red;
}
#mobile_id{
    color: red;
}
#password_id{
    color: red;
}
    </style>
</head>

<body>

    <div class="main">
        <h2>User Login</h2>
        <form method="POST" action="login.php" onsubmit="return myFun()">
            
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" value="" /><span id="email_id"></span> <br><br>


            <label for="password">Password:</label>
            <input type="password" id="password" name="password" value="" /><span id="password_id"></span> <br><br>

            <button type="submit" name="submit" value="submit">
                Login
            </button>
            <footer>Go for user registration-<a href="registration.php">Register here</a></footer>
        </form>
    </div>
</body>

</html>
