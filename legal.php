<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IEF | Legal</title>
    
    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.css" />
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/d6cf5ed24c.js" crossorigin="anonymous"></script>
    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web&display=swap" rel="stylesheet">  
    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>   
    <!-- Parallax effect -->
    <script src="https://cdn.jsdelivr.net/npm/simple-parallax-js@5.2.0/dist/simpleParallax.min.js"></script>
    
    <link rel="stylesheet" href="styles/styles.css"/>
    
  </head>
  
  <body>
    <?php include "includes/cookies.php" ?> 
    <?php include "includes/header.php" ?> 
  
    <!--Main body content --> 
    <div class="mainBody">
        <img id="aboutImg" 
             style="filter: blur(8px); -webkit-filter: blur(8px);" 
             src="img\legalbanner.jpg" 
             class="parallaxEffect" 
             alt="image"
        />

        <div class="contentWrap">
            <div class="infoBox"> 
                <div id="contentBox" class="aboutBox bubble">
                    <div class="headerWrap">
                        <h1>Legal</h1>
                        <div id="headerHR"></div>
                    </div>
                    <hr><br>
                    <p><b>Cookies</b></p>
                    <p>
                        Cookies are text files placed on your computer to collect standard Internet log information and visitor behavior information. When you visit our websites, we may collect information from you automatically through cookies or similar technology
                        For further information, visit 
                        <a href="https://www.allaboutcookies.org">allaboutcookies.org.</a>
                    </p>
                    <p>
                        There are a number of different types of cookies, however, our website uses
                        functionality cookies– We use these cookies so that we recognize you on our website and remember 
                        your previously selected preferences. These could include what language you prefer and location you are 
                        in. A mix of first-party and third-party cookies are used.
                    </p>
                    <p>
                        You can set your browser not to accept cookies, and the above website tells 
                        you how to remove cookies from your browser. However, in a few cases, some of 
                        our website features may not function as a result.
                    </p>
                    <br><hr><br>
                    <p>
                        <b>General</b>
                    </p>
                    <p>
                        Our website contains links to other websites. Our privacy policy applies only 
                        to our website, so if you click on a link to another website, you should read their
                        privacy policy.
                    </p>
                    <p>If you have any questions about our organisations’s privacy policy, the data we
                        hold on you, or you would like to exercise one of your data protection rights, please 
                        do not hesitate to contact us.
                        Email us at: info@interethnicforum.org.uk
                    </p>
                    <p>The organisation name, branding and all content is © <?php echo date("Y"); ?> Copyright to Inter Ethnic Forum 
                        (Mid East Antrim)</p>
                    <br>
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
                    
                

                