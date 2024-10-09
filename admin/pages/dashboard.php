<?php 
  require('../../controllers/dashboardController.php');

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

<body class="g-sidenav-show  bg-gray-100">
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="dashboard.html" target="_blank">
        <img src="../assets/img/logo-court.jpg" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold">Management System</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div style="height:100vh" class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link  active" href="../pages/dashboard.php">
            <i class="bi bi-grid-fill"></i>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link  " href="../pages/project-requests.php">
            <i class="bi bi-file-earmark-arrow-down-fill icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center"></i>
            <span class="nav-link-text ms-1">Project Requests</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link  " href="../pages/employees.php">
            <i class="bi bi-person-video2 icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center"></i>
            <span class="nav-link-text ms-1">Employees Management</span>
          </a> 
        </li>
        <li class="nav-item">
          <a class="nav-link  " href="../pages/archive.php">
            <i class="bi bi-file-earmark-zip-fill icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center"></i>
            <span class="nav-link-text ms-1">Archive Management</span>
          </a>
        </li>
        
        
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account pages</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link  " href="../pages/profile.php">
            <i class="bi bi-person-circle icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center"></i>
            <span class="nav-link-text ms-1">Profile</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link  " href="../pages/sign-in.php">
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
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Ongoing projects</p>
                    <h5 class="font-weight-bolder mb-0">
                      <?php echo $ongoing_projects; ?>
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-primary shadow text-center border-radius-md">
                    <i class="bi bi-clipboard-minus-fill text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Completed projects</p>
                    <h5 class="font-weight-bolder mb-0">
                      <?php echo $completed_project; ?>
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-success shadow text-center border-radius-md">
                    <i class="bi bi-clipboard-check-fill text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">New Clients</p>
                    <h5 class="font-weight-bolder mb-0">
                      <?php echo $unassigned_requests; ?>
                      <span class="text-danger text-sm font-weight-bold">Not assigned</span>
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-warning shadow text-center border-radius-md">
                    <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Rejeted projects</p>
                    <h5 class="font-weight-bolder mb-0">
                      <?php echo $rejected_projects; ?>
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-danger shadow text-center border-radius-md">
                    <i class="bi bi-clipboard-x-fill text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <br>
      <div>
        <div class="row">
          <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
              <div class="card-body p-3">
                <div class="row">
                  <div class="col-8">
                    <div class="numbers">
                      <p class="text-sm mb-0 text-capitalize font-weight-bold">Total employees</p>
                      <h5 class="font-weight-bolder mb-0">
                        <?php echo $total_employees; ?>
                      </h5>
                    </div>
                  </div>
                  <div class="col-4 text-end">
                    <div class="icon icon-shape bg-primary shadow text-center border-radius-md">
                      <i class="bi bi-people-fill text-lg opacity-10" aria-hidden="true"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
              <div class="card-body p-3">
                <div class="row">
                  <div class="col-8">
                    <div class="numbers">
                      <p class="text-sm mb-0 text-capitalize font-weight-bold">Free employees</p>
                      <h5 class="font-weight-bolder mb-0">
                        <?php echo $free_employees; ?>
                      </h5>
                    </div>
                  </div>
                  <div class="col-4 text-end">
                    <div class="icon icon-shape bg-success shadow text-center border-radius-md">
                      <i class="bi bi-person-fill-check text-lg opacity-10" aria-hidden="true"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
              <div class="card-body p-3">
                <div class="row">
                  <div class="col-8">
                    <div class="numbers">
                      <p class="text-sm mb-0 text-capitalize font-weight-bold">Off employees</p>
                      <h5 class="font-weight-bolder mb-0">
                        <?php echo $off_employees; ?>
                      </h5>
                    </div>
                  </div>
                  <div class="col-4 text-end">
                    <div class="icon icon-shape bg-danger shadow text-center border-radius-md">
                      <i class="bi bi-person-fill-exclamation text-lg opacity-10" aria-hidden="true"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
        </div>
      </div>
    <!---------------------------Project block--------------------------------------------------------------------------------->
    
      <div class="row mt-4">
      
        <div class="col-lg-7 mb-lg-0 mb-4">
        <div class="card">
          <div class="card-body p-3">
              <div class="row">
                  <div class="col-lg-6">
                      <div class="d-flex flex-column h-100">
                          <p class="mb-1 pt-2 text-bold">Latest successful project</p>
                          <?php if ($latestProject): ?>
                              <h6 style="margin-bottom: 15px;" class="font-weight-bolder">
                                  <?= htmlspecialchars($latestProject['project_name']); ?>
                              </h6>
                              <p class="mb-5">
                                  <?= htmlspecialchars($latestProject['service_details']); ?>
                              </p>
                              <a class="text-body text-sm font-weight-bold mb-0 icon-move-right mt-auto" href="detail-project.php?request_id=<?php echo $latestProject['request_id']; ?>">
                                  View the proposal
                                  <i class="bi bi-arrow-right text-sm ms-1" aria-hidden="true"></i>
                              </a>
                            <?php else: ?>
                              <h6 style="margin-bottom: 15px;" class="font-weight-bolder">No completed project yet</h6>
                              <p class="mb-5">
                                  We are working on new projects which is not completed yet!
                              </p>
                            <?php endif; ?>
                      </div>
                  </div>
                  <div class="col-lg-5 ms-auto text-center mt-5 mt-lg-0">
                      <div class="border-radius-lg h-100">
                          <div class="position-relative d-flex align-items-center justify-content-center h-100">
                              <img class="w-100 position-relative z-index-2 pt-4" 
                                  src="../assets/img/<?= $latestProject ? htmlspecialchars($latestProject['project_image']) : 'no_project.gif'; ?>" 
                                  alt="<?= $latestProject ? 'Project Image' : 'No Project'; ?>">
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
        </div>
        <div class="col-lg-5">
          <div class="card h-100 p-3">
            <div class="overflow-hidden position-relative border-radius-lg bg-cover h-100" style="background-image: url('../assets/img/<?php echo $project_image; ?>');">
              <span class="mask bg-gradient-dark"></span>
              <div class="card-body position-relative z-index-1 d-flex flex-column h-100 p-3">
                <p>Last ongoing project</p>
                <h5 class="text-white font-weight-bolder mb-4 pt-2"><?=! empty($project_name)?$project_name:'No project that is ongoing'  ?></h5>
                <p class="text-white"><?php echo htmlspecialchars($service_details); ?></p>
                <a class="text-white text-sm font-weight-bold mb-0 icon-move-right mt-auto" href="detail-project.php?request_id=<?php echo $request_id; ?>">
                  Read the project
                  <i class="bi-arrow-right text-sm ms-1" aria-hidden="true"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
        
      </div>
      <div class="row my-4">
        <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
          <div class="card">
            <div class="card-header pb-0">
              <div class="row">
                <div class="col-lg-6 col-7">
                  <h6>Projects <span class="font-weight-lighter ms-1">| All</span></h6>
                  <p class="text-sm mb-0">
                    <i class="fa fa-check text-info" aria-hidden="true"></i>
                    <span class="font-weight-bold ms-1"><?php echo $completed_project; ?></span> done over all
                  </p>
                </div>
                
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive">
              <table class="table table-borderless datatable">
                  <thead>
                    <tr>
                      <th scope="col" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                      <th scope="col" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Clients / Companies</th>
                      <th scope="col" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Employees assigned</th>
                      <th scope="col" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Budget</th>
                      <th scope="col" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Completion</th>
                      <th scope="col" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php foreach ($requests as $project): ?>
                    <tr>
                        <td scope="row"><a href="detail-project.php?request_id=<?= $project['request_id'] ?>">#<?= $project['request_id'] ?></a></td>
                        <td>
                            <div class="d-flex px-2 py-1">
                                <div>
                                    <img src="../assets/img/project_images/<?= $project['project_image'] ?>" width="30px" height="30px" style='border-radius:3px;margin-right:20px'>
                                </div>
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm"><?= $project['project_name'] ?></h6>
                                </div>
                            </div>
                        </td>
                        <td>
                          <div class="avatar-group mt-2">
                              <?php
                              // Split the concatenated employee profiles, names, and ids
                              $employee_profiles = explode(',', $project['employee_profiles']);
                              $employee_names = explode(',', $project['employee_names']);
                              $employee_ids = explode(',', $project['employee_ids']);

                              // Check if there are no employees assigned
                              if (empty($project['employee_profiles']) || empty(array_filter($employee_profiles))) {
                                  if($project['project_status'] =='completed'){
                                    ?><p style="color: gray; font-size:14px"><?='Project done'?></p><?php
                                  }else{
                                    ?><p style="color: gray; font-size:14px"><?='Not assigned'?></p><?php
                                  }
                              } else {
                                  // Loop through each employee and display their profile image, name, and link
                                  foreach ($employee_profiles as $index => $profile): ?>
                                      <a href="detail-employee.php?employee_id=<?= $employee_ids[$index] ?>" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?= $employee_names[$index] ?>">
                                          <img src="../assets/img/employee_profiles/<?= $profile ?>" alt="<?= $employee_names[$index] ?>">
                                      </a>
                                  <?php endforeach;
                              }
                              ?>
                          </div>
                      </td>

                        <td class="align-middle text-center text-sm">
                            <span class="text-xs font-weight-bold"> $<?= $project['amount'] ?> </span>
                        </td>
                        <td class="align-middle">
                          <?php 
                          // Check if completed_goals and goals_number are set and goals_number is greater than zero
                          if (isset($project['completed_goals'], $project['goals_number']) && $project['goals_number'] > 0) {
                              $progress = ($project['completed_goals'] * 100) / $project['goals_number'];
                          } else {
                              $progress = 0; // Fallback to 0% if conditions are not met
                          }

                          // Determine the background color class based on the progress percentage
                          if ($progress == 0) {
                              $progressBarClass = 'bg-gradient-danger';
                          } elseif ($progress >= 1 && $progress <= 19) {
                              $progressBarClass = 'bg-gradient-danger';
                          } elseif ($progress >= 20 && $progress <= 49) {
                              $progressBarClass = 'bg-gradient-warning';
                          } elseif ($progress >= 50 && $progress <= 89) {
                              $progressBarClass = 'bg-gradient-info';
                          } else {
                              $progressBarClass = 'bg-gradient-success';
                          }
                          ?>
                          <div class="progress-wrapper w-75 mx-auto">
                              <div class="progress-info">
                                  <div class="progress-percentage">
                                      <span class="text-xs font-weight-bold"><?= round($progress, 0) ?>%</span>
                                  </div>
                              </div>
                              <div class="progress">
                                  <div class="progress-bar <?= $progressBarClass ?>" role="progressbar" style="width: <?= $progress ?>%;" aria-valuenow="<?= $progress ?>" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                          </div>
                      </td>

                        <td class="align-middle text-center text-sm">
                        <span class="badge btn 
                            <?= ($project['project_status'] == 'completed') ? 'bg-success' :
                                (($project['project_status'] == '') ? 'bg-danger' :  
                                (($project['project_status'] == 'Assigned') ? 'bg-success' :
                                (($project['project_status'] == 'Rejected') ? 'bg-danger' : 'bg-warning'))); ?>">
                            <?=  !empty($project['project_status'])? $project['project_status'] : 'NOT ASSIGNED'?>
                        </span>
                        </td>
                    </tr>


                  <?php endforeach; ?>

                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="card h-100">
            <div class="card-header pb-0">
              <h6>10 latest client requests</h6>
              <p class="text-sm">
                <i class="fa fa-arrow-up text-success" aria-hidden="true"></i>
                <span class="font-weight-bold">3</span> this month
              </p>
            </div>
            <div class="card-body p-3">
              <div class="timeline timeline-one-side">
                <?php foreach ($latest_requests as $request): ?>
                  <div class="timeline-block mb-3">
                      <span class="timeline-step">
                          <i class="ni ni-bell-55 text-success text-gradient"></i>
                      </span>
                      <div class="timeline-content">
                          <h6 class="text-dark text-sm font-weight-bold mb-0"><?php echo htmlspecialchars($request['project_name']); ?></h6>
                          <p class="text-secondary font-weight-bold text-xs mt-1 mb-0"><?php echo date('d M Y h:i A', strtotime($request['request_date'])); ?></p>
                      </div>
                  </div>
                  <?php endforeach; ?>
                </div>
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
  <script>
    // Ensure tooltips are enabled for dynamically created elements
    $(document).ready(function () {
        // Initialize Bootstrap tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        // Reinitialize tooltips after the page has dynamically rendered the avatars
        $('body').tooltip({
            selector: '[data-bs-toggle="tooltip"]'
        });
    });
   </script>
</body>

</html>