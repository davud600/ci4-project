<?= $this->extend('app') ?>

<?= $this->section('header') ?>
<title>My Projects</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<a class="btn btn-link" href="/dashboard">Back</a><br>
<div class="d-flex justify-content-center text-center">
  <div class="mt-5 w-75">
    <table class="table w-100">
      <thead class="thead-light">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Title</th>
          <th scope="col">Description</th>
          <th scope="col">Status</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($projects as $project) { ?>
          <tr>
            <th><?= $project['id'] ?></th>
            <td><?= $project['title'] ?></td>
            <td><?= $project['description'] ?></td>
            <td>
              <?php
              echo $project['status'] == 0 ? 'In Progress' : 'Finished'
              ?>
            </td>
            <td>
              <a class="btn btn-primary" href="/employee-project/<?= $project['id'] ?>">View</a>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>
<?= $this->endSection() ?>