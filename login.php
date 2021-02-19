<?php 
session_start();
include ("conn.php");
include ("server.php");

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IEF | Login</title>
    
    <!-- Styles  -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.css" />

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/d6cf5ed24c.js" crossorigin="anonymous"></script>    
    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>   
    <!-- Parallax effect -->
    <script src="https://cdn.jsdelivr.net/npm/simple-parallax-js@5.2.0/dist/simpleParallax.min.js"></script>    
    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="styles/styles.css"/>
    
  </head>
  
  <body>
    <?php include "includes/cookies.php" ?> 
    <?php include "includes/header.php" ?> 
    
    <!--Main body content --> 
    <div class="mainBody">
        <img id="aboutImg" 
             style="filter: blur(8px); -webkit-filter: blur(8px);" 
             src="img\adminbanner.jpg" 
             class="parallaxEffect" 
             alt="image"
        />

        <div class="contentWrap">
            <div class="infoBox"> 
                <div id="contentBox" class="aboutBox bubble">
                    <!-- Error validation -->
                        <?php include("errors.php"); ?>

                    <div class="headerWrap">    
                        <h1>Welcome to the IEF Admin Portal</h1>
                        <div id="headerHR"></div>
                    </div>      
                    <hr><br>
                    Please enter a valid email address and password to log in.
                    <!-- Grid row-->
                    <div class="row">    
                        <div class="adminLogin">  
                            <hr>
                            <form id="loginform" method="post" action="login.php">
                                <div class="form-group row">
                                    <div id="adminForm">
                                      <label for="exampleInputEmail1">Email address</label>
                                    </div>
                                    <!--Email user input -->
                                    <input 
                                        name="myemail" 
                                        type="email" 
                                        class="form-control" 
                                        id="exampleInputEmail1" 
                                        aria-describedby="emailHelp" 
                                        placeholder="Enter email" 
                                        required
                                    >
                                    <small 
                                        id="emailHelp" 
                                        class="form-text text-muted"
                                    >
                                        Email address must end @interethnicforum.org.uk
                                    </small>
                                </div>   
                                <div class="form-group row">   
                                    <div id="adminForm">  
                                        <label 
                                            for="exampleInputPassword1"
                                        >
                                            <small><i class="fas fa-lock"></i></small> Password <a href='forgotpassword.php'>(Forgot?)</a>
                                        </label>
                                    </div>
                                    <!--Email user input -->
                                    <input 
                                        name="mypassword" 
                                        type="password" 
                                        class="form-control" 
                                        id="exampleInputPassword1" 
                                        placeholder="Password" 
                                        required
                                    >
                                </div>

                                <div id="loginBtn">             
                                    <button 
                                        name="signin" 
                                        id="loginButton" 
                                        type="submit" 
                                        class="btn btn-primary"
                                    >
                                        Submit
                                    </button>      
                                </div>  
                            </form>  
                            <br><br><br><hr>
                        </div>
                    </div>
                    <hr>
                </div> 
            </div>
        </div>
    </div>
    
    <?php include "includes/footer.php" ?> 
    
    <script>
    //Parallax image
     var image = document.getElementsByClassName('parallaxEffect');
         new simpleParallax(image, {
         scale: 1.2
     });
    </script>
      
  </body>
  
</html>