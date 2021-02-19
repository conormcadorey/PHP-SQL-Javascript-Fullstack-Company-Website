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
    <title>IEF | Add/Edit Admin</title>
    
    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.css" />
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/d6cf5ed24c.js" crossorigin="anonymous"></script>   
    <!-- Parallax effect -->
    <script src="https://cdn.jsdelivr.net/npm/simple-parallax-js@5.2.0/dist/simpleParallax.min.js"></script>
    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web&display=swap" rel="stylesheet">

    <!--Summernote- -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="styles/styles.css"/>
       
  </head>
  
  <body>
    <?php include "includes/adminheader.php" ?>  
      
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
                    <!-- Validation message -->
                    <?php include("errors.php"); ?>
                    <div class="headerWrap">    
                        <h1>Add or Edit Admin Users <i class="fas fa-user-cog"></i></h1>
                        <div id="headerHR"></div>               
                        <br>
                    </div> 
                    <br><b><a href='portal.php'>Go back</a></b>
                    <hr>
                    <!-- Grid row-->
                    <div class="row">
                        <div align="left" class="col-lg-6">
                            <br>
                            <div align='center'>
                                <h3>Create new Admin </h3>
                            </div> 
                            <br>
                            <div class="adminForm">
                                <form id="newAdmin" 
                                      method="POST" 
                                      action="adminportal.php" 
                                      enctype="multipart/form-data"
                                >    
                                    <hr>     
                                    <b>Admin email:</b>  
                                    <br>
                                    <div class='helpBox'></div>
                                    <br>
                                    <div class="form-group row">
                                        <small>
                                            <div class='alert alert-info' 
                                                 role='alert'
                                            >
                                                Enter an @interethnicforum.org.uk email
                                            </div>
                                        </small>
                                        <input 
                                            class="form-control" 
                                            type="email" 
                                            id="adminEmail" 
                                            name="myAdminEmail" 
                                            size="40" 
                                            maxlength="55" 
                                            placeholder="required*" 
                                            required
                                        /> 
                                    </div>
                                    <hr>
                                    <b>Admin username:</b>  
                                    <br>
                                    <div class='helpBox'></div>
                                    <br>
                                    <div class="form-group row">
                                        <input 
                                            class="form-control" 
                                            type="text" 
                                            id="adminName" 
                                            name="myAdminName" 
                                            size="40" 
                                            maxlength="20" 
                                            placeholder="required*" 
                                            required
                                        /> 
                                    </div>
                                    <hr>
                                    <b>Password:</b>  
                                    <br>
                                    <div class='helpBox'></div>
                                    <br>
                                        <div class="form-group row">
                                            <small>
                                                <div class='alert alert-info' 
                                                     role='alert'
                                                >
                                                    Use at least one uppercase letter, number and special character (eg: pAssword1!)
                                                </div>
                                            </small> 
                                            <input 
                                                class="form-control" 
                                                type="password" 
                                                id="adminPassword" 
                                                name="myAdminPassword" 
                                                size="40" 
                                                maxlength="30" 
                                                placeholder="required*" 
                                                required
                                            /> 
                                        </div>
                                    <hr>
                                    <b>Confirm password:</b>  
                                    <br>
                                    <div class='helpBox'></div>
                                    <br>
                                    <div class="form-group row">
                                        <input 
                                            class="form-control" 
                                            type="password" 
                                            id="adminPasswordConfirm" 
                                            name="myAdminPasswordConfirm" 
                                            size="40" 
                                            maxlength="30" 
                                            placeholder="required*" 
                                            required
                                        /> 
                                    </div>
                                    <hr><br>
                                    <div id="loginBtn" class="float-left"> 
                                        <button 
                                            name="newAdminBtn" 
                                            id="newAdminButton" 
                                            onclick="return confirm('Create new admin?');" 
                                            type="submit" 
                                            class="btn btn-primary"
                                        >
                                            Create Admin &nbsp;<i class='far fa-edit'></i>
                                        </button>    
                                    </div>
                                    <div class="w-100 pt-4"><br><br><hr></div>
                                </form>
                            </div>
                        </div>
                        <div  align="left" class="col-lg-6">
                            <br>
                            <div align='center'>
                                <h3>Edit existing Admin </h3>
                            </div> 
                            <br><hr>
                            Below is a list of authorised Admin users with access to the Central Management System.
                            <div class='row' id='pagination_data'>    
                                <!--Fetch and display events from database --> 
                                <?php ?>  
                            </div>
                        </div>
                    </div>
                    <hr><br>
                    <p>
                        <b>
                            <a href='portal.php'>Go back</a>
                        </b>
                    </p>
                    <br>
                </div>
                </div> 
            </div>
        </div>
    </div>

    <?php include "includes/footer.php" ?> 
    
     <script>
    $(document).ready(function(){
        //when fucntion is called fetch data
        load_data();
        function load_data(page)
        {
            $.ajax({
                url:"paginationPortalAdmin.php",
                method: "POST",
                data:{page:page},
                success:function(data){
                    
                    $('#pagination_data').html(data);
                }
            })
        }
        $(document).on('click', '.pagination_link', function()  {
            
            var page = $(this).attr("id");
            load_data(page);
            $('html, body').animate({ scrollTop: 0 }, 'slow');
        });
    });   
    </script>
    
    <script>
    //Parallax image
     var image = document.getElementsByClassName('parallaxEffect');
         new simpleParallax(image, {
         scale: 1.2
    });
    </script>
     
  </body>
</html>
