<?php
session_start();
if(!isset($_SESSION['username'])){
  // User not logged in. Redirect them back to the login.php page.
  header('Location: login.php');
  exit;
}

// User is logged in. Display a welcome message.
echo "Welcome back, " . $_SESSION['username'];

?>

<html>
<body>
    <a href="logout.php">Logout</a>
    <a href="">add page for future use</a>
</body>
</html>
