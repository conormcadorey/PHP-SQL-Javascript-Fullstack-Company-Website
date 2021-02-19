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
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>IEF | Login</title>
    
    <!-- Styles 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/skeleton/2.0.4/skeleton.min.css"> -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.css" />

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/d6cf5ed24c.js" crossorigin="anonymous"></script>
    
    <!-- Menu Bar 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->

    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="styles/styles.css"/>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
  </head>
  
<body>

      <!--Continuous background for main navigation menu -->

      <div id="headerBackground"></div> 
      
      <!--Main header content -->
      <div class="headerMain">
                
      <!--Set navigation design theme -->
      <nav class="navbar navbar-light bg-light">
        <!--Place navigation to the left -->
        <a href="index.php" class="navbar-brand"><img align="right" src ="img\logomain2.png"/></a>
        
        <!--Main menu Address/Telephone ('d-none d-sm-block'- text does not display on xs-screens) -->
        <small><p class="navbar-text d-none d-sm-block" id="headerText"><i class="fas fa-home"></i> 20 WILLIAM ST, BALLYMENA | <i class="fas fa-phone-square-alt"></i> 028 2564 8822 </p></small>
        
        <!--Hamburger icon -->
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!--Create mobile-optimised menu -->
        <div class="collapse navbar-collapse" id="navbarMenu">
            
            <!--Class holds menu items -->
            <ul class="navbar-nav">
                <li class="nav-item">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="news.php">News</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="events.php">Events</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.html">What We Do</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="ourteam.php">Our Team</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="gallery.php">Gallery</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="findUs.html">Find Us</a>
                        </li>
            </ul>
        </div>

    </nav>
      
    <!--main menu scripts -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
        
    </div>   
      
  
<!--Main body content --> 
<div class="mainBody">

    <img id="aboutImg" src="img\adminbanner.jpg"/>
    
    <div class="contentWrap">
    
    <div class="infoBox"> 
                
        <div id="contentBox" class="aboutBox bubble">
            
            <div class="headerWrap">    
                <h1>Reset password</h1>
                <div id="headerHR"></div>
                </div>      
            <hr>   
            <br>
            
            <?php 
            
            $selector = $_GET["selector"];
            $validator = $_GET["validator"];
            
            //Check if tokens exist inside url 
            if (empty($selector) || empty($validator))  {
                
                echo "Could not validate your request!";
                
            } else {
                
                //check if correct type of token inside url
                if (ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false) {
            ?>
            
            <div class="adminLogin"> 
                <form id="changePassForm" method="post" action="server.php">
                    
                    <small><div class='alert alert-info' role='alert'>Use at least one uppercase letter, number and special character (eg: pAssword1!)</div></small>   
                
                    <input type="hidden" name="selector" value="<?php echo $selector ?>">
                    <input type="hidden" name="validator" value="<?php echo $validator ?>">
                    
                    <div class="form-group row">
                    <div class="col-xs-6">
                    <div id="adminForm">
                    <label><small><i class="fas fa-lock"></i> New password</small></label>
                    </div>
                    <input name="pwd" type="password" class="form-control" id="changePass1" size="40" maxlength="30" placeholder="New password" required/>
                    </div>
                    </div>
                
                    <div class="form-group row">
                    <div class="col-xs-6">
                    <div id="adminForm">
                    <label><small><i class="fas fa-lock"></i> Confirm new password</small></label>
                    </div>
                    <input name="pwd-repeat" type="password" class="form-control" id="changepass2" size="40" maxlength="30" placeholder="Confirm password" required/>
                    </div>
                    </div>
                           
                    <div id="loginBtn"> 
                        <button name="createPasswordSubmit" id="changePassBtn" type="submit" class="btn btn-primary">Reset Password</button>      
                    </div>
                        
                    <br>
                    <br>
                    <hr>
                   
            </form>
            </div>
            
            <?php
                    
                }
                
            }
            
            ?>
                
            <br><b><a href='login.php'>Go back</a></b>
            <br>
            <br>
            <hr>
            
        </div> 
        
    </div>
        
    </div>

 
    <!--Cookie consent -->  
    <script src="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.js" data-cfasync="false"></script>
        
        <script>
            window.cookieconsent.initialise({
            "palette": {
              "popup": {
                "background": "#343c66",
                "text": "#cfcfe8"
                },
               "button": {
              "background": "#f71559"
             }
            }
           });
        </script>
      
</div>
    
    
<!-- Footer -->
<footer class="page-footer font-family-helvetica font-small cyan darken-3">

  <!-- Footer Elements 
  <div class="container">-->
  
  <div class="footerBody">
  
    <!-- Grid row-->
    <div class="row">
        
        <div id="footerAddress" align="center" class="col-lg-2">
            
            <!-- Address -->
            
        <h6 class="font-weight-bold text-uppercase mt-3 mb-4">Address</h6>
        
        <p>20 William Street<br>Ballymena<br>Co Antrim<br>BT43 6AW</p>
        
        </div>
        
        
        <div id="footerEmail" align="center" class="col-lg-4">
            
            <!-- Email Contact -->
        <h6 class="font-weight-bold text-uppercase mt-3 mb-4">Email</h6>
        
        <p>Ivy Goddard:<br>Ivy.goddard@interethnicforum.org.uk<br>Natasha Taylor:<br>Natasha.taylor@interethnicforum.org.uk</p>
            
        </div>
        
               
        <div id="footerPhone" align="center" class="col-lg-2">
            
            <!-- Telephone -->
        <h6 class="font-weight-bold text-uppercase mt-3 mb-4">Telephone</h6>
        
        <p>028 2564 8822</p>
            
        </div>
        
        
        <div id="footerOpen" align="center" class="col-lg-2">
            
            <!-- Opening Hours -->
        <h6 class="font-weight-bold text-uppercase mt-3 mb-4">Opening Hours</h6>
        
        <p>Mon - Fri: 9 - 5</p>
            
        </div>
        
        
        <div id="footerMEA" align="center" class="col-lg-2">
            
            <!-- Ballymena Council -->
                <a href="https://www.midandeastantrim.gov.uk"><img src="img\council.png"/></a>
            
        </div>

      <!-- Social Media links -->
      <div id="footerSocial" align="center" class="col-lg-12 py-4">

          <hr class="footerHR">
          
          <br>
          <!-- Facebook -->
          <a class="fb-ic" href="https://www.facebook.com/InterEthnicForum/">
            <i class="fab fa-facebook-f fa-lg white-text fa-2x"> </i>
          </a>
          &nbsp;&nbsp;
          <!-- Twitter -->
          <a class="tw-ic" href="https://twitter.com/inter_ethnic?lang=en">
            <i class="fab fa-twitter fa-lg white-text fa-2x"> </i>
          </a>
          &nbsp;&nbsp;
          <!--Instagram-->
          <a class="ins-ic">
            <i class="fab fa-instagram fa-lg white-text fa-2x"> </i>
          </a>

      </div>
      
      
  <br>
  
  <!--Language API-->
  <div id="footerLang" align="center" class="col-lg-12">
                
        <div id="google_translate_element" align="center"><div id="fflags" align="center"><img src ="img\flags.png"/></div></div>
        <br>
  </div>
  
  <!-- Copyright -->
  <div id="footerLegal" align="center" class="col-lg-12">© 2019 Copyright:
      Mid & East Antrim Inter Ethnic Forum | <a href="legal.html">  Legal </a> | <a href="login.php"> Admin </a>
      <br>
      Inter Ethnic Forum (Mid & East Antrim) is registered with The Charity Commission for Northern Ireland (NIC102690) and a Company Limited by Guarantee (NI067175)
      <br>
      <br>
  </div>
  
  
      <!-- Grid column -->

    <!--   
    </div> -->
    <!-- Grid row-->

  </div>
  <!-- Footer Elements -->

  </div>
  
</footer>
<!-- Footer -->

<script type="text/javascript">
                    function googleTranslateElementInit() {
                    new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
                    }
                </script>

                <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    
  </body>
  
</html>

