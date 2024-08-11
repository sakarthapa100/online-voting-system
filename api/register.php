<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('connect.php');

$name = $_POST['name'];
$mobile = $_POST['mobile'];
$password = $_POST['password'];
$cpassword = $_POST['cpassword'];
$address = $_POST['address'];
$image = isset($_FILES['photo']['name']) ? $_FILES['photo']['name'] : null;
$tmp_name = isset($_FILES['photo']['tmp_name']) ? $_FILES['photo']['tmp_name'] : null;
$role = $_POST['role'];

if ($password == $cpassword) {
    if ($image && $tmp_name) {
        move_uploaded_file($tmp_name, "../uploads/$image");
    } else {
        echo '
        <script>
            alert("Please upload a photo.");
            window.location = "../routes/register.html";
        </script>
        ';
        exit();
    }

    $insert = mysqli_query($connect, "INSERT INTO user (name, mobile, address, password, photo, role, status, votes) VALUES ('$name', '$mobile', '$address', '$password', '$image', '$role', 0, 0)");
    
    if ($insert) {
        echo '
        <script>
            alert("Registration Successful!");
            window.location = "../"; // Adjust this path if necessary
        </script>
        ';
    } else {
        echo '
        <script>
            alert("Registration Failed! Error: ' . mysqli_error($conn) . '");
            window.location = "../routes/register.html";
        </script>
        ';
    }
} else {
    echo '
    <script>
        alert("Password and Confirm password do not match!");
        window.location = "../routes/register.html"; 
    </script>
    ';
}
?>
