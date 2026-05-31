<!--
Assignment 1, SCSM2223-25262 (OrderConfirm.php)
Group Name: ???
-->
<?php require 'libs/db_connect_PDO.php'; ?>
<?php
// Read order info from POST method
$name = htmlspecialchars($_POST['name']);
$email = htmlspecialchars($_POST['email']);
$phone = htmlspecialchars($_POST['phone']);
$food_id = $_POST['food_id'];
$qtyFood = $_POST['qtyFood'];
$drink_id = $_POST['drink_id'];
$qtyDrink = $_POST['qtyDrink'];
$delivery = $_POST['delivery'];
$comments = htmlspecialchars($_POST['comments']);

if ($qtyFood == '' && $qtyDrink == '') {
    header("Location: OrderForm.php");
    exit;
}

// User confirm to order
if (isset($_POST['button']) && $_POST['button'] == "Confirm") {
    // 1. Check by email if user is returned customer. If yes then just get user ID.
    // 2. If user is a new customer then need to register user (use 'email' and 'phone' 
    //    information as 'username' and 'password').
    // 3. Save customer's order info into database.
    $user_id = -1;
    $order_id = -1;
    
    date_default_timezone_set('Asia/Kuala_Lumpur');
    $date = new DateTime('now');
    $datetime = $date->format('Y-m-d H:i:s');
    
    $stmt_userCheck = $pdo->prepare("SELECT * FROM users WHERE email=:email");
    
    //$stmt_userSave = $pdo->prepare("INSERT INTO users ???");
                                        
    //$stmt_orderSave = $pdo->prepare("INSERT INTO orders ???");
                                 
    $stmt_orderCheck = $pdo->prepare("SELECT * FROM orders WHERE user_id=:user_id AND datetime=:datetime");
                                 
    //$stmt_ordermenuSave = $pdo->prepare("INSERT INTO order_menus ???");
    
    try {
      // ???
         
    } catch (PDOException $ex) { 
      echo "Database Error: " . $ex->getMessage();
    }
    
    header("Location: Menu.php");
    exit;
}

// Query selected food & drink for confirmation display
$stmt_food = $pdo->prepare("SELECT * FROM menus WHERE id=$food_id");
$stmt_drink = $pdo->prepare("SELECT * FROM menus WHERE id=$drink_id");

$foodPrice = 0;
$drinkPrice = 0;
$totalPrice = 0;

$food = NULL;
$drink = NULL;

try {
  // ???
  
} catch (PDOException $ex) { 
  echo "Database Error: " . $ex->getMessage();
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>Tasty Bites - Order Form</title>
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
    <!-- Order Form Section -->
    <td>
      <form action="OrderConfirm.php" method="POST">
        <h2>Please Confirm Your Order</h2>
        <hr>
        <h3>Customer Information</h3>
        
        <table cellpadding="3">
          <tr>
            <th align="right">Name: </th>
            <td>???</td>
          </tr>
          <tr>
            <th align="right">Email: </th>
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
          <td id="clock"></td>
        </tr>
        </table>
        <br><hr>
        <h3>Order Details</h3>

        <table border="0" width="320">
          <tr>
            <th align="center">&nbsp; QTY &nbsp;</th>
            <th align="left">ITEM</th>
            <th align="right">PRICE (RM)</th>
          </tr>
<?php if ($qtyFood != '') { ?>
          <tr>
            <td align="center"><?= $qtyFood ?></td>
            <td>???</td>
            <td align="right"><?= number_format($foodPrice, 2) ?></td>
          </tr>
<?php } ?>
<?php if ($qtyDrink != '') { ?>
          <tr>
            <td align="center"><?= $qtyDrink ?></td>
            <td>???</td>
            <td align="right"><?= number_format($drinkPrice, 2) ?></td>
          </tr>
<?php } ?>          
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
        
        <p>
          <b>Additional Comments: </b><i><?= $comments ?></i>
        </p>

        <p>
          <input type="submit" name="button" value="Confirm">
          <input type="button" onclick="history.back()" value="Cancel">
        </p>
      </form>
    </td>
  </tr>

  <!-- Footer -->
  <tr>
    <td colspan="2" align="center">
      <?php include 'libs/footer.php'; ?>
    </td>
  </tr>
</table>
</body>
</html>

<script>
// Function to update the display
function updateClock() {
    const now = new Date();
    // Format: "MM/DD/YYYY, HH:MM:SS AM/PM" (varies by locale)
    const liveTime = now.toLocaleString(); 
    
    // Update the HTML element with id="clock"
    document.getElementById('clock').textContent = liveTime;
}

// Call the function every 1000 milliseconds (1 second)
setInterval(updateClock, 1000);

// Initial call to prevent 1-second delay on page load
updateClock();
</script>
