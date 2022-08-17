<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $project['title'] ?></title>
</head>

<body>
  <a href="/projects">Back</a>
  <h2><?= $project['title'] ?></h2>
  <span>Project description: </span>
  <p><?= $project['description'] ?></p>
  <span>Project status: </span>
  <p><?= $project['status'] ?></p>
  <span>Customer: </span>
  <p><?= $customer['name'] ?></p>
  <span>Employees: </span>
  <?php foreach ($employees as $employee) { ?>
    <p><?= $employee['name'] ?></p>
  <?php } ?>
</body>

</html>