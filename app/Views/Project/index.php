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
      <h1><?= $project['title'] ?></h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item active"><a href="/dashboard">Dashboard</a></li>
          <li class="breadcrumb-item active"><a href="/projects">Projects</a></li>
          <li class="breadcrumb-item active"><a href="/project/<?= $project['id'] ?>"><?= $project['title'] ?></a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section>
      <?php if (session()->getFlashdata('status') == 'success') { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <?= session()->getFlashdata('message') ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php } else if (session()->getFlashdata('status') == 'error') { ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <?= session()->getFlashdata('message') ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php } ?>
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Project Information</h5>

          <!-- Default List group -->
          <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between">
              <span class="fw-bold">Description</span>
              <span class="col-7 text-end"><?= $project['description'] ?></span>
            </li>
            <li class="list-group-item d-flex justify-content-between">
              <span class="fw-bold">Status</span>
              <span>
                <?php
                echo $project['status'] == 0 ? '
                  <span class="badge bg-secondary">In Progress</span>' :
                  '
                  <span class="badge bg-success">Finished</span>'
                ?>
              </span>
            </li>
            <li class="list-group-item d-flex justify-content-between">
              <span class="fw-bold">Customer</span>
              <span><?= $customer['name'] ?></span>
            </li>
            <li class="list-group-item d-flex justify-content-between">
              <span class="fw-bold">Employees</span>
              <div>
                <?php foreach ($employees as $employee) { ?>
                  <span><?= $employee['name'] ?>,</span>
                <?php } ?>
              </div>
            </li>
            <li class="list-group-item d-flex justify-content-between">
              <span class="fw-bold">Estimated Time</span>
              <div class="form-group d-flex gap-3">
                <span class="mt-2">
                  <?= gmdate("i:s", $project['estimated_time']) ?>
                </span>
              </div>
            </li>

            <div class="d-flex justify-content-center mt-4">
              <a class="btn btn-secondary ps-4 pe-4" href="/edit-project/<?= $project['id'] ?>">Edit</a>
            </div>
          </ul><!-- End Default List group -->

        </div>
      </div>

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Requests</h5>

          <!-- Table with hoverable rows -->
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">Id</th>
                <th scope="col">Subject</th>
                <th scope="col">Content</th>
                <th scope="col">Status</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($requests as $request) { ?>
                <tr>
                  <th><?= $request['id'] ?></th>
                  <td><?= $request['title'] ?></td>
                  <td><?= $request['description'] ?></td>
                  <td>
                    <?php
                    echo $request['status'] == 0 ? '
                      <span class="badge bg-secondary">Under Review</span>' :
                      '
                      <span class="badge bg-success">Approved</span>'
                    ?>
                  <td><a class="btn btn-primary" href="/request/<?= $request['id'] ?>">View</a></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
          <!-- End Table with hoverable rows -->

        </div>
      </div>

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Updates</h5>

          <!-- Table with hoverable rows -->
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">Employee</th>
                <th scope="col">Time</th>
                <th scope="col">Added at</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($time_adds as $time_add) { ?>
                <tr>
                  <td><?= $time_add['created_by'] ?></td>
                  <td>
                    <?= $time_add['created_by'] == 'admin' ? '(Updated)' : ''; ?>
                    <?= gmdate("i:s", ($time_add['time_added'])) ?>
                  </td>
                  <td><?= $time_add['created_date'] ?></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
          <!-- End Table with hoverable rows -->

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