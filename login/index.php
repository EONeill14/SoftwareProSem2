<?php
session_start();
if(!isset($_SESSION['username'])){
  header('Location: login.php');
  exit;
}

// User is logged in. Display a welcome message.
echo "Welcome back, " . $_SESSION['username'];

?>

<html>
<body>
    <a href="logout.php">Logout</a>
    <a href="../front-end/profile.php">Profile</a>
</body>
</html>
