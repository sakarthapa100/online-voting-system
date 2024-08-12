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
    <title>Manage Elections</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f2f5;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #333;
            color: white;
            position: fixed;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }

        .sidebar h2 {
            text-align: center;
            padding: 20px 0;
            margin: 0;
            font-size: 24px;
            background-color: #444;
            border-bottom: 1px solid #555;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar ul li {
            padding: 15px 20px;
            border-bottom: 1px solid #444;
        }

        .sidebar ul li a {
            color: white;
            text-decoration: none;
            display: block;
            font-size: 18px;
        }

        .sidebar ul li a:hover {
            background-color: #575757;
            border-radius: 4px;
        }

        .content {
            margin-left: 250px;
            padding: 40px;
            background-color: #fff;
            min-height: 100vh;
        }

        h1, h2 {
            color: #333;
        }

        h1 {
            font-size: 32px;
            margin-bottom: 20px;
        }

        h2 {
            font-size: 24px;
            margin-bottom: 15px;
        }

        form {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        form input[type="text"], 
        form input[type="date"], 
        form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
            border: 1px solid #ccc;
            font-size: 16px;
            color: #333;
        }

        form input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        form input[type="submit"]:hover {
            background-color: #45a049;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
            font-size: 16px;
        }

        table th {
            background-color: #4CAF50;
            color: white;
            font-weight: bold;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tr:hover {
            background-color: #ddd;
        }

        table td a {
            color: #4CAF50;
            text-decoration: none;
            font-weight: bold;
        }

        table td a:hover {
            text-decoration: underline;
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
        <h1>Manage Elections</h1>
        
        <!-- Create New Election Form -->
        <h2>Create a New Election</h2>
        <form action="create_election.php" method="post">
            <label for="election_name">Election Name:</label>
            <input type="text" id="election_name" name="election_name" required><br>

            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="4"></textarea><br>

            <label for="start_date">Start Date:</label>
            <input type="date" id="start_date" name="start_date" required><br>

            <label for="end_date">End Date:</label>
            <input type="date" id="end_date" name="end_date" required><br>

            <label for="candidates">Candidates:</label>
            <input type="text" id="candidates" name="candidates[]" placeholder="Candidate Name" required><br>
            <!-- Add more candidate fields as needed -->

            <input type="submit" value="Create Election">
        </form>

        <!-- List of Existing Elections -->
        <h2>Existing Elections</h2>
        <table>
            <tr>
                <th>Election Name</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            <!-- Example: Loop through elections and display them -->
            <!--
            <?php foreach ($elections as $election): ?>
            <tr>
                <td><?php echo $election['name']; ?></td>
                <td><?php echo $election['status']; ?></td>
                <td>
                    <a href="edit_election.php?id=<?php echo $election['id']; ?>">Edit</a>
                    <a href="delete_election.php?id=<?php echo $election['id']; ?>" onclick="return confirm('Are you sure?');">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
            -->
        </table>

    </div>
</body>
</html>
