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

  <form method="post">
    <input type="text" name="title" placeholder="Project Title"><br>
    <input type="text" name="description" placeholder="Project Description"><br>
    <label for="customer">Customer:</label>
    <select name="customer">
      <?php foreach ($customers as $customer) { ?>
        <option value="<?= $customer['id'] ?>"><?= $customer['name'] ?></option>
      <?php } ?>
    </select><br>
    <button type="submit">Submit</button><br>
  </form>
</body>

</html>