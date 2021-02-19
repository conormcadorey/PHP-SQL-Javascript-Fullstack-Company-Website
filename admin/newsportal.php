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
    <title>IEF | Add/Edit News</title>
    
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

                    <div class="headerWrap">    
                        <h1>Add or Edit News Article <i class="far fa-newspaper"></i></h1>
                        <div id="headerHR"></div>               
                        <br>
                    </div> 
                    <br><b><a href='portal.php'>Go back</a></b>

                    <hr><br>
                    <!-- Grid row-->
                    <div class="row">
                         <!-- Grid row-->
                        <div id="eventAdmin" align="left" class="col-lg-6">
                            <div align='center'><h3>Add a new Article</h3></div> 
                            <br>

                            <div class="adminForm">
                                <form id="newArticle" 
                                      method="POST" 
                                      action="newsportal" 
                                      enctype="multipart/form-data"> <p>     
                                    <hr>
                                    <b><i class="far fa-newspaper"></i> Article title:</b>  
                                    <br>
                                    <div class='helpBox'></div>
                                    <br>
                                        <div class="form-group row">
                                            <small>
                                                <div class='alert alert-info' role='alert'>
                                                    Max length: 150 characters
                                                </div>
                                            </small>
                                            <input 
                                                class="form-control" 
                                                type="text" 
                                                id="articleTitle" 
                                                name="myArticleTitle" 
                                                size="40" 
                                                maxlength="150" 
                                                placeholder="required*" 
                                                required
                                            /> 
                                        </div>
                                    <hr>
                                    <b>Article main content:</b>
                                    <br> 
                                    <div class='helpBox'></div>
                                        <small>
                                            <div class='alert alert-info' role='alert'>
                                                Max length: 3500 characters
                                            </div>
                                        </small>
                                    <textarea 
                                        class="form-control summernote" 
                                        rows='20' 
                                        cols='70' 
                                        id="summernote" 
                                        name="myArticleContent"
                                        maxlength='3500' 
                                        placeholder="required*" 
                                        required>     
                                    </textarea>
                                    <hr>                   

                                    <b>Article main image:</b>
                                    <br>
                                    <div class='helpBox'></div>
                                    <div class="row">
                                        <small>
                                            <div class='alert alert-info col-xs-4' role='alert'>
                                                Don't worry, you can skip this step and use the default image! [jpg/jpeg or png files only] 
                                            </div>
                                        </small>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-xs-3">
                                            <div class="custom-file">
                                                <input 
                                                    type="file" 
                                                    class="custom-file-input" 
                                                    name="myArticlePhoto" 
                                                    id="articlePhoto"
                                                >
                                                <label 
                                                    class="custom-file-label" 
                                                    for="customFile">
                                                    Choose image
                                                </label>
                                                <div id='uploaded_image'></div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr><br>
                                    <button 
                                        name="newArticleBtn" 
                                        id="newArticleButton" 
                                        onclick="return confirm('Publish this article?');" 
                                        type="submit" 
                                        class="btn btn-primary"
                                    >
                                        Publish Article &nbsp;<i class='far fa-edit'></i>
                                    </button>      
                                    <br><br><hr>
                                </form>
                            </div>
                        </div>
                         
                        <!-- Grid row-->
                        <div id="eventAdmin" align="center" class="col-lg-6">
                            <h3>Edit an existing Article</h3>
                            <br><hr>
                            Select an article to edit or delete it.
                            <br>
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

        <!--Upload image modal -->
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
    $(document).ready(function(){
        
        //when fucntion is called fetch data from gallery table
        load_data();
        
        function load_data(page)
        
        {
            
            $.ajax({
                url:"paginationPortalNews.php",
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
        height: 250,

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
