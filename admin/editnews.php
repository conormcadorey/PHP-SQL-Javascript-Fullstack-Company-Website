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
    <title>IEF | Edit News</title>
    
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
                    $displayid=$_GET["articleid"];
                    $query = "SELECT * FROM `news` WHERE articleID ='$displayid'";
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

                            echo " 

                            <div class='headerWrap'>    
                                <h1>Edit article, '$title' <i class='far fa-edit'></i></h1>
                                <div id='headerHR'></div>
                            </div> 
                            <br>
                                <b>
                                    <a href='newsportal.php'>Go back</a>
                                </b>
                            <hr><br>
                            <!-- Grid row-->
                            <div class='row'>
                                <div class='col-xl-4'>
                                    <div class='col-xl-12'>
                                        <div class='editPanel'>
                                            <h5><b><i class='far fa-newspaper'></i> Title</b></h5>
                                            <div class='helpBox'></div>
                                            <form action='editnews.php?articleid=$iddata' 
                                                method='POST' 
                                                id='updateArticleTitle'
                                            >
                                            <small>
                                                <div class='alert alert-info' role='alert'>
                                                    Max length: 150 characters
                                                </div>
                                            </small>    
                                            <input type='text' 
                                                class='form-control' 
                                                id='updateArticleTitleInput' 
                                                name='myUpdateArticleTitle' 
                                                size='60' 
                                                maxlength='150' 
                                                value='$row[articleTitle]' 
                                                required>
                                                <br>
                                                <input 
                                                    class='btn btn-primary btn-md float-left' 
                                                    type='submit' 
                                                    name='updateArticleTitleSubmit' 
                                                    value='Update' 
                                                    id='updateBtn' 
                                                    disabled
                                                > 
                                                <br><br><hr>
                                            </form>
                                        </div>
                                    </div>
                                    
                                    <div class='col-xl-12'>
                                        <div class='editPanel'>
                                            <h5><b>Image</b></h5>
                                            <div class='helpBox'></div>
                                                <form action='editnews?articleid=$iddata' 
                                                    method='POST' 
                                                    id='updateArticlePhoto' 
                                                    enctype='multipart/form-data'
                                                >
                                                    <div class='form-group row'>      
                                                        <div style='margin-bottom: 1em;'>
                                                            $photo
                                                        </div>
                                                            <div class='alert alert-info w-100' role='alert'>
                                                                <small>
                                                                    jpg/jpeg or png files only
                                                                </small>
                                                            </div>
                                                        </small>
                                                        <div class='custom-file'>
                                                            <input 
                                                                type='file' 
                                                                class='custom-file-input' 
                                                                name='myUpdateArticlePhoto' 
                                                                id='articlePhoto'
                                                            >
                                                            <label class='custom-file-label' for='customFile'>Choose image</label>
                                                            <div id='uploaded_image'></div>
                                                            <br><br>
                                                            <input class='btn btn-primary btn-md float-left' 
                                                                type='submit' 
                                                                name='updateArticlePhotoSubmit' 
                                                                value='Update'
                                                            > 
                                                        </div>
                                                    </div>
                                                    <br>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                
                                    <div class='col-xl-8'>
                                        <div class='col-xl-12'>
                                            <div class='editPanel'>
                                                <h5><b>Main content</b></h5>
                                                <div class='helpBox'></div>
                                                <div class='col-xs-12'>  
                                                    <form action='editnews.php?articleid=$iddata' 
                                                        method='POST' 
                                                        id='updateArticleContent'
                                                    >                        
                                                        <div class='form-group row'>
                                                            <small>
                                                              <div class='alert alert-info' role='alert'>
                                                                  Max length: 3500 characters
                                                              </div>
                                                            </small>
                                                            <span style='width: 100%;'>
                                                                <textarea 
                                                                    rows='20' 
                                                                    cols='100'
                                                                    id='updateArticleContentInput' 
                                                                    class='form-control 
                                                                    summernote' 
                                                                    name='myUpdateArticleContent' 
                                                                    maxlength='3500' 
                                                                    required>$row[articleContent]
                                                                </textarea>  
                                                             </span>
                                                        </div>
                                                        <input class='btn btn-primary btn-md' 
                                                               onclick='updateEvent()' 
                                                               type='submit' 
                                                               name='updateArticleContentSubmit' 
                                                               value='Update'
                                                        > 
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class='col-xs-12 w-100 pt-4'>
                                        <div class='editPanel'>
                                            <hr>
                                            <form action='editnews.php?articleid=$iddata'
                                                method='POST' 
                                                id='deleteArticle'
                                            >
                                                <br>
                                                    <button class='btn btn-primary' 
                                                    onclick='adminDeleteEvent()' 
                                                    type='submit' 
                                                    name='myDeleteArticle' 
                                                    value=''
                                                    > 
                                                        <i class='far fa-trash-alt'></i> Delete Article? 
                                                    </button>
                                            </form>
                                        </div>
                                    </div>
                                ";
                                }
                            } else {
                                echo"
                                    <div class='headerWrap'>    
                                        <h1>No results! <i class='fas fa-exclamation-circle'></i></h1>
                                        <div id='headerHR'></div>
                                    </div> 
                                        <hr>
                                        This article doesn't exist or has been deleted
                                        <br>
                                      ";
                            }
                        ?>
                        <br>
                </div> 
                    <div class="pb-2">
                        <b>
                        <a href='newsportal.php'>Go back</a>
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
    //Parallax image
     var image = document.getElementsByClassName('parallaxEffect');
         new simpleParallax(image, {
         scale: 1.2
    });
    </script>
        
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
    //Display choosen file name in submission form
    $(document).on('change', '.custom-file-input', function (event) {
        $(this).next('.custom-file-label').html(event.target.files[0].name);
    })

    //Validation message fade out
    $(document).ready(function () {
        $("#regerror").delay(3000).fadeOut("slow");
    });

    $('.summernote').summernote({
        placeholder: 'required*',
        tabsize: 2,
        height: 450,

        toolbar: [
        // [groupName, [list of button]]
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
    $(document).ready(function() {

      $image_crop = $('#image_demo').croppie({
        //enable exif orientation 
        enableExif: true,
        //define cropper viewport
        viewport: {
          width: 300,
          height: 200,
          type: 'square' //circle
        },
        //define outer container of cropper
        boundary: {
          width: 300,
          height: 300
        }
      });

      $('#articlePhoto').on('change', function() {
        var reader = new FileReader();
        reader.onload = function(event) {
          $image_crop.croppie('bind', {
            url: event.target.result
          }).then(function() {
            console.log('jQuery bind complete');
          });
        }
        //read selected file
        reader.readAsDataURL(this.files[0]);
        //show modal
        $('#insertimageModal').modal('show');
      });

      //crop image
      $('.crop_image').click(function(event) {
        //get cropped image
        $image_crop.croppie('result', {
          type: 'canvas',
          size: 'viewport'
        //return cropped image and store in db
        }).then(function(response) {
          $.ajax({
            url: 'crop',
            type: 'POST',
            data: {
              "image": response
            },
            //call funtion if request successful
            success: function(data) {
              //hide modal on success
              $('#insertimageModal').modal('hide');
              //load_images();
              //alert(data);
            }
          })
        });
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
