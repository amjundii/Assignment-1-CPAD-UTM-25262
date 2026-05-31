<!--
Assignment 1, SCSM2223-25262 (OrderView.php)
Group Name: ???
-->
<?php require 'libs/authpage.php'; ?>
<?php require 'libs/db_connect_PDO.php'; ?>
<?php
$changeStatus = "";
if (isset($_GET['changeStatus'])) {
  $changeStatus  = $_GET['changeStatus'];
}

// Associatve array to conveniently change the order status
$statusMap = [
  'New' => ['prev'=>'New', 'next'=>'Prepare' ],
  'Prepare' => ['prev'=>'New', 'next'=>'Delivered' ],
  'Delivered' => ['prev'=>'Prepare', 'next'=>'Delivered' ],
];

// Construct the SQL to get user info and ordered menus from the database
//$stmtOrder = $pdo->prepare("SELECT ???");
                           
//$stmtMenu = $pdo->prepare("SELECT ???");

// Construct the SQL to get user info and ordered menus from the database                           
$stmtStatusSave = $pdo->prepare("UPDATE orders SET status=:status WHERE id=:id");
  
try {
  // ???
  
  //echo $stmtOrder->debugDumpParams();
  //echo $stmtMenu->debugDumpParams();
  //echo $stmtStatusSave->debugDumpParams();
  
} catch (PDOException $ex) {
  echo "Database Error: " . $ex->getMessage();
}

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
    <!-- Order Section -->
    <td>
      <h2>View Customer Order</h2>
      <table cellpadding="3">
        <tr>
          <th align="right">Name: </th>
          <td>???</td>
        </tr>
        <tr>
          <th align="right">Phone Number: </th>
          <td>???</td>
        </tr>
        <tr>
          <th align="right">Delivery Option: </th>
          <td>???</td>
        </tr>
        <tr>
          <th align="right">Date-Time: </th>
          <td>???</td>
        </tr>
        <tr>
          <th align="right">Status: </th>
          <td>
            <a href="OrderView.php?changeStatus=prev&id=<?= $_GET['id'] ?>">&lt;&lt;</a> 
            [ ??? ] 
            <a href="OrderView.php?changeStatus=next&id=<?= $_GET['id'] ?>">&gt;&gt;</a>
          </td>
        </tr>
      </table>
      <br>
      <table border="0">
        <tr>
          <th align="center">&nbsp; QTY &nbsp;</th>
          <th align="left">ITEM</th>
          <th align="right">PRICE (RM)</th>
        </tr>
<?php 
$totalPrice = 0;
?>
        <tr>
          <td align="center">???</td>
          <td>???</td>
          <td align="right">???</td>
        <tr>
          <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
          <th colspan="2" align="left">SUBTOTAL</th>
          <td align="right">RM <?= number_format($totalPrice, 2) ?></td>
        </tr>
        <tr>
          <th colspan="2" align="left">SST (6%)</th>
          <td align="right">RM <?= number_format($totalPrice * 0.06, 2) ?></td>
        </tr> 
        <tr>
          <th colspan="2" align="left">TOTAL</th>
          <td align="right">RM <?= number_format($totalPrice + $totalPrice * 0.06, 2) ?></td>
        </tr> 
      </table>
      
      <p><i>???</i></p>
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
