<?= $this->extend('app') ?>

<?= $this->section('header') ?>
<title></title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<a class="btn btn-link" href="/customer-project">Back</a>
<div class="d-flex justify-content-center text-center">
  <div class="w-75 mt-5">
    <h2><?= $request['title'] ?></h2>
    <p class="mt-5"><?= $request['description'] ?></p>
  </div>
</div>
<?= $this->endSection() ?>