<?php
include 'connection.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"]; 
    $email = $_POST["email"]; 
    $gender = $_POST["gender"]; 
    $mobile = $_POST["mobile"]; 
    $password = $_POST["password"]; 
    $md5_password = md5($password);
    $role = $_POST["role"];
    $image = '';

 
    if (isset($_FILES['image'])) {
        $file_name = $_FILES['image']['name'];
        $file_tmp = $_FILES['image']['tmp_name'];


        $uploaded = move_uploaded_file($file_tmp, "Database\Images" . $file_name);
        $image = $file_name;  // Store image path in $image variable

        if($uploaded){
            echo "Image is uploaded.<br><br>";  
        }
        else {
            echo "Image is not upload.<br><br>";
        }

      
    $insertdata = $conn->prepare("INSERT INTO registrations (name, email, gender, mobile, password, role, image) 
                                  VALUES (?, ?, ?, ?, ?, ?, ?)");

    $insertdata->bind_param("sssssss", $name, $email, $gender, $mobile, $md5_password, $role, $image);

    if ($insertdata->execute()) {
        echo "Registration successful.<br>";
    } else {
        echo "Registration failed.<br>";
    }

    $insertdata->close();
    $conn->close();

}
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registration Form</title>
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
.logo {
  width: 400px;
  height: 400px;
  position: absolute;
  top: 0;
  left: 5px;
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
<script src="validation.js"></script>

  <div class="main">
        <h2>Registration Form</h2>
        <form method="POST" action="registration.php" onsubmit="return myFun()"  enctype="multipart/form-data">
        
            <label for="first"> Name:</label>
            <input type="text" id="name" name="name" value="" /><span id="name_id"></span> <br><br>

            <label for="email">Email:</label>
            <input type="text" id="email" name="email" value="" /><span id="email_id"></span> <br><br>

            <label for="gender">Gender:</label>
            <select id="gender" name="gender" required>  
                <option value="male">
                    Male
                </option>
                <option value="female">
                    Female
                </option>
                <option value="other">
                    Other
                </option>
            </select>

            <label for="mobile">Contact:</label>
            <input type="text" id="mobile" name="mobile" maxlength="10" value="" /><span id="mobile_id"></span> <br><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" value="" /><span id="password_id"></span> <br><br>

            <label for="role">Role:</label>
            <select id="role" name="role" required>
                <option value="user">
                 User
                </option>
                <option value="admin">
                   Admin
                </option>
            </select>

            <label for="mobile">Upload Image:</label>
            <input type="file" id="image" name="image" required />
<br><br>
           <!-- <input type="file" name="image" /><br><br> -->
    
            <button type="submit" name="submit" value="submit">
               Submit
            </button>
            <br>
            <footer>Already a member? <a href="login.php">Login here</a></footer>
        </form>
    </div>
</body>
</html>





<!-------  
include 'connection.php';
include 'validate_form.php'; // Include the PHP validation file

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = $_POST["name"]; 
    $email = $_POST["email"]; 
    $gender = $_POST["gender"]; 
    $mobile = $_POST["mobile"]; 
    $password = $_POST["password"]; 
    $md5_password = md5($password);
    $role = $_POST["role"];
    $image = '';

    // Perform server-side validation using the function from validate_form.php
    $errors = validateForm($_POST);

    // If there are no validation errors, proceed with the database insertion
    if (empty($errors)) {
        if (isset($_FILES['image'])) {
            $file_name = $_FILES['image']['name'];
            $file_tmp = $_FILES['image']['tmp_name'];

            $uploaded = move_uploaded_file($file_tmp, "Database/Images/" . $file_name);
            $image = $file_name;  // Store image path in $image variable

            if (!$uploaded) {
                $errors['image'] = "Image upload failed";
            }
        }

        if (empty($errors)) {
            $insertdata = $conn->prepare("INSERT INTO registrations (name, email, gender, mobile, password, role, image) 
                                          VALUES (?, ?, ?, ?, ?, ?, ?)");

            $insertdata->bind_param("sssssss", $name, $email, $gender, $mobile, $md5_password, $role, $image);

            if ($insertdata->execute()) {
                echo "Registration successful.<br>";
            } else {
                echo "Registration failed.<br>";
            }

            $insertdata->close();
            $conn->close();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registration Form</title>
    <style>
        /* Your CSS here */
    </style>
</head>

<body>
  <div class="main">
    <h2>Registration Form</h2>
    <form method="POST" action="registration.php" enctype="multipart/form-data">
        <label for="name"> Name:</label>
        <input type="text" id="name" name="name" value=" echo isset($name) ? $name : ''; ?>" />
        <span> echo isset($errors['name']) ? $errors['name'] : ''; ?></span><br><br>

        <label for="email">Email:</label>
        <input type="text" id="email" name="email" value=" echo isset($email) ? $email : ''; ?>" />
        <span> echo isset($errors['email']) ? $errors['email'] : ''; ?></span><br><br>

        <label for="gender">Gender:</label>
        <select id="gender" name="gender" required>
            <option value="male"  echo isset($gender) && $gender == 'male' ? 'selected' : ''; ?>>Male</option>
            <option value="female"  echo isset($gender) && $gender == 'female' ? 'selected' : ''; ?>>Female</option>
            <option value="other"  echo isset($gender) && $gender == 'other' ? 'selected' : ''; ?>>Other</option>
        </select><br><br>

        <label for="mobile">Contact:</label>
        <input type="text" id="mobile" name="mobile" maxlength="10" value=" echo isset($mobile) ? $mobile : ''; ?>" />
        <span> echo isset($errors['mobile']) ? $errors['mobile'] : ''; ?></span><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" />
        <span> echo isset($errors['password']) ? $errors['password'] : ''; ?></span><br><br>

        <label for="role">Role:</label>
        <select id="role" name="role" required>
            <option value="user"  echo isset($role) && $role == 'user' ? 'selected' : ''; ?>>User</option>
            <option value="admin"  echo isset($role) && $role == 'admin' ? 'selected' : ''; ?>>Admin</option>
        </select><br><br>

        <label for="image">Upload Image:</label>
        <input type="file" id="image" name="image" /><br><br>

        <button type="submit" name="submit">Submit</button><br><br>

        <footer>Already a member? <a href="login.php">Login here</a></footer>
    </form>
  </div>
</body>
</html>


//   condition ? value_if_true : value_if_false;
//   < echo isset($email) ? $email : ''; ?>

---->
