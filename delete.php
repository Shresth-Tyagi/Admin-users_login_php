<?php 

include 'connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    echo "The ID is: " . $id . "<br>";
    
$deleteuser = $conn->prepare("DELETE FROM registrations WHERE id = ?");
$deleteuser->bind_param("i", $id);
     if ($deleteuser->execute()) {
          echo "User deleted successfully.";
}  
else {
    echo "user not deleted";
}

$deleteuser->close();
$conn->close();
exit();
}
