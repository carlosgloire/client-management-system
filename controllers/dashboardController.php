<?php
require('../../database/db.php');

try {
      // Ongoing projects
      $count_status = $db->prepare("

      SELECT 
      COUNT(DISTINCT r.request_id) AS project_count
      FROM 
      requests r
      JOIN
      projects p ON r.request_id = p.request_id
      JOIN
      goal g ON g.request_id = p.request_id
      JOIN
      goals gls ON gls.goal_id = g.goal_id          
      JOIN 
      assignment ass ON p.project_id = ass.project_id
      JOIN 
      employees e ON ass.employee_id = e.employee_id
      WHERE 
      p.project_status = 'Assigned'
      ");
      $count_status->execute();
      $result = $count_status->fetch(PDO::FETCH_ASSOC);
      $ongoing_projects = $result ? $result['project_count'] : 0;
  
      // Rejected projects
      $count_status = $db->prepare("SELECT COUNT(*) AS rejected_count FROM projects WHERE project_status = 'rejected'");
      $count_status->execute();
      $result = $count_status->fetch(PDO::FETCH_ASSOC);
      $rejected_projects = $result ? $result['rejected_count'] : 0;
  
      // All employees
      $count_employees = $db->prepare("SELECT COUNT(*) AS employee_count FROM employees");
      $count_employees->execute();
      $result = $count_employees->fetch(PDO::FETCH_ASSOC);
      $total_employees = $result ? $result['employee_count'] : 0;
  
      // Completed projects
      $count_completed_project = $db->prepare("SELECT COUNT(*) AS completed_project_count FROM completed_project");
      $count_completed_project->execute();
      $result = $count_completed_project->fetch(PDO::FETCH_ASSOC);
      $completed_project = $result ? $result['completed_project_count'] : 0;
  
      // Off employees
      $count_employees = $db->prepare("SELECT COUNT(*) AS off_employee_count FROM off_employees");
      $count_employees->execute();
      $result = $count_employees->fetch(PDO::FETCH_ASSOC);
      $off_employees = $result ? $result['off_employee_count'] : 0;
  
      // Working employees
      $count_employees = $db->prepare("SELECT COUNT(DISTINCT employee_id) AS working_employee_count FROM assignment");
      $count_employees->execute();
      $result = $count_employees->fetch(PDO::FETCH_ASSOC);
      $working_employees = $result ? $result['working_employee_count'] : 0;
  
  } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
  }
  

    //free employees
    $free_employees = $total_employees - $working_employees - $off_employees;
    
    //not assigned, rejected or pending yet 
    $unassigned = "SELECT COUNT(*) AS unassigned_count FROM requests r LEFT JOIN projects p ON r.request_id = p.request_id WHERE p.project_status IS NULL";
    $unassigned = $db->prepare($unassigned);
    $unassigned->execute();
    $result = $unassigned->fetch(PDO::FETCH_ASSOC);
    $unassigned_requests = $result['unassigned_count'];

      // SQL query to fetch requests and the associated employees
      $stmt = $db->prepare("
      SELECT 
      r.request_id,
      r.client_id,
      r.project_name,
      r.amount,
      r.project_image,
      p.project_status,
      GROUP_CONCAT(e.profile) AS employee_profiles,
      GROUP_CONCAT(e.username) AS employee_names,
      GROUP_CONCAT(e.employee_id) AS employee_ids,
      (SELECT COUNT(pgo.goals_id) 
      FROM progress pgo 
      JOIN goals g ON pgo.goals_id = g.goals_id 
      JOIN goal go ON g.goal_id = go.goal_id 
      WHERE go.request_id = r.request_id 
      AND pgo.status = 'completed') AS completed_goals,
      (SELECT sg.goals_number 
      FROM goal sg 
      WHERE sg.request_id = r.request_id
      LIMIT 1) AS goals_number
      FROM 
      requests r
      LEFT JOIN
      projects p ON r.request_id = p.request_id
      LEFT JOIN 
      assignment ass ON p.project_id = ass.project_id
      LEFT JOIN 
      employees e ON ass.employee_id = e.employee_id
      WHERE 
      p.project_status = 'Assigned' OR p.project_status = 'Pending' OR p.project_status = 'Rejected' OR p.project_status = 'completed' OR  p.project_status IS NULL
      GROUP BY 
      r.request_id, r.client_id, r.project_name, r.amount, p.project_status, r.project_image
      ");


      $stmt->execute();
      $requests = $stmt->fetchAll();

   // last ongoing projects
   $query = "
      SELECT 
            COUNT(DISTINCT r.request_id) AS project_count,
            r.project_name,
            r.request_id,
            r.project_image,
            r.service_details
      FROM 
            requests r
      JOIN
            projects p ON r.request_id = p.request_id
      JOIN
            goal g ON g.request_id = p.request_id
      JOIN
            goals gls ON gls.goal_id = g.goal_id          
      JOIN 
            assignment ass ON p.project_id = ass.project_id
      JOIN 
            employees e ON ass.employee_id = e.employee_id
      WHERE 
            p.project_status = 'Assigned'
      ORDER BY 
            p.project_id DESC
      LIMIT 1
      ";

      $latest_ongoing_project = $db->prepare($query);
      $latest_ongoing_project->execute();
      $latest_project = $latest_ongoing_project->fetch(PDO::FETCH_ASSOC);

      if ($latest_project) {
            $project_name = $latest_project['project_name'];
            $project_image = $latest_project['project_image'];
            $service_details = $latest_project['service_details'];
            $request_id = $latest_project['request_id'];
      } 
         else{
            $project_name = "All the project are completed";
            $project_image = "no_project.jfif"; 
            $service_details = "";
            $request_id = "#";
      }
      
      //last completed project
      $query = "SELECT r.project_name, r.service_details, r.project_image,r.request_id
          FROM completed_project cp 
          JOIN requests r ON cp.request_id = r.request_id 
          ORDER BY cp.completed_date DESC 
          LIMIT 1";
      $stmt = $db->prepare($query);
      $stmt->execute();
      $latestProject = $stmt->fetch(PDO::FETCH_ASSOC);

      //latest 10 requests 
      $latest_requests_query = "SELECT project_name, request_date FROM requests ORDER BY request_date DESC LIMIT 10";
      $latest_requests_stmt = $db->prepare($latest_requests_query);
      $latest_requests_stmt->execute();
      $latest_requests = $latest_requests_stmt->fetchAll(PDO::FETCH_ASSOC);
      
?>
