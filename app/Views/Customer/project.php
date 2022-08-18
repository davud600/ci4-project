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
      <span><?= $logged_user_data['name'] ?></span>
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
    <h3 class="mt-5">Requests</h3>
    <div class="mt-3 w-100">
      <table class="table w-100">
        <thead class="thead-light">
          <tr>
            <th scope="col">#</th>
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
                echo $request['status'] == 0 ? 'Under Review' : 'Approved'
                ?>
              </td>
              <td><a class="btn btn-primary" href="/request/<?= $request['id'] ?>">View</a></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
    <a class="mt-4 btn btn-success" href="/submit-request?project_id=<?= $project['id'] ?>">Leave a Request</a>
  </div>
</div>
<?= $this->endSection() ?>