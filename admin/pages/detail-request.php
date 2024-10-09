<?php
// Include the database connection
include '../../database/db.php';
require_once('../../controllers/request_details.php');

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
            <span class="nav-link-text ms-1  active">Project Requests</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="../pages/employees.php">
            <i class="bi bi-person-video2 icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center"></i>
            <span class="nav-link-text ms-1">Employees Management</span>
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
    <div class="container-fluid">
      <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('../assets/img/logo.jpg'); background-position-y: 50%;">
        <span class="mask bg-gradient-primary opacity-6"></span>
      </div>
      <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
        <div class="row gx-4">
          <div class="col-auto">
            <div class="avatar avatar-xl position-relative">
              <img src="../assets/img/client_profile/<?=$request['client_profile']?>" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
            </div>
          </div>
          <div class="col-auto my-auto">
            <div class="h-100">
              <h5 class="mb-1">
                <?=$request['client_username']?>
              </h5>
              <p class="mb-0 font-weight-bold text-sm">
                <?=$request['position']?>/<?=$request['company_name']?>
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
                    <span class="ms-1"><?=$request['project_name']?></span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link mb-0 px-0 py-1 " data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="false">
                    <svg class="text-dark" width="16px" height="16px" viewBox="0 0 40 44" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                      <title>document</title>
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
                    <span class="ms-1"><?=$request['service_category']?></span>
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
                    <span class="ms-1"><?=$request['request_id']?></span>
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
        <!-- First Block: Project Image and File Attachments -->
        <div class="col-12 col-xl-4">
          <div class="card h-100">
            <div class="card-header pb-0 p-3">
              <h6 class="mb-0">Project Image & Attachments</h6>
            </div>
            <div class="card-body p-3">
              <!-- Project Image -->
              <div class="mb-3">
                <img src="../assets/img/project_images/<?=$request['project_image']?>" alt="Project Image" class="img-fluid border-radius-lg">
              </div>
              <!-- File Attachments -->
              <div class="mt-4">
                <h6 class="text-uppercase text-body text-xs font-weight-bolder">File Attachments</h6>
                <ul class="list-group">
                  <?php
                    $query=$db->prepare('SELECT * FROM attachements WHERE request_id=?');
                    $query->execute(array($request_id));
                    $attachment_request=$query->fetchAll(PDO::FETCH_ASSOC);
                    if(!$attachment_request){
                      ?><p style="color: red;"><?='No attachments'?></p><?php
                    }else{
                      foreach($attachment_request as $attachment){
                        ?>
                          <li class="list-group-item border-0 px-0">
                            <a href="../assets/attachments/<?=$attachment['attachement']?>" download><?=$attachment['attachement']?></a>
                          </li>
                        <?php
                      }
                    }
                  ?>
                  <!-- Add more attachments as needed -->
                </ul>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Second Block: Service Request Form -->
        <div class="col-12 col-xl-4">
          <div class="card h-100">
              <!-- HTML to Display the Badge -->
              <div class="card-header pb-0 p-3">
                  <h6 class="mb-0">Service Request Form</h6>
                  <!-- Display the badge -->
                  <?= $badge_html ?>
              </div>
              <div class="card-body p-3">
                  <div class="mb-3">
                      <label for="clientName" class="form-label">Client Name</label>
                      <input type="text" class="form-control" id="clientName" value=" <?=$request['client_username']?>" readonly>
                  </div>
                  <div class="mb-3">
                      <label for="contactInfo" class="form-label">Contact Information</label>
                      <input type="text" class="form-control" id="contactInfo" value=" <?=$request['client_email']?> |  <?=$request['phone_number']?>" readonly>
                  </div>
                  <div class="mb-3">
                      <label for="serviceCategory" class="form-label">Service Category</label>
                      <select class="form-select" id="serviceCategory">
                          <option selected><?= htmlspecialchars($request['service_category']); ?></option>
                      </select>
                  </div>
                  <div class="mb-3">
                      <label for="serviceDetails" class="form-label">Service Details</label>
                      <textarea class="form-control" id="serviceDetails" rows="3" readonly><?= htmlspecialchars($request['service_details']); ?></textarea>
                  </div>
                  <div class="mb-3"> 
                      <label for="priorityLevel" class="form-label">Priority Level</label>
                      <input type="text" class="form-control" id="priorityLevel" value="<?= htmlspecialchars($request['priority_level']); ?>" readonly>
                  </div>
                  <div class="mb-3">
                      <label for="deadline" class="form-label">Deadline</label>
                      <input type="text" class="form-control" id="deadline" value="<?= htmlspecialchars(date('d/m/Y', strtotime($request['deadline']))); ?>" readonly>
                  </div>
                  <div class="mb-3">
                    <label for="amount" class="form-label">Amount in $</label>
                    <input type="text" class="form-control" id="amount" value="$<?= htmlspecialchars(number_format($request['amt'], 2)); ?>" readonly>
                </div>
                <?php
                    require_once('../../controllers/assign_pend_reject.php');
                ?>

                <div class="d-flex justify-content-between">
                    <form method="POST">
                        <input type="hidden" name="project_id" value="<?= htmlspecialchars($projects['project_id']) ?>">
                        <input type="hidden" name="request_id" value="<?= htmlspecialchars($request_id) ?>">
                        <button class="btn btn-success" name="project_status" value="Assigned">Assigned</button>
                        <button class="btn btn-warning" name="project_status" value="Pending">Pending</button>
                        <button class="btn btn-danger" name="project_status" value="Rejected">Reject</button>
                    </form>
                </div>


              </div>
          </div>
      </div>

            <!-- Third Block: Employee Assignment -->
      <!-- Third Block: Employee Assignment -->
      <div class="col-12 col-xl-4">
          <div class="card h-100">
              <div class="card-header pb-0 p-3">
                  <h6 class="mb-0">Assign Employees</h6>
              </div>
              <div class="card-body p-3">
                  <div class="mb-3">
                      <input type="text" class="form-control" id="employeeSearch" placeholder="Search by name or task count...">
                  </div>
                  <div class="table-responsive">
                      <form action="../../controllers/assign_employees.php" method="post">
                          <input type="hidden" name="project_id" value="<?= $projects['project_id'] ?>">
                          <input type="hidden" name="request_id" value="<?= $request_id?>">
                          <div style="height:50vh;overflow:auto;">
                                <table class="table table-hover align-items-center mb-0" >
                                    <thead>
                                        <tr >
                                            <th scope="col"></th>
                                            <th scope="col" style="padding-left: 0px;">Employee Name</th>
                                            <th scope="col" style="padding-left: 0px;">Tasks</th>
                                        </tr>
                                    </thead>
                                    <div>
                                    <tbody>
                                        <?php foreach ($employees as $employee): ?>
                                          <tr >
                                              <td><input type="checkbox" name="employee_ids[]" value="<?= $employee['employee_id'] ?>" class="form-check-input"></td>
                                              <td><?= htmlspecialchars($employee['username']) ?></td>
                                              <td><?= $employee['task_count'] ?></td>
                                          </tr>
                                          <?php endforeach; ?>
                                    </tbody>
                                    </div>
                                
                                </table>
                              </div>
                          <button class="btn btn-success mt-3 w-100" type="submit">Confirm Assignment</button>
                      </form>
                  </div>
              </div>
          </div>
      </div>


        <div class="col-12 mt-4">
          <div class="card mb-4">
            <div class="card-header pb-0 p-3">
                <h6 class="mb-1">Send a Message to this Client</h6>
                <p class="text-sm">Please fill in the details below to send your message.</p>
            </div>
            <div class="card-body p-3">
                <form method="POST" action="../../controllers/send_message_client.php" enctype="multipart/form-data">
                    <input type="hidden" name="client_id" value="<?= $request['client_id']; ?>">
                    <input type="hidden" name="request_id" value="<?= $request_id?>">
                    <!-- Subject Input (Optional) -->
                    <div class="mb-3">
                        <label for="subject" class="form-label">Subject (Optional)</label>
                        <input type="text" class="form-control" id="subject" name="subject" placeholder="Enter subject">
                    </div>

                    <!-- Message Textarea (Mandatory) -->
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="4" placeholder="Enter your message" ></textarea>
                    </div>

                    <!-- File Attachment Input (Optional) -->
                    <div class="mb-3">
                        <label for="file" class="form-label">Attach Files (Optional)</label>
                        <input class="form-control" type="file" id="file" name="uploadfile" multiple="">
                    </div>

                    <!-- Buttons to Send or Reset -->
                    <div class="d-flex justify-content-end">
                        <button type="reset" class="btn btn-outline-secondary me-2">Reset</button>
                        <button type="submit" name="send" class="btn btn-secondary">Send</button>
                    </div>
                </form>
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
 <script src="../../asset/js/live_search_employeesAssignment.js"></script>
</body>

</html>