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
    <title>IEF | Edit Admin</title>
    
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

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote-bs4.min.js"></script>

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

                    <?php
                    $displayid=$_GET["adminid"];
                    $query = "SELECT * FROM `users` WHERE userID ='$displayid'";
                    $result = mysqli_query($conn, $query);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {

                            $adminName = $row["username"];
                            $adminEmail = $row["email"];
                            $adminStatus = $row["admin"];
                            $adminid = $row["userID"];
                            $iddata = $row["userID"];
                            $displayid=$row["adminid"];

                            if($displayid == "1") {
                                header("Location: adminportal.php");   
                            }

                            echo "
                            <div class='headerWrap'>    
                                <h1>Edit admin, '$adminName' <i class='far fa-edit'></i></h1>
                                <div id='headerHR'></div>
                            </div> 
                            <br><b><a href='adminportal.php'>Go back</a></b>

                            <hr><br>

                            <!-- Grid row-->
                            <div class='row'>
                            <div id='formAdmin' align='left' class='col-lg-6'>

                            <br>
                            <b>Username</b>  
                            <br>
                            <div class='helpBox'></div>
                                <form action='editadmin.php?adminid=$iddata' 
                                method='POST' 
                                id='updateAdminName'
                                >
                                    <div class='form-group row'>
                                        <input class='form-control' 
                                        type='text' 
                                        id='updateAdminName' 
                                        name='myUpdateAdminName' 
                                        size='40' 
                                        maxlength='40' 
                                        value='$row[username]' 
                                        required
                                        >
                                    </div>
                                    
                                    <input class='btn btn-primary btn-sm' 
                                    type='submit' 
                                    name='updateAdminNameSubmit' 
                                    value='Update' 
                                    id='updateBtn' 
                                    disabled> 
                                </form>

                                <br><hr><br>

                                <b>Email</b> 
                                <br>
                                <div class='helpBox'></div>
                                    <form action='editadmin.php?adminid=$iddata' method='POST' id='updateAdminEmail'>
                                        <div class='form-group row'>
                                          <small>
                                            <div class='alert alert-info' role='alert'>
                                                Please enter an @interethnicforum.org.uk email address
                                            </div>
                                          </small>
                                            <input class='form-control' 
                                            type='text' 
                                            id='updateAdminEmail' 
                                            name='myUpdateAdminEmail' 
                                            size='40' 
                                            maxlength='40' 
                                            value='$row[email]' 
                                            required>
                                        </div>

                                        <input class='btn btn-primary btn-sm' 
                                        type='submit' 
                                        name='updateAdminEmailSubmit' 
                                        value='Update' 
                                        id='updateBtn' 
                                        disabled
                                        > 
                                    </form>
                            </div>

                            <br><hr>

                            <!-- Grid row-->
                            <div id='formAdmin' align='left' class='col-lg-6'>

                            <br>
                            <b>Change password</b> 
                            <br>
                                <div class='helpBox'></div>
                                <form action='editadmin.php?adminid=$iddata' 
                                    method='POST' 
                                    id='updateAdminPassword'
                                >

                                <small>
                                    <div class='alert alert-info' role='alert'>
                                        Use at least one uppercase letter, number and special character (eg: pAssword1!)
                                    </div>
                                </small> 
                                <input class='form-control' 
                                        type='password' 
                                        id='updateAdminPassword' 
                                        name='myUpdateAdminPassword' 
                                        size='40' 
                                        maxlength='30' 
                                        placeholder='required*' 
                                        required
                                /> 

                                <hr>

                                <b>Confirm password</b>  
                                <br>
                                <div class='helpBox'></div>
                                <br>
                                <input class='form-control' 
                                    type='password' 
                                    id='updateAdminPasswordConfirm' 
                                    name='myUpdateAdminPasswordConfirm' 
                                    size='40' 
                                    maxlength='30' 
                                    placeholder='required*' 
                                    required
                                /> 

                                <hr>

                                <input class='btn btn-primary btn-sm' 
                                    type='submit' 
                                    name='updateAdminPasswordSubmit' 
                                    value='Update' 
                                    id='updateBtnMulti' 
                                    disabled='disabled'
                                > 
                                </form>
                                </div>

                                <br><hr><hr><br>

                                <div id='formAdmin' align='left' class='col-lg-12'>
                                <br>
                                <hr>
                                <form action='editadmin.php?adminid=$iddata' 
                                    method='POST'
                                    id='deleteAdmin'>
                                    <br>
                                    <button class='btn btn-primary' 
                                        onclick='adminDeleteEvent()' 
                                        type='submit' 
                                        name='myDeleteAdmin' 
                                        value=''
                                    > 
                                        <i class='far fa-trash-alt'></i> Delete Admin? 
                                    </button>
                                    <br><br><hr>
                                </form>
                                </div>
                            </div>

                            <br>

                            <p>
                                <b>
                                    <a href='adminportal.php'>Go back</a>
                                </b>
                            </p> 
                            ";
                        }

                    } else {

                        echo" <div class='headerWrap'>    
                                <h1>No results! <i class='fas fa-exclamation-circle'></i></h1>
                                <div id='headerHR'></div>
                              </div> 
                              <hr>
                                This admin doesn't exist or has been deleted
                              <p>
                                <b>
                                    <a href='adminportal.php'>Go back</a>
                                </b>
                              </p>
                              <br>";
                    }

                    ?>                     

                </div> 
            </div>
        </div>
    </div>
    
    <?php include "includes/footer.php" ?> 

    <script>   

     //Input validation and confirmaton alert 
     // getting all forms
     const elForms = [...document.querySelectorAll('form')];

     // looping an array
     elForms.map(elForm => {
     // Get your DOM references just once, not every time the function runs
     const elInput  = elForm.querySelector(`input[type='text']`);
     const elButton = elForm.querySelector(`input[type='submit']`);

     // Set up event handlers in JavaScript
     elForm.addEventListener('submit', (event) => validationCheck(event, elInput, elButton)); // passing parameters
     elInput.addEventListener('keyup', (event) => validationCheck(event, elInput, elButton)); // passing parameters
     });

         function validationCheck(event, elInput, elButton) {
             if(elInput.value==='') { 
         elButton.disabled = true; 
             } else { 
         elButton.disabled = false;

         //Confirmation window
         if(event.type === 'submit'){
             //Confirmation window
             var r =confirm('Do you want to update this item?');
                 if (r==true)    {
                     window.location.href = 'server.php';
                 } else {
                     event.preventDefault();
                 }
             }
         }
     }


     //Basic confirmation alert
     function updateEvent() {

     var r =confirm('Do you want to update this item?');
         if (r==true)    {
             window.location.href = 'server.php';
         } else {
             event.preventDefault();
         }

     }  


     //Basic delete alert
     function adminDeleteEvent() {

     var r =confirm('Are you sure you want to delete this news article permenantly?');
         if (r==true)    {
             window.location.href = 'server.php';
         } else {
             event.preventDefault();
         }

     }  

     </script>     

    <script>
    (function() {
        $('form > input').keyup(function() {

            var empty = false;
            $('form > input').each(function() {
                if ($(this).val() == '') {
                    empty = true;
                }
            });

            if (empty) {
                $('#updateBtnMulti').attr('disabled', 'disabled');
            } else {
                $('#updateBtnMulti').removeAttr('disabled');
            }
        });
    })()

    </script>

    <script>
    //Validation message fade out
    $(document).ready(function () {
        $("#regerror").delay(3000).fadeOut("slow");
    });
    </script>
    
  </body>  
</html>
