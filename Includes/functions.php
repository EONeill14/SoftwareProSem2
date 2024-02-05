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
    $stmt = $con->prepare("SELECT * FROM users WHERE userId = ?");
    $stmt->bind_param("i", $userID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        return $row;
    }

    return null;
}


function updateUserDetails($con, $userID, $newFirstName, $newLastName) {
    $stmt = $con->prepare("UPDATE users SET firstName = ?, lastName = ? WHERE userID = ?");
    $stmt->bind_param("ssi", $newFirstName, $newLastName, $userID);
    $stmt->execute();

    return $stmt->affected_rows > 0;
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
