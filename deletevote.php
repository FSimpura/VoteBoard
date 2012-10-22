<?php
require_once 'helpers.php';
check_logging();
$queries->delete_vote($_GET['id'], $session->user_id);
redirect('list.php');

?>
