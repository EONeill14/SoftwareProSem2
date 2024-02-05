<?php

function getUserDetails($con, $username) {
    $stmt = $con->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if($row = $result->fetch_assoc()) {
        return $row;
    }
    return null;
}
function getUserDetailsById($con, $userId) {
    $stmt = $con->prepare("SELECT * FROM users WHERE id = ?");  // Note the column name change here
    $stmt->bind_param("i", $userId);  // 'i' signifies integer
    $stmt->execute();
    $result = $stmt->get_result();
    if($row = $result->fetch_assoc()) {
        return $row;
    }
    return null;
}
