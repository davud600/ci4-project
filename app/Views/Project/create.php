<?= $this->extend('app') ?>

<?= $this->section('header') ?>
<title>New Project</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<a class="btn btn-link" href="/">Back</a><br>
<div class="p-2 d-flex justify-content-center">
  <div class="w-50">
    <h2 class="mb-5">Create Project</h2>
    <form class="w-100" method="post">
      <div class="form-group">
        <label for="title">Project Title</label>
        <input type="text" class="mt-2 mb-2 form-control" id="title" name="title" placeholder="Enter Title">
      </div>
      <div class="form-group">
        <label for="description">Project Description</label>
        <input type="text" class="mt-2 mb-2 form-control" id="description" name="description" placeholder="Enter Description">
      </div>
      <div class="form-group mt-3">
        <label for="customer">Customer:</label>
        <select name="customer">
          <?php foreach ($customers as $customer) { ?>
            <option value="<?= $customer['id'] ?>"><?= $customer['name'] ?></option>
          <?php } ?>
        </select>
      </div>
      <div class="form-group mt-3">
        <label class="mb-2" for="employee">Employees:</label>
        <div id="employees" name="employees"></div>
        <button class="btn" type="button" onclick="addEmployee()">+ Add Employee</button><br>
      </div>
      <button type="submit" class="mt-4 btn btn-primary">Submit</button>
    </form>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script type="text/javascript">
  var inputtedEmployees = [];

  function addEmployee() {
    inputtedEmployees.push($('#employees').append(`
        <div id="employeeContainer">
          <button class="btn btn-danger ps-3 pe-3 pt-1 pb-1 m-2" type="button" onclick="removeEmployee(event)">x</button>
          <select name="employee${inputtedEmployees.length}">
            <?php foreach ($employees as $employee) { ?>
              <option value="<?= $employee['id'] ?>"><?= $employee['name'] ?></option>
            <?php } ?>
          </select>
        </div>`));
  }

  function removeEmployee(event) {
    event.target.parentElement.remove();
  }
</script>
<?= $this->endSection() ?>