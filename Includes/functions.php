<?php

function getUserIdByUsername($con, $username) {
    $stmt = $con->prepare("SELECT userID FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        return $row['userID'];
    }

    return null;
}

function getUserDetailsById($con, $userID) {
    $stmt = $con->prepare("SELECT userID, username, email, firstName, lastName FROM users WHERE userID = ?");
    $stmt->bind_param("i", $userID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        return $row;
    }

    return null;
}

function getUserDetails($con, $userID) {
    $stmt = $con->prepare("SELECT * FROM user_details WHERE userID = ?");
    $stmt->bind_param("i", $userID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        return $row;
    }

    return null;
}


function updateUserDetailsExtended($con, $userID, $phone_number, $current_weight, $target_weight, $body_fat, $target_body_fat) {
    $query = "UPDATE user_details SET
              phone_number = '$phone_number',
              current_weight = '$current_weight',
              target_weight = '$target_weight',
              body_fat = '$body_fat',
              target_body_fat = '$target_body_fat'
              WHERE userID = '$userID'";

    $result = mysqli_query($con, $query);

    return $result;
}
?>