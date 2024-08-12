<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('../api/connect.php');


$sql = "SELECT id, name, mobile, address created_at FROM user";
$result = $connect->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Activity</title>
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

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-top: 20px;
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        table th, table td {
            padding: 15px;
            text-align: left;
            font-size: 14px;
            border-bottom: 1px solid #e5e7eb;
        }

        table th {
            background-color: #3b82f6;
            color: white;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        table tr:last-child td {
            border-bottom: none;
        }

        table tr:nth-child(even) {
            background-color: #f9fafb;
        }

        table tr:hover {
            background-color: #f3f4f6;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .action-buttons a {
            background-color: #3b82f6;
            color: white;
            padding: 6px 12px;
            border-radius: 4px;
            text-decoration: none;
            transition: background-color 0.3s;
            font-size: 12px;
            font-weight: 500;
        }

        .action-buttons a:hover {
            background-color: #2563eb;
        }

        .action-buttons a:last-child {
            background-color: #ef4444;
        }

        .action-buttons a:last-child:hover {
            background-color: #dc2626;
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
        <h1>User Activity</h1>
        
        <table>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["mobile"] . "</td>";
                    echo "<td>" . $row["created_at"] . "</td>";
                    echo "<td class='action-buttons'>";
                    echo "<a href='edit_user.php?id=" . $row["id"] . "'>Edit</a>";
                    echo "<a href='delete_user.php?id=" . $row["id"] . "' onclick=\"return confirm('Are you sure you want to delete this user?');\">Delete</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No users found</td></tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>

<?php
$connect->close();
?>