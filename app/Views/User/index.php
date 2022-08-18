<?= $this->extend('app') ?>

<?= $this->section('header') ?>
<title>User Profile</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-center text-center">
  <div class="w-auto mt-5">
    <h2>Welcome: <?= $logged_user_data['name'] ?>!</h2>
    <h2>
      Role:
      <?php
      echo $logged_user_data['role'] == 0 ? 'Customer' : ($logged_user_data['role'] == 1 ? 'Employee' : 'Admin')
      ?>
    </h2>
    <div class="d-flex flex-column">
      <?php if ($logged_user_data['role'] == 2) { ?>
        <a class="btn btn-link mt-5" href="/dashboard">Dashboard</a>
      <?php } else if ($logged_user_data['role'] == 1) { ?>
        <a class="btn btn-link mt-5" href="/employee-projects">View My Projects</a>
      <?php } else if ($logged_user_data['role'] == 1) { ?>
        <a class="btn btn-link mt-5" href="">My Project</a>
      <?php } ?>
      <a class="btn btn-link mt-2" href="/login">Log Out</a>
    </div>
  </div>
</div>
<?= $this->endSection() ?>