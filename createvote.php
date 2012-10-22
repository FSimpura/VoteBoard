<?php
require_once 'helpers.php';
check_logging();
for($i = 0; $i <= 10; $i++) {
   $options[] = $_POST[$i];
}
$success = $queries->createvote($_POST['vote_name'], $_POST['vote_desc'], $session->user_id, $_POST['count'], $_POST['end_date'], $options);
if ($success) {
   redirect('success.php');
}
redirect('new.php');

?>
