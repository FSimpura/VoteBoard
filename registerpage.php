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
            <legend>Register</legend>
         <form action="register.php" method="POST"> 
            <p><label for="id">Username:</label>
               <input type="text" name="id" id="id" /></p>
            <p><label for="password1">Password:</label>
               <input type="password" name="password1" id="password1" /></p>
            <p><label for="password2">Retype password:</label>
               <input type="password" name="password2" id="password2" /></p>
            <p><input type="submit" value="Register" /></p>
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
