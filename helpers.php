<?php

require_once 'helper/queries.php';
require_once 'helper/session.php';


// redirects to given location
function redirect($address) {
  header("Location: $address");
  exit;
}

// checks if there is an user logged in
function has_logged_in() {
  global $session;
  return isset($session->user_id);
}

// ignores logged and redirects anonymous users to the login page
function check_logging() {
  if (!has_logged_in()) {
    redirect('loginpage.php');
  }
}

// formats the given date pair for echos
function format_votedate($start, $end) {
  return '(' . date("d.m.Y", strtotime($start)). ' - ' . date("d.m.Y", strtotime($end)) . ')'; 
}

// makes sure that no html is injected as echos
function safe_echo($message) {
  echo htmlentities($message, ENT_COMPAT | ENT_HTML401, 'UTF-8');
}

?>
