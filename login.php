<?php
require_once 'helpers.php';
if (isset($_GET['login'])) {
  $user = $queries->identify($_POST['id'], $_POST['password']);
  if ($user) {
    $session->user_id = $user->id;
    redirect('list.php');
  } else {
    redirect('loginpage.php');
  }
} elseif (isset($_GET['logout'])) {
  unset($session->user_id);
  redirect('index.php');
} else {
  die('Illegal action');
}
