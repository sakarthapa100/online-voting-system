<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('../api/connect.php');

// Check if ID is provided
if (isset($_GET['id'])) {
    $userId = intval($_GET['id']);
    echo "ID provided: " . htmlspecialchars($userId) . "<br>";
    
    // Fetch user data from the database
    $stmt = $connect->prepare("SELECT Id, name, address, role FROM user WHERE Id = ?");
    if (!$stmt) {
        die("Prepare failed: " . $connect->error);
    }

    $stmt->bind_param("i", $userId);
    if (!$stmt->execute()) {
        die("Execute failed: " . $stmt->error);
    }

    $result = $stmt->get_result();
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
    } else {
        die("User not found.");
    }

    $stmt->close();
} else {
    die("No user ID provided.");
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $role = $_POST['role'];
    
    // Update user data in the database
    $stmt = $connect->prepare("UPDATE user SET name = ?, address = ?, role = ? WHERE Id = ?");
    if (!$stmt) {
        die("Prepare failed: " . $connect->error);
    }

    $stmt->bind_param("sssi", $name, $address, $role, $userId);
    
    if ($stmt->execute()) {
        header("Location: user_activity.php?msg=User updated successfully");
        exit();
    } else {
        $error = "Error updating user: " . $stmt->error;
    }
    
    $stmt->close();
}

$connect->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f4f8;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #1e3a8a;
            color: white;
            position: fixed;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        }

        .sidebar h2 {
            text-align: center;
            padding: 20px 0;
            margin: 0;
            font-size: 24px;
            background-color: #1e40af;
            border-bottom: 1px solid #2563eb;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
            margin-top: 20px;
        }

        .sidebar ul li {
            padding: 15px 20px;
        }

        .sidebar ul li a {
            color: white;
            text-decoration: none;
            display: block;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .sidebar ul li a:hover {
            background-color: #2563eb;
            padding-left: 25px;
        }

        .content {
            margin-left: 250px;
            padding: 40px;
            background-color: #fff;
            min-height: 100vh;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 28px;
            margin-bottom: 30px;
            color: #1e3a8a;
            border-bottom: 2px solid #3b82f6;
            padding-bottom: 10px;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        form label {
            display: block;
            margin-bottom: 5px;
            color: #1e3a8a;
            font-weight: 500;
        }

        form input, form select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #d1d5db;
            border-radius: 4px;
            font-size: 14px;
        }

        form input[type="submit"] {
            background-color: #3b82f6;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
            font-weight: 500;
            transition: background-color 0.3s;
        }

        form input[type="submit"]:hover {
            background-color: #2563eb;
        }

        .error {
            color: #ef4444;
            margin-bottom: 20px;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Admin Dashboard</h2>
        <ul>
            <li><a href="manage_elections.php">Manage Elections</a></li>
            <li><a href="view_stats.php">View Statistics</a></li>
            <li><a href="user_activity.php">User Activity</a></li>
        </ul>
    </div>
    <div class="content">
        <h1>Edit User</h1>

        <?php if (isset($error)): ?>
            <p class="error"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <form action="edit_user.php?id=<?php echo htmlspecialchars($userId); ?>" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($user['address']); ?>" required>

            <label for="role">Role:</label>
            <input type="text" id="role" name="role" value="<?php echo htmlspecialchars($user['role']); ?>" required>

            <input type="submit" value="Update User">
        </form>
    </div>
</body>
</html>