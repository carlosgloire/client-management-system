<?php
session_start();

require('../../database/db.php');

//session not implemeted yet admin = 1
$admin_id = 1;

// Fetch admin information
$select_admin = "SELECT * FROM admin WHERE admin_id = :admin_id";
$statement = $db->prepare($select_admin);
$statement->execute(['admin_id' => $admin_id]);
$admin = $statement->fetch(PDO::FETCH_ASSOC);

// form modification
if (isset($_POST['edit_infos'])) {
    $newUsername = htmlspecialchars($_POST['newusername']);
    $newEmail = htmlspecialchars($_POST['newemail']);
    $newNumber = htmlspecialchars($_POST['newnumber']);
    $newPosition = htmlspecialchars($_POST['newposition']);
    $newLocation = htmlspecialchars($_POST['newlocation']);
    $newPassword1 = $_POST['newpassword1'];
    $profile = $_FILES['profile'];
    $coverImage = $_FILES['cover_image'];
    $confirmPassword = $_POST['confirm_me'];

    if (!empty($confirmPassword)) {
        // Verify password
        if (password_verify($confirmPassword, $admin['password'])) {
            // Update username
            if (!empty($newUsername) && $newUsername != $admin['username']) {
                $updateUsername = $db->prepare("UPDATE admin SET username = ? WHERE admin_id = ?");
                $updateUsername->execute([$newUsername, $admin_id]);
            }
            // Update email
            if (!empty($newEmail) && $newEmail != $admin['email']) {
                $updateEmail = $db->prepare("UPDATE admin SET email = ? WHERE admin_id = ?");
                $updateEmail->execute([$newEmail, $admin_id]);
            }
            // Update phone number
            if (!empty($newNumber) && $newNumber != $admin['phone_number']) {
                $updateNumber = $db->prepare("UPDATE admin SET phone_number = ? WHERE admin_id = ?");
                $updateNumber->execute([$newNumber, $admin_id]);
            }
            // Update position
            if (!empty($newPosition) && $newPosition != $admin['position']) {
                $updatePosition = $db->prepare("UPDATE admin SET position = ? WHERE admin_id = ?");
                $updatePosition->execute([$newPosition, $admin_id]);
            }
            // Update location
            if (!empty($newLocation) && $newLocation != $admin['location']) {
                $updateLocation = $db->prepare("UPDATE admin SET location = ? WHERE admin_id = ?");
                $updateLocation->execute([$newLocation, $admin_id]);
            }
            //update password
            if (!empty($newPassword1)) {
                $hashedPassword = password_hash($newPassword1, PASSWORD_DEFAULT);
                $updatePassword = $db->prepare("UPDATE admin SET password = ? WHERE admin_id = ?");
                $updatePassword->execute([$hashedPassword, $admin_id]);
            }
            // Update profile picture
            if (!empty($profile['name'])) {
                $sizeMax = 4097152; // 4MB
                $validExtensions = array('jpg', 'jpeg', 'gif', 'jfif', 'png');

                if ($profile['size'] <= $sizeMax) {
                    $extensionUpload = strtolower(pathinfo($profile['name'], PATHINFO_EXTENSION));
                    if (in_array($extensionUpload, $validExtensions)) {
                        $uniqueName = uniqid() . '.' . $extensionUpload;
                        $destination = __DIR__ . "../../admin/assets/img/employee_profiles/" . $uniqueName;
                        $result = move_uploaded_file($profile['tmp_name'], $destination);
                        if ($result) {
                            $updateProfile = $db->prepare("UPDATE admin SET profile = :profile WHERE admin_id = :admin_id");
                            $updateProfile->execute([
                                'profile' => $uniqueName,
                                'admin_id' => $admin_id
                            ]);
                        } else {
                            $msg = "Error during profile picture upload.";
                        }
                    } else {
                        $msg = "Profile picture must be in jpg, jpeg, gif, jfif, or png format.";
                    }
                } else {
                    $msg = "Profile picture must not exceed 4MB.";
                }
            }
            // Update cover image
            if (!empty($coverImage['name'])) {
                $sizeMax = 4097152; // 4MB
                $validExtensions = array('jpg', 'jpeg', 'png', 'gif');

                if ($coverImage['size'] <= $sizeMax) {
                    $extensionUpload = strtolower(pathinfo($coverImage['name'], PATHINFO_EXTENSION));
                    if (in_array($extensionUpload, $validExtensions)) {
                        $uniqueName = uniqid() . '.' . $extensionUpload;
                        $destination = __DIR__ . "../../admin/assets/img/employee_profiles/" . $uniqueName;
                        $result = move_uploaded_file($coverImage['tmp_name'], $destination);
                        if ($result) {
                            $updateCover = $db->prepare("UPDATE admin SET cover_image = :cover_image WHERE admin_id = :admin_id");
                            $updateCover->execute([
                                'cover_image' => $uniqueName,
                                'admin_id' => $admin_id
                            ]);
                        } else {
                            $msg = "Error during cover image upload.";
                        }
                    } else {
                        $msg = "Cover image must be in jpg, jpeg, png, or gif format.";
                    }
                } else {
                    $msg = "Cover image must not exceed 4MB.";
                }
            }
            header('Location: profile.php?id=' . $admin_id );
            exit();
        } else {
            $msg = "Incorrect password!";
        }
    } else {
        $msg = "Enter Your Current Password Before Making Any Changes";
    }
}
?>
