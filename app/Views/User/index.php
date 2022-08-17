<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Profile</title>
</head>

<body>
  <h2>Welcome: <?= $logged_user_data['name'] ?>!</h2>
  <h2>
    Role:
    <?php
    echo $logged_user_data['role'] == 0 ? 'Customer' : ($logged_user_data['role'] == 1 ? 'Employee' : 'Admin')
    ?>
  </h2>
  <?php if ($logged_user_data['role'] == 2) { ?>
    <a href="/dashboard">Dashboard</a>
  <?php } ?>
</body>

</html>