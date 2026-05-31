<?php 
// Control page access by user's role
$page = basename($_SERVER['PHP_SELF']); 
$allowAccess = FALSE;

$ROLE_BASED_ACCESS = [ 
  'MenuManage.php'=>[ 'ADMIN'=>1 ], 
  'MenuAdd.php'=>[ 'ADMIN'=>1 ],
  'MenuUpdate.php'=>[ 'ADMIN'=>1 ],
  'MenuDelete.php'=>[ 'ADMIN'=>1 ],
  'OrderList.php'=>[ 'ADMIN'=>1, 'CASHIER'=>1 ],
  'OrderView.php'=>[ 'ADMIN'=>1, 'CASHIER'=>1 ]
];

if ($ROLE_BASED_ACCESS[$page]) { // need to apply page access control
  if (isset($_COOKIE['role'])) {
    $role = $_COOKIE['role'];
    
    if ($ROLE_BASED_ACCESS[$page][$role]) {
      $allowAccess = TRUE;
    }
  } 
  
  if (!$allowAccess) {
    header("Location: Menu.php");
    exit;
    echo "Should not allow acccess to this page!"; 
  }
}

//echo $page; 
?>
