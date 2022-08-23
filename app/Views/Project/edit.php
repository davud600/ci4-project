<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?= $project['title'] ?></title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../../assets/img/favicon.png" rel="icon">
  <link href="../../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../../assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../../assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../../assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin - v2.3.1
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="/" class="logo d-flex align-items-center">
        <img src="../../assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">NiceAdmin</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <!-- <img src="../../assets/img/profile-img.jpg" alt="Profile" class="rounded-circle"> -->
            <span class="d-none d-md-block dropdown-toggle ps-2"><?= $logged_user_data['name'] ?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?= $logged_user_data['name'] ?></h6>
              <span>
                <?php
                echo $logged_user_data['role'] == 0 ? 'Customer' : ($logged_user_data['role'] == 1 ? 'Employee' : 'Admin')
                ?>
              </span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="/profile">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="/profile">
                <i class="bi bi-gear"></i>
                <span>Account Settings</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="/faq">
                <i class="bi bi-question-circle"></i>
                <span>Need Help?</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="/login">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <?php if ($logged_user_data['role'] == 0) { ?>
          <a class="nav-link " href="/customer-project">
            <i class="bi bi-grid"></i>
            <span>My Project</span>
          </a>
        <?php } else if ($logged_user_data['role'] == 1) { ?>
          <a class="nav-link " href="/employee-projects">
            <i class="bi bi-grid"></i>
            <span>My Projects</span>
          </a>
        <?php } else if ($logged_user_data['role'] == 2) { ?>
          <a class="nav-link " href="/dashboard">
            <i class="bi bi-grid"></i>
            <span>Dashboard</span>
          </a>
        <?php } ?>
      </li><!-- End Dashboard Nav -->
      <li class="nav-heading">Pages</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="/profile">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="/faq">
          <i class="bi bi-question-circle"></i>
          <span>F.A.Q</span>
        </a>
      </li><!-- End F.A.Q Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="/contact">
          <i class="bi bi-envelope"></i>
          <span>Contact</span>
        </a>
      </li><!-- End Contact Page Nav -->

    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Update Project Information</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="/projects">Projects</a></li>
          <li class="breadcrumb-item"><a href="/project/<?= $project['id'] ?>"><?= $project['title'] ?></a></li>
          <li class="breadcrumb-item active"><a href="/edit-project/<?= $project['id'] ?>">Update Project</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section>
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Edit Project</h5>

          <!-- Floating Labels Form -->
          <form class="row g-3" method="post">
            <div class="col-md-8">
              <div class="form-floating">
                <input value="<?= $project['title'] ?>" type="text" class="form-control" id="title" name="title" placeholder="Project Title">
                <label for="title">Title</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-floating mb-3">
                <select name="customer" class="form-select" id="floatingSelect" aria-label="State">
                  <?php foreach ($customers as $cus) { ?>
                    <?php if ($cus['id'] == $customer['id']) { ?>
                      <option value="<?= $cus['id'] ?>" selected>
                        <?= $cus['name'] ?>
                      </option>
                    <?php continue;
                    } ?>
                    <option value="<?= $cus['id'] ?>">
                      <?= $cus['name'] ?>
                    </option>
                  <?php } ?>
                </select>
                <label for="floatingSelect">Customer</label>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-floating">
                <input value="<?= $project['description'] ?>" type="text" class="form-control" id="description" name="description" placeholder="Project Description">
                <label for="description">Project Description</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-floating mb-3">
                <select name="status" class="form-select" id="floatingSelect" aria-label="State">
                  <?php echo $project['status'] == 0 ?
                    '<option value="0" selected>In Progress</option>
                    <option value="1">Finished</option>' :
                    '<option value="0">In Progress</option>
                    <option value="1" selected>Finished</option>'
                  ?>
                </select>
                <label for="floatingSelect">Status</label>
              </div>
            </div>
            <div class="col-md-12">
              <label class="ms-2 mb-2 mt-2">Employees</label>
              <div class="row" id="employees">
                <div class="col-3">
                  <button class="btn w-100 text-start pb-3 pt-3" type="button" onclick="addEmployee()">
                    + Add Employee
                  </button>
                </div>
                <?php $index = 0;
                foreach ($employees as $employee) { ?>
                  <div class="col-3 mb-3">
                    <div class="form-floating m-0 relative mb-2">
                      <select name="employee<?= $index ?>" id="floatingSelect" class="form-select position-relative" aria-label="State">
                        <?php foreach ($all_employees as $emp) { ?>
                          <?php if ($emp['id'] == $employee['id']) { ?>
                            <option value="<?= $emp['id'] ?>" selected>
                              <?= $emp['name'] ?>
                            </option>
                          <?php continue;
                          } ?>
                          <option value="<?= $emp['id'] ?>">
                            <?= $emp['name'] ?>
                          </option>
                        <?php } ?>
                      </select>
                      <button class="bottom-0 btn ps-2 pe-2 pt-0 pb-0 position-absolute end-0 top-0 bottom-50" type="button" onclick="removeEmployee(event)">x</button>
                      <label for="floatingSelect">Employee</label>
                    </div>
                  </div>
                <?php $index += 1;
                } ?>
              </div>
            </div>

            <div class="text-center mt-5">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form><!-- End floating Labels Form -->

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
  </footer><!-- End Footer -->

  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script type="text/javascript">
    var inputtedEmployees = [];

    // get dom element employees
    const prevChildren = document.getElementById('employees').children;

    // loop through its children and add them in inputtedEmployees
    for (let i = 0; i < prevChildren.length; i++) {
      inputtedEmployees.push(prevChildren[i]);
    }

    function addEmployee() {
      inputtedEmployees.push($('#employees').append(`
      <div class="col-3 mb-3">
        <div class="form-floating m-0 relative mb-2">
          <select name="employee${inputtedEmployees.length}" id="floatingSelect" class="form-select position-relative" aria-label="State">
            <?php foreach ($all_employees as $emp) { ?>
              <option value="<?= $emp['id'] ?>"><?= $emp['name'] ?></option>
            <?php } ?>
          </select>
          <button class="bottom-0 btn ps-2 pe-2 pt-0 pb-0 position-absolute end-0 top-0 bottom-50" type="button" onclick="removeEmployee(event)">x</button>
          <label for="floatingSelect">Employee</label>
        </div>
      </div>`));
    }

    function removeEmployee(event) {
      event.target.parentElement.remove();
    }
  </script>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="../../assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../../assets/vendor/chart.js/chart.min.js"></script>
  <script src="../../assets/vendor/echarts/echarts.min.js"></script>
  <script src="../../assets/vendor/quill/quill.min.js"></script>
  <script src="../../assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../../assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../../assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="../../assets/js/main.js"></script>

</body>

</html>