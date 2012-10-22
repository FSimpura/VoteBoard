<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <link rel="stylesheet" type="text/css" href="style.css" />
      <title>VoteBoard - Login</title>
  </head>
  <body>
    <div id="container">
      <div id="body">
        <div id="topbar">VoteBoard</div>
        <div id="overwrap">
          <div id="loginbox">
            <legend>Login</legend>
            <form action="login.php?login" method="POST"> 
              <p><label for="id">Username:</label>
                <input type="text" name="id" id="id" /></p>
              <p><label for="password">Password:</label>
                <input type="password" name="password" id="password" /></p>
              <div id="left"><p><input type="submit" value="Log in" /></p></div><div id="right"><p>(or <a href="registerpage.php">Register ></a>)</p></div>
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
