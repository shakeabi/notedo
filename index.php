<?php
  include_once("create.php");
  session_start();

  if(!isset($_SESSION['info'])){$_SESSION['info']='';}
  if(!isset($_SESSION['info_l'])){$_SESSION['info_l']='';}

    // session_unset();
    // session_destroy();


 ?>
<!DOCTYPE html>
<html lang="en" >
    <head>
        <meta charset="UTF-8" >
        <title>Note.DO</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="images/icon.png">
        <link rel="stylesheet" type="text/css" href="css/styley.css" >
        <link href="https://fonts.googleapis.com/css?family=Oswald:400,700" rel="stylesheet">
        <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css"
          rel="stylesheet"  type='text/css'>
    </head>
    <body>
        <div class="container" >
            <header >
                <h1>Welcome to <span><strong>Note.DO</strong></span></h1>
            </header>
            <section>
                <div id="container_inner" >

                    <a class="hiddenanchor" id="toregister"></a>
                    <a class="hiddenanchor" id="tologin"></a>
                    <div id="wrapper">
                        <div id="login" class="animate form">
                            <form  action="login.php" autocomplete="off" method="post">
                                <h1>Log in</h1>
                                <p>
                                    <label for="username" class="uname" ><i class="fa fa-user" aria-hidden="true"></i> Your username <span style="color:red;"><?php if($_SESSION['info_l'] !== ''){echo "{$_SESSION['info_l']}";} ?></span> </label>
                                    <input id="username" name="usernamelogin" type="text" placeholder="myusername"  required>
                                </p>
                                <p>
                                    <label for="password" class="youpasswd" ><i class="fa fa-key" aria-hidden="true"></i> Your password </label>
                                    <input id="password" name="passwordlogin" type="password" pattern=".{8,}" placeholder="atleast 8 characters"  required>
                                </p>

                                <p class="login button">
                                    <input type="submit" value="Login" name="login">
								                </p>
                                <p class="change_link">
									                Not a member yet ?
									              <a href="#toregister" class="to_register"> Register </a>
								                </p>
                            </form>
                        </div>

                        <div id="register" class="animate form">
                            <form  action="register.php" autocomplete="off" method="post">
                                <h1> Sign up </h1>
                                <p>
                                    <label for="usernamesignup" class="uname" ><i class="fa fa-user" aria-hidden="true"></i> Your username</label>
                                    <input id="usernamesignup" name="usernamesignup" type="text" placeholder="myusername"  required>
                                </p>
                                <p>
                                    <label for="emailsignup" class="youmail" ><i class="fa fa-envelope" aria-hidden="true"></i> Your email</label>
                                    <input id="emailsignup" name="emailsignup" type="email" placeholder="mymail@gmail.com"  required>
                                </p>
                                <p>
                                    <label for="passwordsignup" class="youpasswd" ><i class="fa fa-key" aria-hidden="true"></i> Your password <span style="color:red;"><?php if($_SESSION['info'] !== '' ){echo ": {$_SESSION['info']}";} ?></span></label>
                                    <input id="passwordsignup" name="passwordsignup" type="password" pattern=".{8,}" placeholder="atleast 8 characters"  required>
                                </p>
                                <p>
                                    <label for="passwordsignup_confirm" class="youpasswd" ><i class="fa fa-key" aria-hidden="true"></i> Please confirm your password </label>
                                    <input id="passwordsignup_confirm" name="passwordsignup_confirm" type="password" pattern=".{8,}" placeholder="atleast 8 characters"  required>
                                </p>
                                <p class="signin button">
									                         <input type="submit" value="Sign up" name="register">
								                </p>
                                <p class="change_link">
									                         Already a member ?
									                        <a href="#tologin" class="to_register"> Log in </a>
								                </p>
                            </form>
                        </div>

                    </div>
                </div>
            </section>

              <div class="foot" style="margin: 20px;">
                Made with &#10084; by <a href="https://github.com/shakeabi">Abishake</a>
              </div>
        </div>

    </body>
</html>
