<?php


// Check if form is submitted for saving modifications
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_modifications'])) {
    $request_id = $_POST['request_id'];
    $client_name = $_POST['clientName'];
    $contact_info = $_POST['contactInfo'];
    $service_category = $_POST['serviceCategory'];
    $service_details = $_POST['serviceDetails'];
    $priority_level = $_POST['priorityLevel'];
    $deadline = $_POST['deadline'];
    $amount = $_POST['amount'];

    // Validate that no field is empty
    if ($client_name === "" || $contact_info === "" || $service_category === "" || $service_details === "" || $priority_level === "" || $deadline === "" || $amount === "") {
        echo '<script>alert("No field should be empty");</script>';
        echo '<script>window.location.href="../pages/detail-project.php?request_id=' . $request_id . '";</script>';
        exit;
    }

    // Assuming the contact_info contains both email and phone_number separated by a "|"
    list($client_email, $phone_number) = explode('|', $contact_info);

    // Get client_id from the requests table
    $query = $db->prepare("SELECT client_id FROM requests WHERE request_id = :request_id");
    $query->execute(['request_id' => $request_id]);
    $client_id = $query->fetchColumn();

    // Update the clients table
    $updateClient = $db->prepare("
        UPDATE clients 
        SET 
            username = :client_name, 
            email = :client_email, 
            phone_number = :phone_number
        WHERE 
            client_id = :client_id
    ");
    $updateClient->execute([
        'client_name' => $client_name,
        'client_email' => trim($client_email),
        'phone_number' => trim($phone_number),
        'client_id' => $client_id
    ]);

    // Update the requests table
    $updateRequest = $db->prepare("
        UPDATE requests 
        SET 
            service_category = :service_category, 
            service_details = :service_details, 
            priority_level = :priority_level, 
            deadline = :deadline, 
            amount = :amount
        WHERE 
            request_id = :request_id
    ");
    $updateRequest->execute([
        'service_category' => $service_category,
        'service_details' => $service_details,
        'priority_level' => $priority_level,
        'deadline' => date('Y-m-d', strtotime($deadline)), // Convert to the correct format for MySQL
        'amount' => $amount,
        'request_id' => $request_id
    ]);

    // Show a success message and reload the page
    echo '<script>alert("Modifications saved successfully!");</script>';
    echo '<script>window.location.href="../pages/detail-project.php?request_id=' . $request_id . '";</script>';
    exit;
}
?>
