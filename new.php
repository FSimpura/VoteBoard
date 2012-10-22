<?php
  require_once 'helpers.php';
  check_logging();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="style.css" />
    <title>VoteBoard - New voting</title>
    <script language="javascript">
      fields = 0;
      function addInput() {
        if (fields < 10) {
          document.getElementById('choices').innerHTML += "<p><label for='choices'>Option " + (fields+1) + "</label><input type='text' name='" + fields + "'/></p>";
          fields += 1;
        } if (fields == 10) {
          document.getElementById('choices').innerHTML += "<br />Maximum 10 fields allowed.";
          fields += 1;
        } else {
          document.form.add.disabled=true;
        }
      }
    </script>
  </head>
  <body>
    <div id="container">
      <div id="body">
        <div id="left"><p><a href="login.php?logout">Log out</a></p></div>
        <div id="topbar">VoteBoard</div>
        <div id="overwrap">
          <div id="newvoting">
            <legend>New voting</legend>
            <form action="createvote.php" method="POST"> 
              <div id="right">
                <input type="checkbox" name="count" id="count" /> Show counts<br /> 
              </div>
              <p><label for="vote_name">Voting name:</label>
                <input type="text" name="vote_name" id="vote_name" /></p>
              <div id="createvote">
                <label for="end_date">End date:</label>
                <input type="text" name="end_date" id="end_date" /><small>(dd-mm-yyyy ss:mm:hh)</small>
                <p><textarea name="vote_desc" cols="23" rows="16">Description...</textarea></p>
              </div>
              <div id="choices">    
              </div>
              <input type="button" onclick="addInput()" name="add" value="New option" />
              <input type="submit" value="Create" />
            </form>
          </div>
        </div>
      </div>
      <div id="footer">
        <?php require 'helper/footer.php'; ?>
      </div>
    </div>
  </body>
</html>