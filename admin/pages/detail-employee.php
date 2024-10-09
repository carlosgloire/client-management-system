<?php
require_once('../../database/db.php');

if (isset($_GET['employee_id']) && !empty($_GET['employee_id'])) {
  $employee_id = $_GET['employee_id'];
} else {
  // Handle the case where employee_id is not set or is empty
  die("Employee ID is not provided.");
}


// Query to get the number of projects got per month

$allMonths = array_map(function($m) {
  return date('Y') . '-' . str_pad($m, 2, '0', STR_PAD_LEFT);
}, range(1, 12));

// Query to get the number of projects got per month
$projectsGotQuery = "
SELECT 
  DATE_FORMAT(cp.completed_date, '%Y-%m') AS month, 
  COUNT(*) AS total_projects
FROM completed_project_team cpt
JOIN completed_project cp ON cpt.completed_id = cp.completed_id
JOIN requests r ON cp.request_id = r.request_id
WHERE cpt.employee_id = :employee_id
GROUP BY DATE_FORMAT(cp.completed_date, '%Y-%m')
ORDER BY DATE_FORMAT(cp.completed_date, '%Y-%m')";

$projectsGotStmt = $db->prepare($projectsGotQuery);
$projectsGotStmt->execute(['employee_id' => $employee_id]);
$projectsGotResult = $projectsGotStmt->fetchAll(PDO::FETCH_ASSOC);

// Query to get the number of completed projects per month
$completedProjectsQuery = "
SELECT 
  DATE_FORMAT(cp.completed_date, '%Y-%m') AS month, 
  COUNT(*) AS completed_projects
FROM completed_project_team cpt
JOIN completed_project cp ON cpt.completed_id = cp.completed_id
JOIN requests r ON cp.request_id = r.request_id
WHERE cpt.employee_id = :employee_id AND cpt.status = 'completed'
GROUP BY DATE_FORMAT(cp.completed_date, '%Y-%m')
ORDER BY DATE_FORMAT(cp.completed_date, '%Y-%m')";

$completedProjectsStmt = $db->prepare($completedProjectsQuery);
$completedProjectsStmt->execute(['employee_id' => $employee_id]);
$completedProjectsResult = $completedProjectsStmt->fetchAll(PDO::FETCH_ASSOC);

// Initialize arrays with zero data
$months = $allMonths;
$totalProjects = array_fill(0, 12, 0);
$completedProjects = array_fill(0, 12, 0);

// Fill data for total projects
foreach ($projectsGotResult as $row) {
  $monthIndex = array_search($row['month'], $months);
  if ($monthIndex !== false) {
      $totalProjects[$monthIndex] = $row['total_projects'];
  }
}

// Fill data for completed projects
foreach ($completedProjectsResult as $row) {
  $monthIndex = array_search($row['month'], $months);
  if ($monthIndex !== false) {
      $completedProjects[$monthIndex] = $row['completed_projects'];
  }
}


// Fetch employee details
$query = "
SELECT e.*, d.*
FROM 
  employees e
LEFT JOIN 
  department d ON d.department_id = e.department_id  
WHERE e.employee_id = :employee_id";
$stmt = $db->prepare($query);
$stmt->execute(['employee_id' => $employee_id]);
$employee = $stmt->fetch(PDO::FETCH_ASSOC);

// Fetch completed projects for the employee
$queryProjects = "
    SELECT 
        
        cp.completed_date as execution_date,
        r.project_name,
        cpt.*
    FROM 
        requests r
    LEFT JOIN 
        projects p ON p.request_id = r.request_id
    LEFT JOIN 
        completed_project cp ON cp.request_id = r.request_id
    LEFT JOIN 
        completed_project_team cpt ON cp.completed_id = cpt.completed_id
    LEFT JOIN 
        employees e ON cpt.employee_id = e.employee_id        
    WHERE 
        cpt.employee_id = :employee_id
    ORDER BY execution_date DESC    
       
        ";

$stmtProjects = $db->prepare($queryProjects);
$stmtProjects->execute(['employee_id' => $employee_id]);
$projects = $stmtProjects->fetchAll(PDO::FETCH_ASSOC);


// Fetch completed projects for the employee
$queryProjects = "
    SELECT r.project_name, cp.completed_date
    FROM 
      requests r
    INNER JOIN 
      projects p ON p.request_id = r.request_id
    INNER JOIN 
      completed_project cp ON cp.request_id = r.request_id
";
$stmtProjects = $db->prepare($queryProjects);
$stmtProjects->execute();
$projectResults = $stmtProjects->fetchAll(PDO::FETCH_ASSOC);

// Query to count completed projects
$countQuery = "
    SELECT COUNT(cp.completed_id) AS completed_project_count
    FROM 
      completed_project cp
";
$countStmt = $db->prepare($countQuery);
$countStmt->execute();

// Fetch the count
$countResult = $countStmt->fetch(PDO::FETCH_ASSOC);
$completedProjectCount = isset($countResult['completed_project_count']) ? $countResult['completed_project_count'] : 0;

$querydept=$db->prepare('SELECT * FROM department');
$querydept->execute();
$departments = $querydept->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/logo-court.jpg">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">
<!-- Vendor CSS Files -->
<link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
<link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
<link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
<link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
<link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">

  <title>
    Dream Bridge Management System
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/soft-ui-dashboard.css?v=1.0.7" rel="stylesheet" />
 
</head>
<style>
  .bi-person-circle{
    font-size: 5rem;
    margin-right: 10px;
    margin-left: 10px;
    color: gray;
  }
</style>
<body class="g-sidenav-show  bg-gray-100">
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="dashboard.php" target="_blank">
        <img src="../assets/img/logo-court.jpg" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold">Management System</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div style="height: 100vh;"  class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="../pages/dashboard.php">
            <i class="bi bi-grid-fill icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center"></i>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="../pages/project-requests.php">
            <i class="bi bi-file-earmark-arrow-down-fill icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center"></i>
            <span class="nav-link-text ms-1 ">Project Requests</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="../pages/employees.php">
            <i class="bi bi-person-video2 icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center"></i>
            <span class="nav-link-text ms-1 active">Employees Management</span>
          </a> 
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../pages/archive.php">
            <i class="bi bi-file-earmark-zip-fill icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center"></i>
            <span class="nav-link-text ms-1">Archive Management</span>
          </a>
        </li>
        
        
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account pages</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../pages/profile.php">
            <i class="bi bi-person-circle icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center"></i>
            <span class="nav-link-text ms-1">Profile</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link  " href="../pages/sign-in.html">
            <i class="bi bi-box-arrow-right icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center"></i>
            <span class="nav-link-text ms-1">Sign out</span>
          </a>
        </li>
      </ul>
    </div>
    
  </aside>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">CMS</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>
          </ol>
          
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            
          </div>
          <ul class="navbar-nav  justify-content-end">
            
            <li class="nav-item d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body font-weight-bold px-0">
                <i class="fa fa-user me-sm-1"></i>
                <span class="d-sm-inline d-none">Sign out</span>
              </a>
            </li>
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </a>
            </li>
            <li class="nav-item px-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0">
                <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
              </a>
            </li>          
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid">
      <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('../assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
        <span class="mask bg-gradient-primary opacity-6"></span>
      </div>
      <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
        <div class="row gx-4">
          <div class="col-auto">
            <div class="avatar avatar-xl  position-relative">
              <?= !empty($employee['profile']) ? "<img src='../assets/img/employee_profiles/{$employee['profile']}' class='w-100 border-radius-lg shadow-sm' alt='user1' >" : '<i class="bi bi-person-circle"></i>' ?>
            </div>
          </div>
          <div class="col-auto my-auto">
            <div class="h-100">
              <h5 class="mb-1">
                <?=$employee['username']?>
              </h5>
              <p class="mb-0 font-weight-bold text-sm">
                <?=$employee['position']?>
              </p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
            <div class="nav-wrapper position-relative end-0">
              <ul class="nav nav-pills nav-fill p-1 bg-transparent" role="tablist">
                <li class="nav-item">
                  <a class="nav-link mb-0 px-0 py-1 active " data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="true">
                    <svg class="text-dark" width="16px" height="16px" viewBox="0 0 42 42" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <g transform="translate(-2319.000000, -291.000000)" fill="#FFFFFF" fill-rule="nonzero">
                          <g transform="translate(1716.000000, 291.000000)">
                            <g transform="translate(603.000000, 0.000000)">
                              <path class="color-background" d="M22.7597136,19.3090182 L38.8987031,11.2395234 C39.3926816,10.9925342 39.592906,10.3918611 39.3459167,9.89788265 C39.249157,9.70436312 39.0922432,9.5474453 38.8987261,9.45068056 L20.2741875,0.1378125 L20.2741875,0.1378125 C19.905375,-0.04725 19.469625,-0.04725 19.0995,0.1378125 L3.1011696,8.13815822 C2.60720568,8.38517662 2.40701679,8.98586148 2.6540352,9.4798254 C2.75080129,9.67332903 2.90771305,9.83023153 3.10122239,9.9269862 L21.8652864,19.3090182 C22.1468139,19.4497819 22.4781861,19.4497819 22.7597136,19.3090182 Z">
                              </path>
                              <path class="color-background" d="M23.625,22.429159 L23.625,39.8805372 C23.625,40.4328219 24.0727153,40.8805372 24.625,40.8805372 C24.7802551,40.8805372 24.9333778,40.8443874 25.0722402,40.7749511 L41.2741875,32.673375 L41.2741875,32.673375 C41.719125,32.4515625 42,31.9974375 42,31.5 L42,14.241659 C42,13.6893742 41.5522847,13.241659 41,13.241659 C40.8447549,13.241659 40.6916418,13.2778041 40.5527864,13.3472318 L24.1777864,21.5347318 C23.8390024,21.7041238 23.625,22.0503869 23.625,22.429159 Z" opacity="0.7"></path>
                              <path class="color-background" d="M20.4472136,21.5347318 L1.4472136,12.0347318 C0.953235098,11.7877425 0.352562058,11.9879669 0.105572809,12.4819454 C0.0361450918,12.6208008 6.47121774e-16,12.7739139 0,12.929159 L0,30.1875 L0,30.1875 C0,30.6849375 0.280875,31.1390625 0.7258125,31.3621875 L19.5528096,40.7750766 C20.0467945,41.0220531 20.6474623,40.8218132 20.8944388,40.3278283 C20.963859,40.1889789 21,40.0358742 21,39.8806379 L21,22.429159 C21,22.0503869 20.7859976,21.7041238 20.4472136,21.5347318 Z" opacity="0.7"></path>
                            </g>
                          </g>
                        </g>
                      </g>
                    </svg>
                    <span class="ms-1"><?=$employee['department_name']?></span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link mb-0 px-0 py-1 " data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="false">
                    <svg class="text-dark" width="16px" height="16px" viewBox="0 0 40 44" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                      <title><?=$employee['username']?></title>
                      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <g transform="translate(-1870.000000, -591.000000)" fill="#FFFFFF" fill-rule="nonzero">
                          <g transform="translate(1716.000000, 291.000000)">
                            <g transform="translate(154.000000, 300.000000)">
                              <path class="color-background" d="M40,40 L36.3636364,40 L36.3636364,3.63636364 L5.45454545,3.63636364 L5.45454545,0 L38.1818182,0 C39.1854545,0 40,0.814545455 40,1.81818182 L40,40 Z" opacity="0.603585379"></path>
                              <path class="color-background" d="M30.9090909,7.27272727 L1.81818182,7.27272727 C0.814545455,7.27272727 0,8.08727273 0,9.09090909 L0,41.8181818 C0,42.8218182 0.814545455,43.6363636 1.81818182,43.6363636 L30.9090909,43.6363636 C31.9127273,43.6363636 32.7272727,42.8218182 32.7272727,41.8181818 L32.7272727,9.09090909 C32.7272727,8.08727273 31.9127273,7.27272727 30.9090909,7.27272727 Z M18.1818182,34.5454545 L7.27272727,34.5454545 L7.27272727,30.9090909 L18.1818182,30.9090909 L18.1818182,34.5454545 Z M25.4545455,27.2727273 L7.27272727,27.2727273 L7.27272727,23.6363636 L25.4545455,23.6363636 L25.4545455,27.2727273 Z M25.4545455,20 L7.27272727,20 L7.27272727,16.3636364 L25.4545455,16.3636364 L25.4545455,20 Z">
                              </path>
                            </g>
                          </g>
                        </g>
                      </g>
                    </svg>
                    <span class="ms-1"><?=$employee['position']?></span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link mb-0 px-0 py-1 " data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="false">
                    <svg class="text-dark" width="16px" height="16px" viewBox="0 0 40 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                      <title>settings</title>
                      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <g transform="translate(-2020.000000, -442.000000)" fill="#FFFFFF" fill-rule="nonzero">
                          <g transform="translate(1716.000000, 291.000000)">
                            <g transform="translate(304.000000, 151.000000)">
                              <polygon class="color-background" opacity="0.596981957" points="18.0883333 15.7316667 11.1783333 8.82166667 13.3333333 6.66666667 6.66666667 0 0 6.66666667 6.66666667 13.3333333 8.82166667 11.1783333 15.315 17.6716667">
                              </polygon>
                              <path class="color-background" d="M31.5666667,23.2333333 C31.0516667,23.2933333 30.53,23.3333333 30,23.3333333 C29.4916667,23.3333333 28.9866667,23.3033333 28.48,23.245 L22.4116667,30.7433333 L29.9416667,38.2733333 C32.2433333,40.575 35.9733333,40.575 38.275,38.2733333 L38.275,38.2733333 C40.5766667,35.9716667 40.5766667,32.2416667 38.275,29.94 L31.5666667,23.2333333 Z" opacity="0.596981957"></path>
                              <path class="color-background" d="M33.785,11.285 L28.715,6.215 L34.0616667,0.868333333 C32.82,0.315 31.4483333,0 30,0 C24.4766667,0 20,4.47666667 20,10 C20,10.99 20.1483333,11.9433333 20.4166667,12.8466667 L2.435,27.3966667 C0.95,28.7083333 0.0633333333,30.595 0.00333333333,32.5733333 C-0.0583333333,34.5533333 0.71,36.4916667 2.11,37.89 C3.47,39.2516667 5.27833333,40 7.20166667,40 C9.26666667,40 11.2366667,39.1133333 12.6033333,37.565 L27.1533333,19.5833333 C28.0566667,19.8516667 29.01,20 30,20 C35.5233333,20 40,15.5233333 40,10 C40,8.55166667 39.685,7.18 39.1316667,5.93666667 L33.785,11.285 Z">
                              </path>
                            </g>
                          </g>
                        </g>
                      </g>
                    </svg>
                    <span class="ms-1"><?=$employee['employee_id']?></span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid py-4">
    <div class="row">
        <!-- Employee Information Card -->
        <div class="col-12 col-xl-4">
        <div class="card h-100">
            <div class="card-header pb-0 p-3">
                <h6 class="mb-0">Employee Information</h6>
            </div>
            <div class="card-body p-3">
                <form action="../../controllers/update_employee.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="employee_id" value="<?= htmlspecialchars($employee_id) ?>">

                    <div class="mb-3">
                        <label for="employeeName" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="employeeName" name="employeeName" value="<?php echo htmlspecialchars($employee['username']); ?>">
                    </div>

                    <div class="mb-3">
                        <label for="position" class="form-label">Position</label>
                        <input type="text" class="form-control" id="position" name="position" value="<?php echo htmlspecialchars($employee['position']); ?>">
                    </div>

                    <div class="mb-3">
                        <label for="department" class="form-label">Department</label><br>
                        <select class="form-control" name="department" id="">
                            <option value="<?= htmlspecialchars($employee['department_id']) ?>"><?= htmlspecialchars($employee['department_name']) ?></option>
                            <?php foreach ($departments as $department): ?>
                                <option value="<?= htmlspecialchars($department['department_id']) ?>" <?= $department['department_id'] == $employee['department_id'] ? 'selected' : '' ?>><?= htmlspecialchars($department['department_name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="birthdate" class="form-label">Birthdate</label>
                        <input type="date" class="form-control" id="birthdate" name="birthdate" value="<?php echo htmlspecialchars($employee['dob']); ?>">
                    </div>

                    <div class="mb-3">
                        <label for="contact" class="form-label">Contact Information</label>
                        <input type="text" class="form-control" id="contact" name="contact" value="<?php echo htmlspecialchars($employee['phone']); ?>">
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" value="<?php echo htmlspecialchars($employee['address']); ?>">
                    </div>

                    <div class="mb-3">
                        <label for="startDate" class="form-label">Start Date</label>
                        <input type="date" class="form-control" id="startDate" name="startDate" value="<?php echo htmlspecialchars($employee['start_date']); ?>">
                    </div>

                    <div class="mb-3">
                        <label for="salary" class="form-label">Salary</label>
                        <input type="number" class="form-control" id="salary" name="salary" value="<?php echo htmlspecialchars($employee['salary']); ?>">
                    </div>

                    <div class="mb-3">
                        <label for="cv" class="form-label">CV</label>
                        <input type="file" class="form-control" id="cv" name="uploadcv">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>

                    <div class="mb-3">
                        <label for="notes" class="form-label">Notes</label>
                        <textarea class="form-control" id="notes" name="notes" rows="3"><?php echo htmlspecialchars($employee['note']); ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="profile" class="form-label">Profile photo</label>
                        <input type="file" class="form-control" id="profile" name="uploadfile">
                    </div>

                    <button type="submit" class="btn btn-secondary">Save Modifications</button>
                </form>
            </div>
        </div>
    </div>


        <!-- Projects Summary Card -->
        <div class="col-12 col-xl-4">
            <div class="card h-100">
                <div class="card-header pb-0 p-3">
                    <h6 class="mb-0">Projects Summary</h6>
                </div>
                <div class="card-body p-3">
                    <p class="text-sm"><strong>Number of Projects Completed:</strong> <span class="badge badge-sm btn btn-success"><?= $completedProjectCount ?></span> </p>
                    <hr class="horizontal gray-light my-4">
                    <h6 class="mb-0">Completed Projects</h6>
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Project</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Execution Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                  if (!empty($projectResults)) {
                                    foreach ($projectResults as $project_completed) {
                                        ?>
                                        <tr>
                                            <td>
                                                <a href="detail-project.html" class="text-xs font-weight-bold">
                                                    <?php echo htmlspecialchars($project_completed['project_name']); ?>
                                                </a>
                                            </td>
                                            <td class="text-xs">
                                                <?php echo htmlspecialchars($project_completed['completed_date']); ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    // Optionally handle the case where no projects are found
                                    echo "<tr><td colspan='2'>No completed projects found.</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <?php
                        
                        $query = "SELECT * FROM off_employees WHERE employee_id = :employee_id";
                        $stmt = $db->prepare($query);
                        $stmt->execute(['employee_id' => $employee_id]);
                        $off_employee = $stmt->fetch(PDO::FETCH_ASSOC);

                        $current_date = date('Y-m-d');

                        if ($off_employee) {
                            if ($off_employee['end_date'] < $current_date) {
                                // Day off has expired, automatically delete the record
                                $delete_query = "DELETE FROM off_employees WHERE employee_id = :employee_id";
                                $delete_stmt = $db->prepare($delete_query);
                                $delete_stmt->execute(['employee_id' => $employee_id]);

                              
                                echo "<div class='alert alert-success'>Employee's day off record has been automatically deleted as the period has ended.</div>";
                            } else {
                                ?>
                                  <div class="card-body p-3">
                                      <h6>Modify Day Off</h6>
                                      <form action="../../controllers/update_day_off.php" method="post">
                                          <input type="hidden" name="employee_id" value="<?= $employee_id ?>">
                                        
                                          <div class="mb-3">
                                              <label for="start" class="form-label">Start Date</label>
                                              <input type="text" class="form-control" id="start" name="start" value="<?=$off_employee['start_date']?>">
                                          </div>
                                          
                                          <div class="mb-3">
                                              <label for="end" class="form-label">End Date</label>
                                              <input type="text" class="form-control" id="end" name="end" value="<?= $off_employee['end_date'] ?>">
                                          </div>
                                          
                                          <button type="submit" class="btn btn-secondary">Update</button>
                                      </form>
                                  </div>


                                <?php
                            }
                        } else {
                            // Employee does not have a day off, display form to register a new day off
                            ?>
                            <div class="card-body p-3">
                                <h6>Grant Off to <?=$employee['username']?></h6>
                                <form action="../../controllers/insert_day_off.php" method="post">
                                    <input type="hidden" name="employee_id" value="<?= $employee_id ?>">
                                    <div class="mb-3">
                                        <label for="start" class="form-label">Start Date</label>
                                        <input type="date" class="form-control" id="start" name="start">
                                    </div>
                                    <div class="mb-3">
                                        <label for="end" class="form-label">End Date</label>
                                        <input type="date" class="form-control" id="end" name="end">
                                    </div>
                                    <button type="submit" class="btn btn-secondary">Save</button>
                                </form>
                            </div>
                            <?php
                        }
                        ?>


                </div>
            </div>
            
        </div>

          <!-- Employee Performance Card -->
          <div class="col-12 col-xl-4">
            <div class="card h-100">
                <div class="card-header pb-0 p-3">
                    <h6 class="mb-0">Employee Performance</h6>
                </div>
                <div class="card-body p-3 overflow-container">
                    <div class="chart-container">
                        <canvas id="performanceChart" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>


    <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var ctx = document.getElementById('performanceChart').getContext('2d');
        var performanceChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?= json_encode($months); ?>,
                datasets: [
                    {
                        label: 'Projects Got',
                        data: <?= json_encode($totalProjects); ?>,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        fill: true,
                    },
                    {
                        label: 'Projects Completed',
                        data: <?= json_encode($completedProjects); ?>,
                        borderColor: 'rgba(153, 102, 255, 1)',
                        backgroundColor: 'rgba(153, 102, 255, 0.2)',
                        fill: true,
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
    </script>
    <div class="container-fluid py-4">
    <!-- Other sections ... -->

    <!-- Projects with status buttons -->
    <div class="col-12 col-xl-8">
        <div class="card h-100">
            <div class="card-header pb-0 p-3">
                <h6 class="mb-0">Evaluate employee for the project he got</h6>
            </div>
            <div class="card-body p-3">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Project</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Execution Date</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Status</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($projects)) {
                                foreach ($projects as $project) {
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo htmlspecialchars($project['project_name']); ?>
                                        </td>
                                        <td>
                                            <?php echo htmlspecialchars($project['execution_date']); ?>
                                        </td>
                                        <td>
                                            <span class="badge badge-sm <?= $project['status'] === 'completed' ? 'text-success' : 'text-danger'?>">
                                                <?php echo htmlspecialchars($project['status']); ?>
                                            </span>
                                        </td>
                                        <td>
                                            <form method="post" action="../../controllers/update_project_status.php">
                                                <input type="hidden" name="team_id" value="<?php echo $project['team_id']; ?>">
                                                <input type="hidden" name="employee_id" value="<?= $employee_id ?>">
                                                <button type="submit" name="status" value="completed" class="btn btn-success btn-sm">Completed</button>
                                                <button type="submit" name="status" value="not completed" class="btn btn-danger btn-sm">Not Completed</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                echo "<tr><td colspan='4'>There is no completed projects that this employee has participated in</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

      </div>
      <footer class="footer pt-3  ">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
              <div class="copyright text-center text-sm text-muted text-lg-start">
                © <script>
                  document.write(new Date().getFullYear())
                </script>,
                Developed with ❤️ and ☕ by <i class="fa fa-heart"></i> by
                <a href="https://nguvutech.com" class="font-weight-bold" target="_blank">NGUVU TECH</a>
                for a better web.
              </div>
            </div>
            <div class="col-lg-6">
              <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                <li class="nav-item">
                  <a href="##" class="nav-link text-muted" target="_blank">Website</a>
                </li>
                <li class="nav-item">
                  <a href="##" class="nav-link text-muted fixed-plugin-button">F.A.Q</a>
                </li>
                <li class="nav-item">
                  <a href="##" class="nav-link text-muted" target="_blank">&copy; Copyright <strong><span>Dream Bridge Consultants Ltd.</span></strong>. All Rights Reserved</a>
                </li>
                
              </ul>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </main>
 
  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/chartjs.min.js"></script>
 
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- DataTables initialization script -->
   <script>
    const datatables = select('.datatable', true)
  datatables.forEach(datatable => {
    new simpleDatatables.DataTable(datatable, {
      perPageSelect: [5, 10, 15, ["All", -1]],
      columns: [{
          select: 2,
          sortSequence: ["desc", "asc"]
        },
        {
          select: 3,
          sortSequence: ["desc"]
        },
        {
          select: 4,
          cellClass: "green",
          headerClass: "red"
        }
      ]
    });
  })
   </script>
 
   

  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>

  <script src="../assets/js/soft-ui-dashboard.min.js?v=1.0.7"></script>
  <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
  <!-- Vendor JS Files -->
  <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/chart.js/chart.umd.js"></script>
  <script src="../assets/vendor/echarts/echarts.min.js"></script>
  <script src="../assets/vendor/quill/quill.min.js"></script>
  <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>
</body>

</html>