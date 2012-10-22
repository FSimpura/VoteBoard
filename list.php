<?php
require_once 'helpers.php';
check_logging();
$open_votes = $queries->open_votes();
$closed_votes = $queries->closed_votes();
$my_votes = $queries->user_votes($session->user_id);
?>
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
      <link rel="stylesheet" type="text/css" href="style.css" />
      <title>VoteBoard</title>
  </head>
  <body>
    <div id="container">
      <div id="body">
        <div id="left"><p><a href="login.php?logout">Log out</a></p></div>
        <div id="topbar">VoteBoard</div>
        <div id="overwrap">
          <div id="wrapper">
            <div id="openvotes">
	       <p>Open votings:</p>
              <ul>
                <?php foreach($open_votes as $vote) { ?><li><a href="vote.php?id=<?php echo $vote->id; ?>"><?php echo safe_echo($vote->name); ?></a> <small><?php echo format_votedate($vote->startdate, $vote->enddate)?></small></li>
                <?php } ?></ul>
            </div>
            <div id="closedvotes">
              <p>Closed votings:</p>
              <ul id="toplists">
                <?php foreach($closed_votes as $vote) { ?><li><a href="vote.php?id=<?php echo $vote->id; ?>"><?php echo safe_echo($vote->name); ?></a> <small> <?php echo format_votedate($vote->startdate, $vote->enddate)?></small></li>
                <?php } ?></ul>
            </div>
          </div>
          <div id="omat">
            <p>My votings: (<a href="new.php">new voting ></a>)</p>
            <ul id="omatlist">
              <?php foreach($my_votes as $vote) { ?><li><a href="vote.php?id=<?php echo $vote->id; ?>"><?php echo safe_echo($vote->name); ?></a> <small><?php echo format_votedate($vote->startdate, $vote->enddate)?></small> <a href="deletevote.php?id=<?php echo htmlentities($vote->id); ?>">X</a></li>
              <?php } ?></ul>
          </div>
        </div>
      </div>
      <div id="footer">
        <?php require 'helper/footer.php'; ?>
      </div>
    </div>
  </body>
</html>
