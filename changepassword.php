<?php
session_start();
if(!isset($_SESSION["email"]))  {
   header("location:index.php");
   exit;
} 
include ("conn.php");
include ("server.php");
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IEF | Change Password</title>
    
    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.css" />
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/d6cf5ed24c.js" crossorigin="anonymous"></script>
    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="styles/styles.css"/>

  </head>
  
  <body>
    <?php include "includes/cookies.php" ?> 
    <?php include "includes/header.php" ?>  
      
    <!--Main body content --> 
    <div class="mainBody">
        <img id="aboutImg" src="img\adminbanner.jpg"/>

        <div class="contentWrap">
            <div class="infoBox"> 
                <div id="contentBox" class="aboutBox bubble">
                    <!-- Validation message -->
                    <?php include("errors.php"); ?>

                    <div class="headerWrap">    
                        <h1>Change Password <i class="fas fa-user-cog"></i></h1>
                        <div id="headerHR"></div>
                    </div> 
                    <br>
                        <b>
                            <a href="portal.php">Go back</a>
                        </b>
                    <hr>
                    <p>Please remember to notify all account users after changing your password. </p>
                    <div class="adminLogin"> 
                        <form id="changePassForm" method="post" action="changepassword.php">
                            <small>
                                <div class='alert alert-info' role='alert'>
                                    Use at least one uppercase letter, number and special character (eg: pAssword1!)
                                </div>
                            </small>   
                            <div class="form-group row">
                                <div class="col-xs-6">
                                    <div id="adminForm">
                                    <label>
                                        <small>
                                            <i class="fas fa-lock"></i> New password
                                        </small>
                                    </label>
                                    </div>
                                    <input 
                                        name="myChangePass1" 
                                        type="password" 
                                        class="form-control" 
                                        id="changePass1" 
                                        size="40" 
                                        maxlength="30" 
                                        placeholder="New password" 
                                        required
                                    />
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-xs-6">
                                    <div id="adminForm">
                                        <label>
                                            <small>
                                                <i class="fas fa-lock"></i> Confirm new password
                                            </small>
                                        </label>
                                    </div>
                                <input 
                                    name="myChangePass2"
                                    type="password" 
                                    class="form-control" 
                                    id="changepass2" 
                                    size="40" 
                                    maxlength="30" 
                                    placeholder="Confirm password" 
                                    required
                                />
                                </div>
                            </div>
                            <div id="loginBtn"> 
                                <button 
                                    name="changePassButton" 
                                    id="changePassBtn" 
                                    type="submit" 
                                    class="btn btn-primary"
                                >
                                    Change Password
                                </button>      
                            </div>
                            <br><br><hr>
                        </form>
                    </div>
                </div>
            </div>
        </div> 
    </div>
    
    <?php include "includes/footer.php" ?> 
    
  </body> 
</html>
