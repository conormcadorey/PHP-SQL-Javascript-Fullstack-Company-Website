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
    <title>IEF | Edit Staff</title>
    
    <!-- Styles  -->
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

    <link href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.4/croppie.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.4/croppie.js"></script>
    
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
                    $displayid=$_GET["staffid"];
                    $query = "SELECT * FROM `staff` WHERE staffID ='$displayid'";
                    $result = mysqli_query($conn, $query);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {

                            $name = $row["staffName"];
                            $email = $row["staffEmail"];
                            $role = $row["staffRole"];
                            $desc = $row["staffDesc"];
                            $staffid = $row["staffID"];
                            $photo = $row["staffPic"];
                            $iddata = $row["staffID"];
                            $displayid=$row["staffid"];

                            if ($name == "Admin")   {

                                echo"Cannot edit user!";

                            } else if ($name != "Admin") {

                            //display default image if no uploaded profile photo 

                            if (empty($row["staffPic"])){
                                $photo = "<img src='img/profileIcon.png' style='width:95px; height:95px; border-radius: 50%;'/>"; 
                             } else {
                                $photo = "<img src='useruploads/" . $row['staffPic'] . "' style='width:95px; height:95px; border-radius: 50%;'/>";
                             }  
                   
                            echo "

                            <div class='headerWrap'>    
                                <h1>Edit profile, '$name' <i class='far fa-edit'></i></h1>
                                <div id='headerHR'></div>
                            </div> 
                            <br>
                                <b>
                                    <a href='staffportal.php'>Go back</a>
                                </b>
                            <hr><br>
                            <!-- Grid row-->
                            <div class='row'>
                                <div class='col-xl-6'>
                                        <div class='editPanel'>
                                            <h5><b><i class='fas fa-user-alt'></i> Name</b></h5>
                                            <div class='helpBox'></div>
                                            <form action='editstaff.php?staffid=$iddata' 
                                                method='POST' 
                                                id='updateStaffName'
                                            >
                                                <small>
                                                    <div class='alert alert-info' role='alert'>
                                                        First and last name minimum
                                                    </div>
                                                </small>    
                                                <input
                                                    type='text' 
                                                    class='form-control' 
                                                    id='updateStaffNameInput' 
                                                    name='myUpdateStaffName' 
                                                    size='40' 
                                                    maxlength='50' 
                                                    value='$row[staffName]' 
                                                    required
                                                >
                                                    <br>
                                                <input 
                                                    class='btn btn-primary btn-md' 
                                                    type='submit' 
                                                    name='updateStaffNameSubmit' 
                                                    value='Update' 
                                                    id='updateBtn' 
                                                > 
                                                <br><br><hr>
                                            </form>
                                        </div>
                                    </div>

                                    <div class='col-xl-6'>
                                        <div class='editPanel'>
                                            <div class='float-left'>
                                                <h5><b>Profile photo</b></h5>
                                                <div class='helpBox'></div>
                                                <small>
                                                    <div class='alert alert-info col-xs-4' role='alert'>jpg/jpeg or png files only</div>
                                                </small>
                                                <form 
                                                    action='editstaff?staffid=$iddata' 
                                                    method='POST' 
                                                    id='updateStaffPhoto' 
                                                    enctype='multipart/form-data'
                                                >
                                                    <div class='custom-file'>
                                                        <input 
                                                            type='file' 
                                                            class='custom-file-input'
                                                            name='upload_image' 
                                                            id='upload_image'
                                                        >
                                                        <label 
                                                            class='custom-file-label' 
                                                            for='customFile'
                                                        >
                                                            Change photo?
                                                        </label>
                                                        <div id='uploaded_image'></div>
                                                        <br><br>
                                                        <input 
                                                            class='btn btn-primary btn-md' 
                                                            type='submit' 
                                                            name='updateStaffPhotoSubmit' 
                                                            value='Update'
                                                        > 
                                                    </div>
                                                </form>
                                            </div>
                                            <div class='float-right'>
                                                $photo
                                            </div> 
                                        </div>
                                        <div class='w-100 float-right mt-4'>
                                            <hr>
                                        </div> 
                                    </div>
                                    

                                    <div class='col-xl-6'>
                                        <div class='editPanel'>
                                            <h5><b><i class='fas fa-paper-plane'></i> Email</b></h5>
                                            <div class='helpBox'></div>
                                            <form action='editstaff.php?staffid=$iddata' 
                                            method='POST' 
                                            id='updateStaffEmail'
                                            >
                                            <small>
                                                <div class='alert alert-info' role='alert'>
                                                    Please only publish emails ending @interethnicforum.org.uk
                                                </div>
                                            </small>
                                            <input
                                                type='text' 
                                                class='form-control' 
                                                id='updateStaffEmailInput'
                                                name='myUpdateStaffEmail' 
                                                size='40'
                                                maxlength='60' 
                                                value='$email' 
                                                required
                                            /> 
                                                <br> 
                                                <input 
                                                    class='btn btn-primary btn-md' 
                                                    type='submit' 
                                                    name='updateStaffEmailSubmit' 
                                                    value='Update' 
                                                    id='updateBtn'
                                                > 
                                                
                                                &nbsp;&nbsp;
                                                <input 
                                                    class='btn btn-primary btn-md' 
                                                    type='submit' 
                                                    name='removeStaffEmailSubmit' 
                                                    value='Remove Email Address?' 
                                                    id='updateBtn'
                                                > 
                                                <br><br><hr>
                                            </form>
                                        </div>
                                    </div>
   
                                    <div class='col-xl-6'>
                                        <div class='editPanel'>
                                            <h5><b>Job role</b></h5>
                                            <div class='helpBox'></div>
                                            <form action='editstaff.php?staffid=$iddata'
                                            method='POST' 
                                            id='updateStaffJob'
                                            >
                                            <small>
                                                <div class='alert alert-info' role='alert'>
                                                    Employees main job role
                                                </div>
                                            </small> 
                                                <input type='text' 
                                                    class='form-control' 
                                                    id='updateStaffJobInput' 
                                                    name='myUpdateStaffJob' 
                                                    size='40'
                                                    maxlength='60' 
                                                    value='$row[staffRole]' 
                                                    required
                                                /> 
                                                <br>
                                                <input 
                                                    class='btn btn-primary 
                                                    btn-md' 
                                                    type='submit' 
                                                    name='updateStaffJobSubmit' 
                                                    value='Update'
                                                    id='updateBtn' 
                                                > 
                                                <br><br><hr>
                                            </form> 
                                        </div>
                                    </div>
                                
                                    <div class='col-xl-12'>
                                        <div class='editPanel'>
                                            <h5><b>Bio</b></h5>
                                            <div class='helpBox'></div>
                                            <div class='col-xs-12'>  
                                                <form action='editstaff.php?staffid=$iddata' 
                                                    method='POST' 
                                                    id='updateStaffBio'
                                                >                        
                                                    <div class='form-group row'>
                                                        <small>
                                                          <div class='alert alert-info' role='alert'>
                                                              Max length: 1500 characters
                                                          </div>
                                                        </small>
                                                        <span style='width: 100%;'>
                                                            <textarea 
                                                               class='form-control 
                                                               summernote' 
                                                               rows='6' 
                                                               cols='70' 
                                                               id='updateStaffBioInput' 
                                                               name='myUpdateStaffBio' 
                                                               maxlength='1500' 
                                                               required>$row[staffDesc]
                                                            </textarea>  
                                                         </span>
                                                    </div>
                                                    <input 
                                                        class='btn btn-primary btn-md' 
                                                        onclick='updateEvent()' 
                                                        type='submit' 
                                                        name='updateStaffBioSubmit' 
                                                        value='Update'
                                                    >  
                                                </form>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>

                                    <div class='col-xs-12 w-100 pt-4'>
                                        <div class='editPanel'>
                                            <form action='editstaff.php?staffid=$iddata' 
                                                method='POST' 
                                                id='deleteStaff'
                                            >
                                                <br>
                                                <button class='btn btn-primary' 
                                                onclick='adminDeleteEvent()' 
                                                type='submit'
                                                name='myDeleteStaff' 
                                                value=''
                                                > 
                                                    <i class='far fa-trash-alt'></i> Delete Staff Member? 
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    ";
                                    }
                                }
                            } else {
                                echo"
                                    <div class='headerWrap'>    
                                        <h1>No results! <i class='fas fa-exclamation-circle'></i></h1>
                                        <div id='headerHR'></div>
                                    </div> 
                                        <hr>
                                        This profile doesn't exist or has been deleted
                                        <br>
                                      ";
                            }
                        ?>
                        <br>
                        </div> 
                    <div class="pb-2">
                        <b>
                        <a href='staffportal.php'>Go back</a>
                        </b>  
                </div>
            </div>
        </div>     
        
        
        <!--Crop image modal -->
        <div id="insertimageModal" class="modal" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">  
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h5 class="modal-title">Please crop this image before uploading new user.</h5>
                                <br>
                                <button class="btn btn-primary crop_image">Crop Image <i class="fas fa-crop-alt"></i> </button>
                            </div> 
                            <div class="col-md-12 text-center">
                                <br>
                                <div id="image_demo"></div>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
 
    </div>

    <?php include "includes/footer.php" ?> 
    
    <script>   

     const elForms = [...document.querySelectorAll('form')];

     //disable button function
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

     var r =confirm('Are you sure you want to delete this staff member permenantly?');
         if (r==true)    {
             window.location.href = 'server.php';
         } else {
             event.preventDefault();
         }

     }  

    </script>
            
    <script>
    //Display choosen file name in submission form
    $(document).on('change', '.custom-file-input', function (event) {
        $(this).next('.custom-file-label').html(event.target.files[0].name);
    });

    //Validation message fade out
    $(document).ready(function () {
        $("#regerror").delay(3000).fadeOut("slow");
    });
    

    $('.summernote').summernote({
        placeholder: 'required*',
        tabsize: 2,
        height: 250,

        toolbar: [
        //[groupName, [list of button]]
        ['style', ['bold', 'italic', 'underline']],
        ['fontsize', ['fontsize']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ],

        callbacks: {
        onPaste: function (e) {
            var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('text/html');
            e.preventDefault();
            var div = $('<div />');
            div.append(bufferText);
            div.find('*').removeAttr('style');
            setTimeout(function () {
            document.execCommand('insertHtml', false, div.html());
         }, 10);
        }
    }

    });      
    </script>
    
    <script>
       //Parallax image
        var image = document.getElementsByClassName('parallaxEffect');
            new simpleParallax(image, {
            scale: 1.2
    });

    </script>
    
    <script>
    $(document).ready(function() {

    //initial croppie
      $image_crop = $('#image_demo').croppie({
        //enable exif orientation 
        enableExif: true,
        //define cropper viewport
        viewport: {
          width: 200,
          height: 200,
          type: 'square' //circle
        },
        //define outer container of cropper
        boundary: {
          width: 300,
          height: 300
        }
      });

    //on upload image - execute this code
      $('#upload_image').on('change', function() {
         //capture file information
        var reader = new FileReader();
        reader.onload = function(event) {
            //bind image to croppie
            //croppie initialized to image
          $image_crop.croppie('bind', {
            url: event.target.result
          }).then(function() {
            console.log('jQuery bind complete');
          });
        }
        //read contents of selected file
        reader.readAsDataURL(this.files[0]);
        //show modal
        $('#insertimageModal').modal('show');
      });

      //crop image
      //when clicking on button- this code executes
      $('.crop_image').click(function(event) {
        //get cropped image
        $image_crop.croppie('result', {
          type: 'canvas',
          size: 'viewport'
        //callback
        //return cropped image as response and store in db
        }).then(function(response) {
          $.ajax({
            url: 'crop',
            type: 'POST',
            //define what is being sent to server
            data: {
              "image": response
            },
            //callback funtion if request successful
            success: function(data) {
              //hide modal on success
              $('#insertimageModal').modal('hide');
              //get uploaded image
              $('#uploaded_image').html(data);
              //location.reload();
            }
          });
        })
      });
    });

    //resize modal
    $('#insertimageModal').on('show.bs.modal', function () {
           $(this).find('.modal-body').css({
                  width:'auto', //probably not needed
                  height:'auto', //probably not needed 
                  'max-height':'80%'
           });
    }); 

    </script>

  </body> 
</html>


