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
    <title>IEF | News</title>
    
    <!-- Styles  -->
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
        <img id="newsImg"
             src="img\soonbanner.jpg" 
             class="parallaxEffect" 
             alt="image"
        />

        <?php
            $displayid=$_GET["articleid"];
            $query = "SELECT * FROM `news` WHERE articleID ='$displayid'"; //$displayid
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {

                    $title = $row["articleTitle"];
                    $content = $row["articleContent"];
                    $date = $row["articleDate"];
                    $photo = $row["articlePhoto"];
                    $articleid = $row["articleID"];
                    $iddata = $row["articleID"];
                    $displayid=$row["articleid"];
 
                    if (empty($row["articlePhoto"])){
                        $photo = "<img src='img/newsdefaultimg.jpg' style='max-width: 100%; height: auto;'/>"; 
                     } else {
                        $photo = "<img src='useruploads/" . $row['articlePhoto'] . "' style='max-width: 100%; height: auto;'/>";
                     }  

                     //Share link
                     $shareLink = (isset($_SERVER['HTTP']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

                    echo "
                        <div class='contentWrap'>
                            <div class='row'>    
                                <div class='infoBox col-xl-9' id='newsInfoBox'> 
                                    <div id='newsPageBox' class='aboutBox bubble'>
                                        <div class='newsMainPic'>$photo<br><br></div>
                                            <div class='newsMainBody'>
                                            <div align='left'>
                                            <br>
                                            <h1>$title</h1>
                                                <div id='headerHR'></div> 
                                                <br><br>
                                                <small><i class='far fa-calendar-times'></i> ". gmdate("d/m/Y | H:i", strtotime($date)) ." by Inter Ethnic Forum</small>
                                                <hr>
                                                $content
                                                <hr><br>
                                                <iframe src='https://www.facebook.com/plugins/share_button.php?href=".$shareLink."&layout=button&size=small&width=67&height=20&appId' width='67' height='20' style='border:none;overflow:hidden' scrolling='no' frameborder='0' allowTransparency='true' allow='encrypted-media'></iframe>
                                                <a href='".$shareLink."' class='twitter-share-button' data-show-count='false'>Tweet</a><script async src='https://platform.twitter.com/widgets.js' charset='utf-8'></script>
                                            <br><br>
                                                <p>
                                                   <a class='button' href='news.php'>
                                                       <i class='fas fa-chevron-right'></i>
                                                       BACK TO ALL NEWS
                                                   </a>
                                                </p>
                                            <br><hr><br>
                                        </div>
                                    </div>
                        ";
                           }
                        } else {
                            echo "
                                <div class='headerWrap'>    
                                    <h1>No results! <i class='fas fa-exclamation-circle'></i></h1>
                                    <div id='headerHR'></div>
                                </div> 
                                    <hr>
                                    This article doesn't exist
                                <p>
                                    <b>
                                        <a href='news.php'>
                                            Go back
                                        </a>
                                    </b>
                                </p>
                                <br>
                            ";
                        }
            ?> 
                        <br><br>
                    </div> 
                </div>      
 
        <div class="infoBox col-xl-3">         
            <div id="newsPageBox" class="aboutBox bubble">
                <div class='row'>
                    <!-- Grid row-->
                    <div align='left' class=''>
                    <br>
                    <div align='center'>
                        <h5>More news
                            <i class='far fa-newspaper'></i>
                        </h5>
                    </div>
                    <br>
                    <?php
                    $displayid=$_GET["articleid"];
                    $query2 = "SELECT * FROM news WHERE articleID <> '$displayid' ORDER BY articleDate DESC LIMIT 3;";
                    $result2 = mysqli_query($conn, $query2);
                    if (mysqli_num_rows($result2) > 0) {
                        while ($row = mysqli_fetch_assoc($result2)) {

                            $title = $row["articleTitle"];
                            $date = $row["articleDate"];
                            $photo = $row["articlePhoto"];
                            $articleid = $row["articleID"];
                            $iddata = $row["articleID"];
                            $displayid=$row["articleid"];

                            if (empty($row["articlePhoto"])){
                                $photo = "<img src='img/newsdefaultimg.jpg' style='max-width: 100%; height: auto;'/>"; 
                             } else {
                                $photo = "<img src='useruploads/" . $row['articlePhoto'] . "' style='max-width: 100%; height: auto;'/>";
                             }                     

                            echo "
                                <div class='newsPreviewPic'>
                                    <a href='newspage.php?articleid=$articleid'>$photo</a>
                                </div>
                                <div class='newsSidebar'>
                                    <div class='newsSidebarContent'>
                                        <a href='newspage.php?articleid=$articleid'><h5><b>$title</b></h5></a>
                                        <div class='helpBox'></small></div>
                                            <small>"; $content=substr($row['articleContent'], 0, 150); echo" $content...</small>
                                        <h6><a href='newspage.php?articleid=$articleid'><i class='far fa-arrow-alt-circle-right'></i> Read more </a> <small>| <i class='far fa-calendar-times'></i> ". gmdate("d/m/Y", strtotime($date)) ."</small></h6>       
                                        <hr><br>
                                    </div>
                                </div>
                            ";  
                        }      
                    } else {
                            echo "
                                <div class='container'>
                                    <div class='row'>
                                        <div class='newsPreview col-xs-12 mx-auto'> 
                                            <i>
                                                <i class='fas fa-exclamation-circle'></i> 
                                                No Results! 
                                            </i>
                                        </div>
                                    </div>
                                </div>
                            ";
                    }
                    ?>  
                    </div> <!--class sidebar -->
                </div> <!--class row -->
                <br><br>
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

