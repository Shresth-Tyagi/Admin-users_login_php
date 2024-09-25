<?php
session_start();
include 'connection.php';

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$role = $_SESSION['role'];
$user_id = $_SESSION['user_id'];


if ($role == 'admin') {
    // For Admin to fetch all data 
    $stmt = $conn->prepare("SELECT * FROM registrations");
} 
else {
    // Fetch only logged-in user's data
    $stmt = $conn->prepare("SELECT * FROM registrations WHERE id = ?");
    $stmt->bind_param("i", $user_id);
}

$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        table, th, td {
            border: 2px solid black;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: aquamarine;
        }

        h2 {
            margin-top: 20px;
        }

        .action-buttons a {
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 5px;
            color: white;
        }

        .view {
            background-color: #00c04b;
        }

        .update {
            background-color: #00c04b;
        }

        .delete {
            background-color: #00c04b;
        }
    </style>
</head>
<body>
    <?php if ($role == 'admin'): ?>
        <h2>Admin Access: Displaying All Users</h2>
        <table>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Mobile</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
            <?php $count = 1;   ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars( "$count" ); ?></td>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo htmlspecialchars($row['gender']); ?></td>
                    <td><?php echo htmlspecialchars($row['mobile']); ?></td>
                    <td><?php echo htmlspecialchars($row['role']); ?></td>
                    <td class="action-buttons">
                        <a class="view" href="view.php?id=<?php echo $row['id']; ?>">View</a>
                        <a class="update" href="update.php?id=<?php echo $row['id']; ?>">Update</a>
                        <a class="delete" href="delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                    </td>
                </tr>
                <?php $count++; ?> 
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <?php 
            $row = $result->fetch_assoc(); // Fetch the row for the logged-in user
            if ($row):  // Check if data exists for the user
        ?>
        <?php echo "Single User data"; ?>
            <h2>Welcome, <?php echo htmlspecialchars($row['name']); ?>!</h2>
            <table>
                <tr>
                    <th>Email</th>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                </tr>
                <tr>
                    <th>Gender</th>
                    <td><?php echo htmlspecialchars($row['gender']); ?></td>
                </tr>
                <tr>
                    <th>Mobile</th>
                    <td><?php echo htmlspecialchars($row['mobile']); ?></td>
                </tr>
                
                <tr>
                    <th>Role</th>
                    <td><?php echo htmlspecialchars($row['role']); ?></td>
                </tr>
                <tr>
                    <th>Actions</th>
                    <td class="action-buttons">
                        <a class="update" href="update.php?id=<?php echo $row['id']; ?>">Update</a>
                        <a class="delete" href="delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                    </td>
                </tr>
            </table>
        <?php else: ?>
            <p>No user data found.</p>
        <?php endif; ?>
    <?php endif; ?>

</body>
</html>

<?php
$stmt->close();
$conn->close();
?>