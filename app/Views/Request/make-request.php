<?= $this->extend('app') ?>

<?= $this->section('header') ?>
<title>Submit a Request</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<a class="btn btn-link" href="/customer-project">Back</a><br>
<div class="p-2 d-flex justify-content-center">
  <div class="w-50">
    <h2 class="mb-5">Submit a Request</h2>
    <form class="w-100" method="post">
      <div class="form-group">
        <label for="title">Subject</label>
        <input type="text" class="mt-2 mb-2 form-control" id="title" name="title" placeholder="Enter Subject">
      </div>
      <div class="form-group">
        <label for="description">Request</label>
        <input type="text" class="mt-2 mb-2 form-control" id="description" name="description" placeholder="Enter Request...">
      </div>
      <button type="submit" class="mt-4 btn btn-primary">Submit</button>
    </form>
  </div>
</div>
<?= $this->endSection() ?>