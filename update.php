<?php
include 'connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    echo "The ID is: " . $id . "<br>";

    $selectdata = $conn->prepare("SELECT * FROM registrations WHERE id = ?");
    $selectdata->bind_param("i", $id);
    $selectdata->execute();
    $result = $selectdata->get_result();
    $row = $result->fetch_assoc();

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $name = $_POST['name'];   
        $email = $_POST['email'];
        $gender = $_POST['gender'];  
        $mobile = $_POST['mobile'];
        $password = $_POST['password'];
        $md5_password = md5($password);
        $image = $row['image']; 

        if (isset($_FILES['image'])) {
            $file_name = $_FILES['image']['name'];
            $file_tmp = $_FILES['image']['tmp_name'];
    
    
            $uploaded = move_uploaded_file($file_tmp, "Database/Images/" . $file_name);
            $image = $file_name;  // Store image path in $image variable
    
            if($uploaded){
                echo "Your Image is updated.<br><br>";  
            }
            else {
                echo " Your Image is not updated.<br><br>";
            }
    
     
     $updatequery = $conn->prepare("UPDATE registrations SET name = ? , email = ? , gender = ? , mobile = ? , password = ?, image = ?  Where id = ? ");
     $updatequery->bind_param("ssssssi", $name, $email, $gender, $mobile, $password, $image, $id);
     
        if ($updatequery->execute()) {
            echo "Data updated successfully.";
        } else {
            echo "Data is not updated.";
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
    <title>Update User</title>
</head>
<body>
    <?php if ($row): ?>
        <h1>Update form</h1>
        <form method="POST"  enctype="multipart/form-data">

        
     
        <br><br><p><strong>Image:</strong><img src="Database/Images/<?php echo htmlspecialchars($row['image']); ?>" alt=" " height="260px" width="200px" ></p>
       
           <label>Update Your Image:</label> 
            <input type="file" id="image" name="image" value="<?php echo htmlspecialchars($row['image']); ?>"><br><br>
            
            <label>Name:</label>
            <input type="text" name="name" value="<?php echo htmlspecialchars($row['name']); ?>"><br>
            <br>

            <label>Email:</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>"><br>
            <br>

            <label for="gender">Gender:</label>
            <select id="gender" name="gender" value="<?php echo htmlspecialchars($row['gender']); ?>"required>
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
         <br><br>

            <label>Mobile:</label>
            <input type="mobile" name="mobile" value="<?php echo htmlspecialchars($row['mobile']); ?>"><br>
            <br>

            <label>Password:</label>
            <input type="password" name="password" value="<?php echo htmlspecialchars($row['password']); ?>"><br>
            <br>
            
            
            <button type="submit">Update</button>
        </form>
    <?php else: ?>
        <p>User not avilable.</p>
    <?php endif; ?>
</body>
</html>

<?php
$selectdata->close();
$conn->close();
?>