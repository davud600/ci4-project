<?= $this->extend('app') ?>

<?= $this->section('header') ?>
<title>Welcome</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-center">
  <div class="mt-5">
    <h2 class="mb-5 ms-4">Welcome</h2>
    <a class="btn btn-secondary ps-4 pe-4 pt-2 pb-2" href="/login">Log In</a>
    <a class="btn btn-primary ps-4 pe-4 pt-2 pb-2" href="/signup">Sign Up</a>
  </div>
</div>
<?= $this->endSection() ?>