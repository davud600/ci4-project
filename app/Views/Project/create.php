<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>New Project</title>
</head>

<body>
  <h2>Create Project</h2>
  <?php $num_of_employees = 0; ?>

  <form method="post">
    <input type="text" name="title" placeholder="Project Title"><br>
    <input type="text" name="description" placeholder="Project Description"><br>

    <label for="customer">Customer:</label>
    <select name="customer">
      <?php foreach ($customers as $customer) { ?>
        <option value="<?= $customer['id'] ?>"><?= $customer['name'] ?></option>
      <?php } ?>
    </select><br>

    <label for="employee">Employees:</label>
    <div id="employees"></div>
    <button type="button" onclick="addEmployee()">Add Employee</button><br>

    <button type="submit">Submit</button><br>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script type="text/javascript">
      var employeeCount = 0;

      function addEmployee() {
        employeeCount++;
        $('#employees').append(`
        <div id="employeeContainer${employeeCount}">
          <button type="button" onclick="removeEmployee()">x</button>
          <select name="employee${employeeCount}">
            <?php foreach ($employees as $employee) { ?>
              <option value="<?= $employee['id'] ?>"><?= $employee['name'] ?></option>
            <?php } ?>
          </select>
        </div>`);
      }

      function removeEmployee() {
        $(`#employeeContainer${employeeCount}`).remove();
      }
    </script>
  </form>
</body>

</html>