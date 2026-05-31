<?php 
$linkName = "Login";
$linkRef = "login.php";
$username = "";
$role = "";

if (isset($_COOKIE['username'])) { 
  $linkName = "Logout";
  $linkRef = "logout.php";
  $username = $_COOKIE['username'];
  $role = $_COOKIE['role'];
}
?>

<p>
  <a href="Menu.php">Menu</a> |
  <a href="OrderForm.php">Order Now</a> |
  <a href="MenuManage.php">Manage Menu</a> | 
  <a href="OrderList.php">List Order</a> |
  <a href="<?= $linkRef ?>"><?= $linkName ?></a>
<?php if ($username != "") { ?>
  <br>
  ( <?= $username ?> - <?= $role ?> )
<?php } ?>
</p>
