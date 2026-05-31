<?php 
// User is currently authenticated  and try to logout
if (isset($_COOKIE['username'])) {
  setcookie("username", "", time() - 3600);
  setcookie("role", "", time() - 3600);
  
  setcookie("keywordMenu", "", time() - 3600);
  setcookie("sortMenu", "", time() - 3600);
  
  setcookie("keywordOrder", "", time() - 3600);
  setcookie("sortOrder", "", time() - 3600);

}

header("Location: Menu.php");
exit;
?>
