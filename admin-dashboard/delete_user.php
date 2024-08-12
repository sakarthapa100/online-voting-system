<?php
// Include database connection file
include('../api/connect.php');

// Check if ID is provided
if (isset($_GET['id'])) {
    $userId = intval($_GET['id']);
    
    // Prepare SQL statement to prevent SQL injection
    $stmt = $connect->prepare("DELETE FROM user WHERE id = ?");
    $stmt->bind_param("i", $userId);
    
    if ($stmt->execute()) {
        // Redirect to the user activity page with a success message
        header("Location: user_activity.php?msg=User deleted successfully");
    } else {
        // Redirect to the user activity page with an error message
        header("Location: user_activity.php?msg=Error deleting user: " . $stmt->error);
    }
    
    // Close the statement
    $stmt->close();
} else {
    // Redirect to the user activity page with an error message if ID is missing
    header("Location: user_activity.php?msg=No user ID provided");
}

// Close the database connection
$connect->close();
?>
