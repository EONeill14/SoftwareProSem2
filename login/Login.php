<?php
session_start();

include '../includes/database.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $user['username'];
        $_SESSION['userID'] = $userID['userID'];

        header("Location: index.php");
    } else {
        echo "Invalid username or password.";
    }
}
?>

<html>
    <body>
        <form action="login.php" method="post">
            Username:<br>
            <input type="text" name="username">
            <br>
            Password:<br>
            <input type="password" name="password">
            <br><br>
            <input type="submit" value="Login" name="login">
        </form>
        <a href="signUp.php">Register</a>
    </body>
</html>
