<?php

/*---------------------------------------/
#PHP Codes for request details
/---------------------------------------*/

    if(isset($_GET['request_id']) AND ! empty($_GET['request_id'])){
        $request_id=$_GET['request_id'];
        }
        if (isset($request_id)) {
        // Query to get the project status based on the request_id
        $stmt = $db->prepare("SELECT project_status FROM projects WHERE request_id = ?");
        $stmt->execute([$request_id]);
        $project_status = $stmt->fetchColumn(); // Fetch the project status
        
        // Determine which badge to display based on project_status
        if ($project_status === 'Assigned') {
            $badge_html = '<span class="badge badge-sm bg-success">Assigned</span>';
        } elseif ($project_status === 'Pending') {
            $badge_html = '<span class="badge badge-sm bg-warning">Pending</span>';
        } elseif ($project_status === 'Rejected') {
            $badge_html = '<span class="badge badge-sm bg-danger">Rejected</span>';
        } elseif ($project_status === 'completed') {
            $badge_html = '<span class="badge badge-sm bg-success">Project completed</span>';
        }else {
            $badge_html = '<span class="badge badge-sm bg-danger">Status not set</span>';
        }
        } else {
        $badge_html = '<span class="badge badge-sm bg-danger">Status not set</span>'; // Default if request_id is not set
    }
    // Fetch employees and their task counts
    $stmt =$db->prepare("SELECT e.employee_id, e.username, COUNT(a.employee_id) AS task_count 
            FROM employees e
            LEFT JOIN assignment a ON e.employee_id = a.employee_id
            GROUP BY e.employee_id, e.username
            ORDER BY e.username  ASC
            ");
    $stmt->execute();
    $employees = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Prepare and execute the SQL query to get request details
    $query = $db->prepare("
        SELECT 
            r.request_id,
            r.client_id,
            r.position,
            r.service_category,
            r.service_details,
            r.priority_level,
            r.deadline,
            r.amount AS amt,
            r.request_date,
            r.project_name,
            r.project_image,
            r.company_name,
            r.cover_image,
            c.username AS client_username,
            c.email AS client_email,
            c.profile AS client_profile,
            c.phone_number
        FROM 
            requests r
        JOIN 
            clients c ON r.client_id = c.client_id
        WHERE
            r.request_id = :request_id
        GROUP BY
            r.request_id, r.client_id, r.position, r.service_category,r.project_image,r.cover_image, r.service_details, r.priority_level, r.deadline, r.amount, r.request_date,r.project_name, r.company_name, c.username, c.email, c.profile,c.phone_number
    ");
    $query->bindParam(':request_id', $request_id, PDO::PARAM_INT);
    $query->execute();
    $request = $query->fetch(PDO::FETCH_ASSOC);
    
    // Fetch attachments for this request
    $attachments_query = $db->prepare("SELECT * FROM attachements WHERE request_id = :request_id");
    $attachments_query->bindParam(':request_id', $request_id, PDO::PARAM_INT);
    $attachments_query->execute();
    $attachments = $attachments_query->fetchAll();
    
    // Fetch the request_id
    $requestid_query = $db->prepare("SELECT project_id FROM projects WHERE request_id = ?");
    $requestid_query->execute(array($request_id));
    $projects = $requestid_query->fetch(PDO::FETCH_ASSOC);

    // Fetch all goals from the goals table
    $request_id = $_GET['request_id']; // Assuming the request_id is passed as a parameter
    $stmt = $db->prepare("
        SELECT g.goals_id, g.goal_name,
               CASE WHEN p.goals_id IS NOT NULL THEN 'completed' ELSE 'pending' END as status
        FROM goals g
        LEFT JOIN progress p ON g.goals_id = p.goals_id
        WHERE g.goal_id IN (SELECT goal_id FROM goal WHERE request_id = :request_id)
    ");
    $stmt->bindParam(':request_id', $request_id);
    $stmt->execute();
    $goals = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $client_id = $request['client_id'];  

    // Fetch messages between the client and admin
    $query = $db->prepare("SELECT * FROM messages WHERE client_id = :client_id ORDER BY timestamp ASC");
    $query->execute(['client_id' => $client_id]);
    $messages = $query->fetchAll(PDO::FETCH_ASSOC);

    // Fetch messages between the employee and admin
    $query = $db->prepare("SELECT * FROM messages_with_employees WHERE request_id = :request_id ORDER BY timestamp ASC");
    $query->execute(['request_id' => $request_id]);
    $messages_employees = $query->fetchAll(PDO::FETCH_ASSOC);


    // Fetch the current number of goals for the given request_id
    $stmt = $db->prepare("SELECT goals_number FROM goal WHERE request_id = ?");
    $stmt->execute(array($request_id));
    $goals_number = $stmt->fetchColumn();
    
    // Fetch the goals completed
    $stmt = $db->prepare("SELECT COUNT(p.goals_id) 
            FROM requests r 
            JOIN 
                goal g ON g.request_id=r.request_id 
            JOIN 
                goals gs ON g.goal_id = gs.goal_id 
            JOIN progress p ON p.goals_id = gs.goals_id  
            WHERE r.request_id = ?");
    $stmt->execute(array($request_id));
    $goals_completed = $stmt->fetchColumn();
   
?>
