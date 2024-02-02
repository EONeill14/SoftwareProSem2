<?php
include '../includes/database.php';

if (isset($_POST['signup'])) {
    $first_name = mysqli_real_escape_string($con, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($con, $_POST['last_name']);
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $user_image = "assets/images/profile_pics/defaults/head_deep_blue.png"; // default profile picture path
    $registration_date = date("Y-m-d");

    // Use prepared statement to prevent SQL injection
    $query = "INSERT INTO users (username, password, firstName, lastName, userImage, email, date) 
              VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "sssssss", $username, $password, $first_name, $last_name, $user_image, $email, $registration_date);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        echo "Account created successfully!";
    } else {
        echo "There was an error in creating your account.";
    }

    mysqli_stmt_close($stmt);
}
?>

<html>
<body>
<form action="signUp.php" method="post">
    First Name:<br>
    <input type="text" name="first_name" required>
    <br>
    Last Name:<br>
    <input type="text" name="last_name" required>
    <br>
    Username:<br>
    <input type="text" name="username" required>
    <br>
    Email:<br>
    <input type="email" name="email" required>
    <br>
    Password:<br>
    <input type="password" name="password" required>
    <br><br>
    <input type="submit" value="SignUp" name="signup">
</form>
    <a href="Login.php">Login</a>
</body>
</html>
