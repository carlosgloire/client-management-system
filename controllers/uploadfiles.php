<?php
require_once('../database/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $request_id = $_POST['request_id'];

    // Check if cover image upload is requested
    if (!empty($_FILES["uploadfile"]["name"])) {
        // Replace spaces in filename with underscores
        $filename = str_replace([' ', "'"], '_', $_FILES["uploadfile"]["name"]);
        $filesize = $_FILES["uploadfile"]["size"];
        $tempname = $_FILES["uploadfile"]["tmp_name"];
        $folder = "../admin/assets/img/curved-images/" . $filename;
        $allowedExtensions = ['png', 'jpg', 'jpeg'];
        $pattern = '/\.(' . implode('|', $allowedExtensions) . ')$/i';

        // Validate file type
        if (!preg_match($pattern, $filename)) {
            $error = "Your file must be in \"jpg, jpeg or png\" format";
            echo '<script>alert("' . $error . '");</script>';
            echo '<script>window.location.href="../admin/pages/detail-project.php?request_id=' . $request_id . '";</script>';
            exit;
        }

        // Validate file size
        if ($filesize > 2000000) {
            echo '<script>alert("The image file should not exceed 2MB");</script>';
            echo '<script>window.location.href="../admin/pages/detail-project.php?request_id=' . $request_id . '";</script>';
            exit;
        }

        // Move uploaded file
        if (!move_uploaded_file($tempname, $folder)) {
            echo '<script>alert("Failed to upload the image");</script>';
            echo '<script>window.location.href="../admin/pages/detail-project.php?request_id=' . $request_id . '";</script>';
            exit;
        }

        // Update cover image in database
        $query = $db->prepare("
            UPDATE requests SET cover_image = :cover_image WHERE request_id = :request_id
        ");
        $query->execute([
            'cover_image' => $filename,
            'request_id' => $request_id
        ]);

        echo '<script>alert("Cover image uploaded successfully");</script>';
        echo '<script>window.location.href="../admin/pages/detail-project.php?request_id=' . $request_id . '";</script>';
        exit;
    }

    // Check if attachment file is selected
    if (!empty($_FILES["file"]["name"])) {
        // Replace spaces in filename with underscores
        $filename2 = str_replace([' ', "'"], '_', $_FILES["uploadfile"]["name"]);
        $tempname2 = $_FILES["file"]["tmp_name"];
        $folder2 = "../admin/assets/attachments/" . $filename2;

        // Move attachment file
        if (!move_uploaded_file($tempname2, $folder2)) {
            echo '<script>alert("Failed to upload the attachment");</script>';
            echo '<script>window.location.href="../admin/pages/detail-project.php?request_id=' . $request_id . '";</script>';
            exit;
        }

        // Insert attachment into attachments table
        $stmt = $db->prepare('INSERT INTO attachements (request_id, attachement) VALUES (:request_id, :attachement)');
        $stmt->execute([
            'request_id' => $request_id,
            'attachement' => $filename2
        ]);

        echo '<script>alert("Attachment uploaded successfully");</script>';
        echo '<script>window.location.href="../admin/pages/detail-project.php?request_id=' . $request_id . '";</script>';
        exit;
    }

    // Neither cover image nor attachment selected
    echo '<script>alert("No attachment or cover image chosen");</script>';
    echo '<script>window.location.href="../admin/pages/detail-project.php?request_id=' . $request_id . '";</script>';
    exit;
}
?>
