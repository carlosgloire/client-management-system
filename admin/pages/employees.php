
<?php
// Include database connection file
require_once('../../database/db.php');
require_once('../../controllers/add_employees.php');
    $stmt = $db->prepare("SELECT e.employee_id, e.username, e.email, e.position, d.department_name, COUNT(a.project_id) AS num_projects, e.cv,e.profile 
              FROM employees e 
              LEFT JOIN department d ON e.department_id = d.department_id
              LEFT JOIN assignment a ON e.employee_id = a.employee_id
              GROUP BY e.employee_id");
    $stmt->execute();
    $employees = $stmt->fetchAll(PDO::FETCH_ASSOC);

   $query = $db->prepare('SELECT * FROM department');
   $query->execute();
   $departments = $query->fetchAll();
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
    font-size: 1.5rem;
    margin-right: 20px;
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
            <span class="nav-link-text ms-1">Project Requests</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link  active" href="../pages/employees.php">
            <i class="bi bi-person-video2 "></i>
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
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
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
        <div class="ms-md-auto pe-md-3 d-flex align-items-center"></div>
        <ul class="navbar-nav justify-content-end">
          <li class="nav-item d-flex align-items-center">
            <a href="logout.php" class="nav-link text-body font-weight-bold px-0">
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
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h6>Employees | all</h6>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table datatable align-items-center mb-0 table-hover table-borderless">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Employee</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Position</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Department</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Number of projects</th>
                    <th class="text-secondary opacity-7">CV</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($employees as $row) : ?>
                    <tr>
                      <td>
                        <a href="detail-employee.php?employee_id=<?php echo $row['employee_id']; ?>">
                          <div class="d-flex px-2 py-1">
                            <div>
                            <?= !empty($row['profile']) ? "<img src='../assets/img/employee_profiles/{$row['profile']}' class='avatar avatar-sm me-3' alt='user1'>" : '<i class="bi bi-person-circle"></i>' ?>
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                              <h6 class="mb-0 text-sm"><?php echo htmlspecialchars($row['username']); ?></h6>
                              <p class="text-xs text-secondary mb-0"><?php echo htmlspecialchars($row['email']); ?></p>
                            </div>
                          </div>
                        </a>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?php echo htmlspecialchars($row['position']); ?></p>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <?php echo htmlspecialchars($row['department_name']); ?>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><?php echo $row['num_projects']; ?></span>
                      </td>
                      <td class="align-middle">
                        <a href="../assets/files/cv<?php echo htmlspecialchars($row['cv']); ?>" class="text-secondary font-weight-bold text-xs" target="_blank">
                          <?php echo ($row['cv']) ? $row['cv'] : 'No attachment'; ?>
                        </a>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
    <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
        <div class="card">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-6 col-7">
                        <h6>Add New Employee</h6>
                        <p class="text-sm mb-0">Fill out the form below to add a new employee to the system.</p>
                    </div>
                </div>
            </div>
            <div class="card-body px-4 pb-2">
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="username" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter full name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter phone number" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="Enter address" required>
                    </div>
                    <div class="mb-3">
                        <label for="position" class="form-label">Position</label>
                        <input type="text" class="form-control" id="position" name="position" placeholder="Enter position" required>
                    </div>
                    <div class="mb-3">
                        <label for="dob" class="form-label">Birthdate</label>
                        <input type="date" class="form-control" id="dob" name="dob" required>
                    </div>
                  
                    
                    <div class="mb-3">
                        <label for="department" class="form-label">Department</label>
                        <select class="form-control" id="department" name="department_id" required>
                            <option value="">Select the department</option>
                            <?php foreach ($departments as $department): ?>
                                <option value="<?= $department['department_id'] ?>"><?= $department['department_name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="note" class="form-label">Notes</label>
                        <textarea class="form-control" id="note" name="note" rows="3" placeholder="Additional notes"></textarea>
                    </div>
                    <button type="submit" name="add" class="btn btn-secondary">Save Employee</button>
                </form>
            </div>
        </div>
    </div>
</div>
    <footer class="footer pt-3">
      <div class="container-fluid">
        <div class="row align-items-center justify-content-lg-between">
          <div class="col-lg-6 mb-lg-0 mb-4">
            <div class="copyright text-center text-sm text-muted text-lg-start">
              © <script>
                document.write(new Date().getFullYear())
              </script>,
              Developed with ❤️ by <a href="https://nguvutech.com" class="font-weight-bold" target="_blank">NGUVU TECH</a> for a better web.
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