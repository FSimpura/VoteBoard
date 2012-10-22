<?php
  require_once 'helpers.php';
  check_logging();
  $vote = $queries->vote($_GET['id']);
  $choices = $queries->choices($_GET['id']);
  $can_vote = ((!$queries->hasvoted($session->user_id, $_GET['id'])) and ($queries->is_open($_GET['id'])));
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
        <p><a href="login.php?logout">Log out</a></p>
        <h2><?php echo safe_echo($vote->name); ?></h2>
        <div id="votewrap">
          <div id="votedesc">
            <p><?php echo safe_echo($vote->descr); ?></p>
          </div>
          <fieldset id="formwrap">
            <form action="givevote.php" method="POST">
              <input type="hidden" name="vote_id" value="<?php echo $vote->id; ?>">
              <?php foreach($choices as $choice) { ?>
                <input type="radio" name="option" <?php if (!$can_vote) { echo 'disabled="disabled"'; } ?> value="<?php echo $choice->id; ?>" /> <?php echo safe_echo($choice->name); ?> <?php if ($queries->showvotes($_GET['id'], $session->user_id)) { echo '(' . $choice->votes . ')'; } ?><br />
              <?php } ?>
              <input type="submit" <?php if (!$can_vote) { echo 'disabled="disabled"'; } ?>  value="Vote" />
            </form>
          </fieldset>
        </div>
      </div>
      <div id="footer">  
        <?php require 'helper/footer.php'; ?>
      </div>
    </div>
  </body>
</html>
