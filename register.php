<?php
require_once 'helpers.php';
if ($_POST['password1'] == $_POST['password2']) {
   $success = $queries->register($_POST['id'], $_POST['password1']);
   if ($success) {
      redirect('success.php');
   }
}
redirect('registerpage.php');
?>

