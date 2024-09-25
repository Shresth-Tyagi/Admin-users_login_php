<h1>View file</h1>

<?php
session_start();
include 'connection.php';

if (isset($_GET['id'])) {
$id = $_GET['id'];

echo "The ID is: " . $id . "<br>";

    $viewquery = $conn->prepare("SELECT * FROM `registrations` where id = ? ");
    $viewquery->bind_param("i", $id);

echo "Hii <br>";
echo "The ID is: " . $id;

$viewquery->execute();
$result = $viewquery->get_result();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Data</title>
</head>
<body>

<h1>Hello</h1>

<h2>Displaying Details:</h2>
        <?php while ($row = $result->fetch_assoc()): ?>
            <p><strong>Id:</strong> <?php echo htmlspecialchars($row['id']); ?></p>
            <p><strong>Name:</strong> <?php echo htmlspecialchars($row['name']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($row['email']); ?></p>
            <p><strong>Gender:</strong> <?php echo htmlspecialchars($row['gender']); ?></p>
            <p><strong>Mobile:</strong> <?php echo htmlspecialchars($row['mobile']); ?></p>
            <p><strong>Role:</strong> <?php echo htmlspecialchars($row['role']); ?></p>
            <p><strong>Image:</strong><img src="Database\Images<?php echo htmlspecialchars($row['image']); ?>" alt=" " height="260px" width="200px" ></p>
        <?php endwhile; ?>
    
</body>
</html>
