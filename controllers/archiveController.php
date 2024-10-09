<?php
    require('../../database/db.php');

    $query = $db->prepare("
    SELECT 
        clients.client_id, 
        clients.username AS client_name, 
        clients.email AS client_email, 
        clients.profile AS client_profile,
        requests.project_name, 
        requests.priority_level, 
        requests.request_date, 
        completed_project.completed_date,
        GROUP_CONCAT(employees.username SEPARATOR ', ') AS team_members
    FROM completed_project
        LEFT JOIN requests ON completed_project.request_id = requests.request_id
        LEFT JOIN clients ON requests.client_id = clients.client_id
        LEFT JOIN completed_project_team ON completed_project.completed_id = completed_project_team.completed_id
        LEFT JOIN employees ON completed_project_team.employee_id = employees.employee_id
    GROUP BY completed_project.completed_id
        ORDER BY completed_project.completed_date DESC
    ");
    $query->execute();
    $completedProjects = $query->fetchAll(PDO::FETCH_ASSOC);
?>
