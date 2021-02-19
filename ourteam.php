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
    <title>IEF | Our Team</title>
    
    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.css" />
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/d6cf5ed24c.js" crossorigin="anonymous"></script>
    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web&display=swap" rel="stylesheet">  
    <!--Ajax/jQuery -->
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
        <img id="aboutImg" style="filter: blur(8px); -webkit-filter: blur(8px);" src="img\ourteambanner.jpg" class="parallaxEffect" alt="image"/>

        <div class='contentWrap'> 
        <?php
            $query = "SELECT * FROM staff;";
                $result = mysqli_query($conn, $query);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $name = $row["staffName"];
                        $email = $row["staffEmail"];
                        $role = $row["staffRole"];
                        $desc = $row["staffDesc"];
                        $photo = $row["staffPic"];

                        if (empty($row["staffPic"])){
                            $photo = "<img src='img/profileIcon.png' style='width:95px; height:95px; border-radius: 50%;'/>"; 
                         } else {
                            $photo = "<img src='useruploads/" . $row['staffPic'] . "' style='width:95px; height:95px; border-radius: 50%;'/>";
                         }

                        echo " 
                        <div class='row'>   
                            
                                <div class='infoBox'>         
                                    <div id='contentBox' class='aboutBox bubble'>
                                        $photo &nbsp;
                                        <div class='headerWrap'>
                                            <div id='headerLink'>
                                            <h1>$name</h1>
                                                <div id='headerHR'></div>
                                            </div>
                                        </div>
                                        <br>
                                        <b>$role</b>
                                        <br>
                                        <i class='fas fa-paper-plane'></i> $email
                                        <br>
                                        <hr>
                                        $desc
                                        <hr>
                                        <br>
                                    </div> 
                                </div>    
                            
                        </div>     
                        ";
                    }

                    } else {

                        echo "
                            <div class='container'>
                                <div class='row'>
                                    <div class='newsPreview col-xs-12 mx-auto'> 
                                        <h5><i>No Results</i></h5>
                                    </div>
                                </div>
                            </div>
                        ";
                    } 
            ?>
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
