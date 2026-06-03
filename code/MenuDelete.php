<!--
Lab2, SCSM2223-25262 (MenuDelete.php)
Group Name: Strange
-->
<?php require 'libs/authpage.php'; ?>
<?php require 'libs/db_connect_PDO.php'; ?>
<?php

if (empty($_REQUEST['id'])) { header("Location: MenuManage.php"); exit(); }
$id = $_REQUEST['id'];
$task = isset($_REQUEST['task']) ? $_REQUEST['task'] : "";

// Proceed or cancel delete operation
if ($task == "Delete" || $task == "Cancel") {
  if ($task == "Delete") {
    $stmt = $pdo->prepare("DELETE FROM menus WHERE id = :id");
    try {
      $stmt->execute([':id' => $id]);
    } catch (PDOException $ex) {
      echo "Database Error: " . $ex->getMessage();
    }
  }

  else {
    header("Location: MenuManage.php");
    exit;
  }
}

// Query database to display menu info to be deleted
$stmt = $pdo->prepare("SELECT * FROM menus WHERE id = :id");

try {
  $stmt->execute([':id' => $id]);
} catch (PDOException $ex) {
  echo "Database Error: " . $ex->getMessage();
}

$row = $stmt->fetch();
$name = $row['name'];
$type = $row['type'];
$price = number_format($row['price'], 2);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Tasty Bites - Delete Menu</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="main_style.css"  rel="stylesheet" type="text/css">
</head>

<body>

<!-- Main Layout Table -->
<table border="0" width="100%">
  <!-- Header -->
  <tr>
    <td align="center">
      <?php include 'libs/header.php'; ?>
    </td>
  </tr>

  <!-- Navigation -->
  <tr>
    <td align="center">
      <?php include 'libs/navigation.php'; ?>
    </td>
  </tr>

  <!-- Content Row -->
  <tr>
    <!-- Menu Section -->
    <td>
      <h2>Delete Menu Item</h2>
      <table width="400" cellspacing="5">
        <form action="MenuDelete.php" method="POST">
          <input type="hidden" name="id" value="<?= $row['id'] ?>";
          <tr>
            <th align="right">Name:</th>
            <td><?=$name?></td>
          </tr>
          <tr>
            <th align="right">Type:</th>
            <td><?=$type?></td>
          </tr>
          <tr>
            <th align="right">Price (RM):</th>
            <td><?=$price?></td>
          </tr>
          <tr>
            <td></td>
            <td>
              <input type="submit" name="task" value="Delete"> 
              <input type="button" onclick="history.back()" value="Cancel">
            </td>
          </tr>
        </form>
      </table>
    </td>
  </tr>

  <!-- Footer -->
  <tr>
    <td align="center">
      <?php include 'libs/footer.php'; ?>
    </td>
  </tr>

</table>

</body>
</html>
