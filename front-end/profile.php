<?php
include '../includes/database.php';
include '../includes/functions.php';

session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

$username = $_SESSION['username'];
$userID = getUserIdByUsername($con, $username);

if (!$userID) {
    die("User ID not found");
}

$userData = getUserDetailsById($con, $userID);
$userDetails = getUserDetails($con, $userID);

if (!$userData) {
    die("User details not found");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
</head>
<body>

    <h1>Welcome, <?php echo $userData['firstName'] . ' ' . $userData['lastName']; ?></h1>
    <p>Username: <?php echo $userData['username']; ?></p>
    <p>Email: <?php echo $userData['email']; ?></p>
    
    <?php if ($userDetails): ?>
        <p>Phone Number: <?php echo $userDetails['phone_number']; ?></p>
        <p>Current Weight: <?php echo $userDetails['current_weight']; ?></p>
        <p>Target Weight: <?php echo $userDetails['target_weight']; ?></p>
        <p>Body Fat: <?php echo $userDetails['body_fat']; ?></p>
    <?php else: ?>
        <p>No additional details found.</p>
    <?php endif; ?>

    <a href="index.php">Go back to Home</a>
    <a href="logout.php">Logout</a>

</body>
</html>

