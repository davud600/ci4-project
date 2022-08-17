<?= $this->extend('app') ?>

<?= $this->section('header') ?>
<title>Log In</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<a class="btn btn-link" href="/">Back</a><br>
<div class="p-2 d-flex justify-content-center">
  <div class="w-50">
    <h2 class="mb-5">Log In</h2>
    <form class="w-100" method="post">
      <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" class="mt-2 mb-2 form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email">
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="mt-2 mb-2 form-control" id="password" name="password" placeholder="Password">
      </div>
      <span class="p-0">Don't have an account? </span>
      <a class="btn btn-link ms-2" href="/signup">Sign Up</a><br>
      <button type="submit" class="mt-3 btn btn-primary">Log In</button>
    </form>
  </div>
</div>
<?= $this->endSection() ?>