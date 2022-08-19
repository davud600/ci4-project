<?= $this->extend('app') ?>

<?= $this->section('header') ?>
<title></title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?php if ($logged_user_data['role'] == 0) { ?>
  <a class="btn btn-link" href="/customer-project">Back</a>
<?php } else if ($logged_user_data['role'] == 1) { ?>
  <a class="btn btn-link" href="/employee-project/<?= $request['project_id'] ?>">Back</a>
<?php } else if ($logged_user_data['role'] == 2) { ?>
  <a class="btn btn-link" href="/project/<?= $request['project_id'] ?>">Back</a>
<?php } ?>
<div class="d-flex justify-content-center text-center">
  <div class="w-75 mt-5">
    <h2><?= $request['title'] ?></h2>
    <p class="mt-5"><?= $request['description'] ?></p>
    <div>
      <h3 class="mb-5">Messages</h3>
      <!-- Previous messages -->
      <div class="d-flex flex-column gap-5">
        <?php foreach ($messages as $message) { ?>
          <div class="d-flex flex-row justify-content-between">
            <span><?= $message['created_by'] ?></span>
            <span><?= $message['text'] ?></span>
            <span><?= $message['created_date'] ?></span>
          </div>
        <?php } ?>
      </div>
      <!-- Send a new message -->
      <form action="/create-message/<?= $request['id'] ?>" class="w-100" method="post">
        <div class="form-group">
          <label for="message"></label>
          <textarea class="form-control mt-5" name="message" id="message" cols="30" rows="10"></textarea>
          <button type="submit" class="mt-3 btn btn-success">Submit Message</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?= $this->endSection() ?>