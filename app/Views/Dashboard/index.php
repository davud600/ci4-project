<?= $this->extend('app') ?>

<?= $this->section('header') ?>
<title>Dashboard</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-center text-center">
  <div class="mt-5 d-flex flex-column">
    <h2 class="mb-5">Dashboard</h2>
    <a class="btn btn-link" href="/create-project">Create Project</a><br>
    <a class="btn btn-link" href="/projects">View All Projects</a><br>
    <a class="btn btn-link" href="/profile">Profile</a><br>
    <a class="btn btn-link" href="/login">Log Out</a><br>
  </div>
</div>
<?= $this->endSection() ?>