<?php
require_once 'helpers.php';
$queries->deletevote($_GET['vote_name'], $_GET['vote_desc'], $session->user_id, $_GET['end_date'], $_GET['A'], $_GET['B'], $_GET['C']);
redirect('list.php');

?>
