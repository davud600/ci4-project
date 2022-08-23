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
      <a href="index.html" class="logo d-flex align-items-center">
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
      <h1><?= $request['title'] ?></h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/">Home</a></li>

          <?php if ($logged_user_data['role'] == 0) { ?>
            <li class="breadcrumb-item">
              <a href="/customer-project">My Project</a>
            </li>
          <?php } else if ($logged_user_data['role'] == 1) { ?>
            <li class="breadcrumb-item">
              <a href="/employee-projects">My Projects</a>
            </li>
            <li class="breadcrumb-item">
              <a href="/employee-project/<?= $project['id'] ?>">
                <?= $project['title'] ?>
              </a>
            </li>
          <?php } else if ($logged_user_data['role'] == 2) { ?>
            <li class="breadcrumb-item">
              <a href="/dashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
              <a href="/projects">Projects</a>
            </li>
            <li class="breadcrumb-item">
              <a href="/project/<?= $project['id'] ?>">
                <?= $project['title'] ?>
              </a>
            </li>
          <?php } ?>

          <li class="breadcrumb-item active">
            <a href="/request/<?= $request['id'] ?>">
              <?= $request['title'] ?>
            </a>
          </li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section>
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Description</h5>
          <p class="pb-3"><?= $request['description'] ?></p>
          <span class="me-3 fw-bold">Created at</span>
          <span class=""><?= $request['created_date'] ?></span>
        </div>
      </div>

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Messages</h5>
          <!-- Loop through messages -->
          <div class="d-flex justify-content-center">
            <div class="d-flex flex-column gap-1 w-50">
              <?php foreach ($messages as $message) { ?>
                <?php if ($message['created_by'] == $logged_user_data['name']) { ?>
                  <div class="d-flex justify-content-end">
                    <div class="d-flex flex-column">
                      <div class="d-flex flex-row">
                        <span class="me-3" data-bs-toggle="tooltip" data-bs-placement="left" title="<?= $message['created_date'] ?>">
                          <?= $message['text'] ?>
                        </span>
                        <?php if ($message['attach'] != null) { ?>
                          <?php
                          $file_uri_path = $message['attach'];
                          $uri_segments = explode('/', $file_uri_path);
                          $file_name = $uri_segments[count($uri_segments) - 1];
                          ?>
                          <a href="<?= base_url('download-file?file_uri=' . $message['attach']) ?>">
                            <span><?= $file_name ?></span>
                            <i class="bi bi-file"></i>
                          </a>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                <?php } else { ?>
                  <div class="d-flex justify-content-start">
                    <div class="d-flex flex-column">
                      <div class="d-flex flex-row">
                        <span class="fw-bold"><?= $message['created_by'] ?>:&nbsp;&nbsp;</span>
                        <span class="me-3" data-bs-toggle="tooltip" data-bs-placement="right" title="<?= $message['created_date'] ?>">
                          <?= $message['text'] ?>
                        </span>
                        <?php if ($message['attach'] != null) { ?>
                          <?php
                          $file_uri_path = $message['attach'];
                          $uri_segments = explode('/', $file_uri_path);
                          $file_name = $uri_segments[count($uri_segments) - 1];
                          ?>
                          <a href="<?= base_url('download-file?file_uri=' . $message['attach']) ?>">
                            <span><?= $file_name ?></span>
                            <i class="bi bi-file"></i>
                          </a>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                <?php } ?>
                <hr>
              <?php } ?>
            </div>
          </div>
          <!-- Send message form -->
          <div class="d-flex justify-content-center">
            <form action="/create-message/<?= $request['id'] ?>" class="w-50" method="post" enctype="multipart/form-data">
              <div class="mt-3 mb-3 justify-content-center d-flex gap-2 flex-row">
                <input type="text" name="message" class="form-control">
                <input type="file" name="userfile">
                <button type="submit" class="btn btn-primary">Send</button>
              </div>
            </form>
          </div>
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