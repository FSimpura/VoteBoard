<?php
require_once 'helpers.php';
check_logging();
$success = $queries->givevote($_POST['vote_id'], $_POST['option'], $session->user_id);
if ($success) {
   redirect('success.php');
}
redirect('vote.php?id=' . $_POST['vote_id']);
?>
