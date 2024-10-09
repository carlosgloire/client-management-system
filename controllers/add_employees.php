<?php
require_once('../../database/db.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
    // Get form data
    $username = htmlspecialchars($_POST['username']) ;
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']) ;
    $address = htmlspecialchars($_POST['address']) ;
    $position = htmlspecialchars($_POST['position']) ;
    $dob = htmlspecialchars($_POST['dob']) ;
    $department_id = $_POST['department_id'];
    $note = htmlspecialchars($_POST['note']);

    // Set the start_date to the current date
    $start_date = date('Y-m-d');

    // Insert into the employees table
    $insertQuery = $db->prepare('
        INSERT INTO employees 
        (username, email, phone, address, position, dob,  department_id, start_date, note)
        VALUES 
        (:username, :email, :phone, :address, :position, :dob, :department_id, :start_date, :note)
    ');

    // Bind the values
    $insertQuery->bindValue(':username', $username);
    $insertQuery->bindValue(':email', $email);
    $insertQuery->bindValue(':phone', $phone);
    $insertQuery->bindValue(':address', $address);
    $insertQuery->bindValue(':position', $position);
    $insertQuery->bindValue(':dob', $dob);
    $insertQuery->bindValue(':department_id', $department_id);
    $insertQuery->bindValue(':start_date', $start_date);
    $insertQuery->bindValue(':note', $note);

    // Execute the query
    if ($insertQuery->execute()) {
        echo "<script>alert('Employee added successfully!');</script>";
    } else {
        echo "<script>alert('Error adding employee.');</script>";
    }
}