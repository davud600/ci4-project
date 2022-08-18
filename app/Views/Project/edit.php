<?= $this->extend('app') ?>

<?= $this->section('header') ?>
<title><?= $project['title'] ?></title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<a class="btn btn-link" href="/project/<?= $project['id'] ?>">Back</a>
<div class="d-flex justify-content-center text-center">
  <div class="w-75 mt-5">
    <form method="post">
      <input type="text" name="title" value="<?= $project['title'] ?>">
      <hr>
      <div class="d-flex justify-content-between">
        <span class="fw-bold">Description: </span>
        <input type="text" name="description" value="<?= $project['description'] ?>">
      </div>
      <hr>
      <div class="d-flex justify-content-between">
        <!-- Checkbox doesnt change the status -->
        <span class="fw-bold">Status: </span>
        <div>
          <span>
            <?php
            echo $project['status'] == 0 ? 'In Progress' : 'Finished'
            ?>
          </span>
          <input type="checkbox">
        </div>
      </div>
      <hr>
      <div class="d-flex justify-content-between">
        <span class="fw-bold">Customer: </span>
        <select name="customer" id="customer">
          <?php foreach ($customers as $customer) { ?>
            <option value="<?= $customer['id'] ?>"><?= $customer['name'] ?></option>
          <?php } ?>
        </select>
      </div>
      <hr>
      <div class="d-flex justify-content-between">
        <span class="fw-bold">Employees: </span>
        <div>
          <div id="employees">
            <?php $index = 0;
            foreach ($employees as $employee) {
              $index += 1; ?>
              <div id="employeeContainer<?= $employee['id'] ?>">
                <button class="btn btn-danger ps-3 pe-3 pt-1 pb-1 m-2" type="button" onclick="removeEmployee(event)">x</button>
                <select name="employee<?= $index ?>">
                  <?php foreach ($all_employees as $emp) { ?>
                    <?php if ($emp['id'] == $employee['id']) { ?>
                      <option value="<?= $emp['id'] ?>" selected>
                        <?= $emp['name'] ?>
                      </option>
                    <?php continue;
                    } ?>
                    <option value="<?= $emp['id'] ?>">
                      <?= $emp['name'] ?>
                    </option>
                  <?php } ?>
                </select>
              </div>
            <?php } ?>
          </div>
          <button class="btn" type="button" onclick="addEmployee()">+ Add Employee</button><br>
        </div>
      </div>
      <hr>
      <button class="btn btn-success mt-3" type="submit">Save Changes</button>
    </form>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script type="text/javascript">
  var inputtedEmployees = [];

  <?php foreach ($employees as $employee) { ?>
    inputtedEmployees.push($employee);
  <?php } ?>

  function addEmployee() {
    inputtedEmployees.push($('#employees').append(`
        <div id="employeeContainer">
          <button class="btn btn-danger ps-3 pe-3 pt-1 pb-1 m-2" type="button" onclick="removeEmployee(event)">x</button>
          <select name="employee${inputtedEmployees.length}">
            <?php foreach ($all_employees as $employee) { ?>
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