<?php

include('../database/db.php');

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Sanitize and assign form data to variables
    $employee_id = $_POST['employee_id']; 
    $employeeName = $_POST['employeeName'];
    $position = $_POST['position'];
    $department_id = $_POST['department'];
    $dob = $_POST['birthdate'];
    $phone = $_POST['contact'];
    $address = $_POST['address'];
    $start_date = $_POST['startDate'];
    $salary = $_POST['salary'];
    $notes = $_POST['notes'];
    $password = $_POST['password'];

    // Initialize variables for file paths
    $profilePicture = null;
    $cvFile = null;

    // Handle profile picture upload
    if (isset($_FILES["uploadfile"]) && $_FILES["uploadfile"]["error"] === UPLOAD_ERR_OK) {
        $filename = str_replace([' ', "'"], '_', $_FILES["uploadfile"]["name"]);
        $filesize = $_FILES["uploadfile"]["size"];
        $tempname = $_FILES["uploadfile"]["tmp_name"];
        $folder = "../admin/assets/img/employee_profiles/" . $filename;
        $allowedExtensions = ['png', 'jpg', 'jpeg'];
        $pattern = '/\.(' . implode('|', $allowedExtensions) . ')$/i';

        if (!preg_match($pattern, $filename)) {
            echo '<script>alert("Your file must be in \"jpg, jpeg or png\" format");</script>';
            echo '<script>window.location.href="../admin/pages/detail-employee.php?employee_id=' . $employee_id . '";</script>';
            exit;
        }

        if ($filesize > 2000000) {
            echo '<script>alert("The image file should not exceed 2MB");</script>';
            echo '<script>window.location.href="../admin/pages/detail-employee.php?employee_id=' . $employee_id . '";</script>';
            exit;
        }

        if (!move_uploaded_file($tempname, $folder)) {
            echo '<script>alert("Failed to upload the image");</script>';
            echo '<script>window.location.href="../admin/pages/detail-employee.php?employee_id=' . $employee_id . '";</script>';
            exit;
        }
        
        $profilePicture = $filename;
    } else {
        $fetchProfileQuery = "SELECT profile FROM employees WHERE employee_id = :employee_id";
        $fetchStmt = $db->prepare($fetchProfileQuery);
        $fetchStmt->execute(['employee_id' => $employee_id]);
        $profilePicture = $fetchStmt->fetchColumn();
    }

    // Handle CV upload
    if (isset($_FILES["uploadcv"]) && $_FILES["uploadcv"]["error"] === UPLOAD_ERR_OK) {
        $cvFilename = str_replace([' ', "'"], '_', $_FILES["uploadcv"]["name"]);
        $cvFilesize = $_FILES["uploadcv"]["size"];
        $cvTempname = $_FILES["uploadcv"]["tmp_name"];
        $cvFolder = "../admin/assets/files/cv/" . $cvFilename;
        $allowedCvExtensions = ['pdf'];
        $cvPattern = '/\.(' . implode('|', $allowedCvExtensions) . ')$/i';

        if (!preg_match($cvPattern, $cvFilename)) {
            echo '<script>alert("Your CV must be in \"pdf\" format");</script>';
            echo '<script>window.location.href="../admin/pages/detail-employee.php?employee_id=' . $employee_id . '";</script>';
            exit;
        }

        if ($cvFilesize > 5000000) {
            echo '<script>alert("The CV file should not exceed 5MB");</script>';
            echo '<script>window.location.href="../admin/pages/detail-employee.php?employee_id=' . $employee_id . '";</script>';
            exit;
        }

        if (!move_uploaded_file($cvTempname, $cvFolder)) {
            echo '<script>alert("Failed to upload the CV");</script>';
            echo '<script>window.location.href="../admin/pages/detail-employee.php?employee_id=' . $employee_id . '";</script>';
            exit;
        }
        
        $cvFile = $cvFilename;
    } else {
        $fetchCvQuery = "SELECT cv FROM employees WHERE employee_id = :employee_id";
        $fetchCvStmt = $db->prepare($fetchCvQuery);
        $fetchCvStmt->execute(['employee_id' => $employee_id]);
        $cvFile = $fetchCvStmt->fetchColumn();
    }

    // Hash the password if provided
    $hashedPassword = !empty($password) ? password_hash($password, PASSWORD_DEFAULT) : null;

    // Build the update query
    $updateEmployeeQuery = "
        UPDATE employees 
        SET username = :employeeName, position = :position, department_id = :department_id, 
            dob = :dob, phone = :phone, address = :address, start_date = :start_date, salary = :salary, 
            profile = :profile, note = :note" .
            ($cvFile ? ", cv = :cv" : "") .
            ($hashedPassword ? ", password = :password" : "") . 
        " WHERE employee_id = :employee_id
    ";
    
    // Prepare parameters
    $params = [
        'employeeName' => $employeeName,
        'position' => $position,
        'department_id' => $department_id,
        'dob' => $dob,
        'phone' => $phone,
        'address' => $address,
        'start_date' => $start_date,
        'salary' => $salary,
        'profile' => $profilePicture,
        'note' => $notes,
        'employee_id' => $employee_id
    ];
    
    if ($cvFile) {
        $params['cv'] = $cvFile;
    }
    
    if ($hashedPassword) {
        $params['password'] = $hashedPassword;
    }

    // Execute the update query
    $stmt = $db->prepare($updateEmployeeQuery);
    $stmt->execute($params);

    // Redirect back to the employee detail page with a success message
    echo '<script>
        alert("Employee information updated successfully.");
        window.location.href = "../admin/pages/detail-employee.php?employee_id=' . $employee_id . '";
    </script>';
    exit();
}
?>
