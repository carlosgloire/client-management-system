<?php
  require('../../controllers/profileController.php');
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
    <div style="height:100vh"class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
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
            <span class="nav-link-text ms-1">Project Requests</span>
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
          <a class="nav-link  active" href="../pages/profile.html">
            <i class="bi bi-person-circle"></i>
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
    <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('../assets/img/employee_profiles/<?= htmlspecialchars($admin['cover_image']) ?>'); background-position-y: 50%;">
        <span class="mask bg-gradient-primary opacity-6"></span>
      </div>
      <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
        <div class="row gx-4">
          <div class="col-auto">
            <div class="avatar avatar-xl position-relative">
            <img src="../assets/img/employee_profiles/<?= htmlspecialchars($admin['profile']) ?>" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
            </div>
          </div>
          <div class="col-auto my-auto">
            <div class="h-100">
              <h5 class="mb-1">
                <?= htmlspecialchars($admin['username']) ?>
              </h5>
              <p class="mb-0 font-weight-bold text-sm">
                <?= htmlspecialchars($admin['position']) ?>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid py-4">
      <div style="width:100%" class="row">
        <div style="width:50%" class="col-12 col-xl-4">
          <div class="card h-100">
            <div class="card-header pb-0 p-3">
              <div class="row">
                <div class="col-md-8 d-flex align-items-center">
                  <h6 class="mb-0">My Profile Informations</h6>
                </div>
              </div>
            </div>
            <div class="card-body p-3">
              <p class="text-sm">
                Your profile settings are displayed on this page. You can edit your information on the right. Please note, before making any changes to your personal details below, you must enter your current password for verification.
              </p>
              <hr class="horizontal gray-light my-4">
              <ul class="list-group">
                <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Full Name:</strong> &nbsp; <?= htmlspecialchars($admin['username']) ?></li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email:</strong> &nbsp; <?= htmlentities($admin['email'])?></li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Phone number:</strong> &nbsp; <?= htmlspecialchars($admin['phone_number'])?></li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Position:</strong> &nbsp; <?= htmlentities($admin['position'])?></li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Location:</strong> &nbsp; <?= htmlspecialchars($admin['location'])?></li>
              </ul>
            </div>
          </div>
        </div>
        <div style="width:50%" class="col-12 col-xl-4">
          <div class="card h-100">
              <div class="card-header pb-0 p-3">
                  <h6 class="mb-0">Edit My informations</h6>
              </div>
              <div class="card-body p-3">
              <form method="POST" enctype="multipart/form-data">
                  <?php if(isset($msg)) { echo '<font color="red">'.$msg."</font>"; } ?>
                      <div class="mb-3">
                          <label for="employeeName" class="form-label">Full Name</label>
                          <input type="text" name="newusername" class="form-control" id="employeeName" value="<?= htmlspecialchars($admin['username']) ?>">
                      </div>
                      <div class="mb-3">
                          <label for="employeeName" class="form-label">Email</label>
                          <input type="text" name="newemail" class="form-control" id="employeeName" value="<?=htmlspecialchars($admin['email'])?>">
                      </div>
                      <div class="mb-3">
                          <label for="employeeName" class="form-label">Phone Number</label>
                          <input type="text" name="newnumber" class="form-control" id="employeeName" value="<?= htmlspecialchars($admin['phone_number']) ?>">
                      </div>
                      <div class="mb-3">
                          <label for="employeeName" class="form-label">Profile</label>
                          <input type="file" name="profile" class="form-control" id="employeeName">
                      </div>
                      <div class="mb-3">
                          <label for="employeeName" class="form-label">Cover image</label>
                          <input type="file" name="cover_image" class="form-control" id="employeeName">
                      </div>
                      <div class="mb-3">
                          <label for="position" class="form-label">Position</label>
                          <input type="text" name="newposition" class="form-control" id="position" value="<?= htmlspecialchars($admin['position']) ?>">
                      </div>
                      <div class="mb-3">
                          <label for="contact" class="form-label">Location</label>
                          <input type="text" name="newlocation" class="form-control" id="contact" value="<?= htmlspecialchars($admin['location']) ?>">
                      </div>
                      <div class="mb-3">
                          <label for="contact" class="form-label">New password</label>
                          <input type="password" name="newpassword1" class="form-control" id="contact" value="">
                      </div>
                      <div class="mb-3">
                          <label for="confirm_me" class="form-label text-success">Current Password <span class="text-danger">(Required)</span></label>
                          <input type="password" name="confirm_me" class="form-control" id="confirm_me">
                      </div>
                      <button type="submit" name="edit_infos" class="btn btn-success">Save Modifications</button>
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
</body>

</html>