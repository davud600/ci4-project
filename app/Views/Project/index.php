<?= $this->extend('app') ?>

<?= $this->section('header') ?>
<title><?= $project['title'] ?></title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<a class="btn btn-link" href="/projects">Back</a>
<div class="d-flex justify-content-center text-center">
  <div class="w-75 mt-5">
    <h2><?= $project['title'] ?></h2>
    <hr>
    <div class="d-flex justify-content-between">
      <span class="fw-bold">Description: </span>
      <span><?= $project['description'] ?></span>
    </div>
    <hr>
    <div class="d-flex justify-content-between">
      <span class="fw-bold">Status: </span>
      <span>
        <?php
        echo $project['status'] == 0 ? 'In Progress' : 'Finished'
        ?>
      </span>
    </div>
    <hr>
    <div class="d-flex justify-content-between">
      <span class="fw-bold">Customer: </span>
      <span><?= $customer['name'] ?></span>
    </div>
    <hr>
    <div class="d-flex justify-content-between">
      <span class="fw-bold">Employees: </span>
      <div>
        <?php foreach ($employees as $employee) { ?>
          <span><?= $employee['name'] ?>,</span>
        <?php } ?>
      </div>
    </div>
    <hr>
    <a class="btn btn-secondary" href="/edit-project/<?= $project['id'] ?>">Edit</a>
  </div>
</div>
<?= $this->endSection() ?>