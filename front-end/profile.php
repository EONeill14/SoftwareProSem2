<?php
include '../includes/database.php';
include '../includes/functions.php';

session_start();

if (!isset($_SESSION['username'])) {
    header('Location: ../login/login.php');
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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_details'])) {
    $phone_number = $_POST['phone_number'];
    $current_weight = $_POST['current_weight'];
    $target_weight = $_POST['target_weight'];
    $body_fat = $_POST['body_fat'];
    $target_body_fat = $_POST['target_body_fat'];

    $updateDetailsResult = updateUserDetailsExtended($con, $userID, $phone_number, $current_weight, $target_weight, $body_fat, $target_body_fat);

    if ($updateDetailsResult) {
        $userDetails = getUserDetails($con, $userID);
        echo "Details updated successfully!";
    } else {
        echo "Failed to update details.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Profile</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container">
            <h1>Welcome, <?php echo $userData['firstName'] . ' ' . $userData['lastName']; ?></h1>
            <p>Username: <?php echo $userData['username']; ?></p>
            <p>Email: <?php echo $userData['email']; ?></p>

            <?php if ($userDetails): ?>
                <p>Phone Number: <?php echo $userDetails['phone_number']; ?></p>
                <p>Current Weight: <?php echo $userDetails['current_weight']; ?></p>
                <p>Target Weight: <?php echo $userDetails['target_weight']; ?></p>
                <p>Body Fat: <?php echo $userDetails['body_fat']; ?></p>
                <p>Target Body-Fat: <?php echo $userDetails['target_body_fat']; ?></p>

                <form method="post" action="">
                    <input type="hidden" name="update_details" value="1">

                    <div class="form-group">
                        <label for="phone_number">Phone Number:</label>
                        <input type="text" class="form-control" name="phone_number" value="<?php echo $userDetails['phone_number']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="current_weight">Current Weight:</label>
                        <input type="text" class="form-control" name="current_weight" value="<?php echo $userDetails['current_weight']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="target_weight">Target Weight:</label>
                        <input type="text" class="form-control" name="target_weight" value="<?php echo $userDetails['target_weight']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="body_fat">Current Body Fat:</label>
                        <input type="text" class="form-control" name="body_fat" value="<?php echo $userDetails['body_fat']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="target_body_fat">Target Body Fat:</label>
                        <input type="text" class="form-control" name="target_body_fat" value="<?php echo isset($userDetails['target_body_fat']) ? $userDetails['target_body_fat'] : ''; ?>">
                    </div>

                    <input type="submit" class="btn btn-primary" value="Update Details">
                </form>

            <?php else: ?>
                <p>No additional details found.</p>
            <?php endif; ?>
            <a href="../login/index.php" class="btn btn-primary">Go back to Home</a>
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>
    </body>
</html>