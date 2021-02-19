<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IEF | COVID19</title>
    
    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.css" />
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/d6cf5ed24c.js" crossorigin="anonymous"></script>
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>  
    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Bebas+Neue&display=swap" rel="stylesheet">   
    <!-- Parallax effect -->
    <script src="https://cdn.jsdelivr.net/npm/simple-parallax-js@5.2.0/dist/simpleParallax.min.js"></script>
    
    <link rel="stylesheet" href="styles/styles.css"/>
    <link rel="stylesheet" href="styles/cov.css"/>

  </head>
  
  <body>
    <?php include "includes/cookies.php" ?> 
    <?php include "includes/header.php" ?> 

    <div class="parallax2" id="portalOverflow">
        <div class="container-fluid">
            <div class="row">
                <div class="mx-auto" class="col-md-12 my-auto"> 
                    <h4 class="" id="infographTitle11">
                        <i class="fas fa-viruses"></i> Inter Ethnic Forum Covid-19 Portal
                    </h4>  
                </div>    
            </div>
            
            <div class="row">
                <div class="col-lg cmsInterface" id="cms1" align="center">
                    <h5><a href="covidaware.php"><i class="fas fa-head-side-mask"></i> Protect Yourself</a></h5>
                </div>

                <div class="col-lg  cmsInterface" id="cms2" align="center">
                    <h5><a href="covidshopping.php"><i class="fas fa-shopping-cart"></i> Advice when Shopping</a></h5>
                </div>

                <div class="col-lg  cmsInterface" id="cms3" align="center">
                    <h5><a href="covidresponse.php"><i class="fas fa-hands"></i> Our Response</a></h5>
                </div>   
            </div>
            
            <div class="row">
                <div class="mx-auto" class="col-md-12 my-auto"> 
                    <br>
                    <h5 class="" id="infographTitle11">
                      <a href="https://www.nhs.uk/ask-for-a-coronavirus-test"><i class="fas fa-external-link-alt"></i> Click here to book a Corona Virus test if you are symptomatic. </a>    
                    </h5>  

                </div>
                    <br>
                <div class="mx-auto" class="col-md-12 my-auto"> 
                    <br>
                    <h5 class="" id="infographTitle11">
                      <a href="https://www.publichealth.hscni.net/covid-19-coronavirus/testing-and-tracing-covid-19"><i class="fas fa-external-link-alt"></i> Click here to see more about Contact Tracing if you have COVID-19. </a>    
                    </h5>  
                    <br>
                </div>
            </div>
        </div>
    </div> 
      
    <?php include "includes/footer.php" ?>   

    <script>
    //SMOOTH SCROLL JQUERY   
    $(document).ready(function(){
      // Add smooth scrolling to all links
      $("a").on('click', function(event) {

        // Make sure this.hash has a value before overriding default behavior
        if (this.hash !== "") {
          // Prevent default anchor click behavior
          event.preventDefault();

          // Store hash
          var hash = this.hash;

          // Using jQuery's animate() method to add smooth page scroll
          // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
          $('html, body').animate({
            scrollTop: $(hash).offset().top
          }, 800, function(){

            // Add hash (#) to URL when done scrolling (default click behavior)
            window.location.hash = hash;
          });
        } // End if
      });
    });
    </script>

  </body>
</html>

