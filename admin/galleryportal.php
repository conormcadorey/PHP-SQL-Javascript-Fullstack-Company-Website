<?php
session_start();
if(!isset($_SESSION["email"]))  {
   header("location:index.php");
   exit;
} 
include ("conn.php");
include ("server.php");
?>

<?php 
    //DELETE IMAGE
    if (isset($_POST['delImage']))  {  
        $id = $conn->real_escape_string($_POST['id']);
        $conn->query("DELETE FROM gallery WHERE id=$id");
        exit('success');  
    }

    //DISPLAY IMAGES
    if (isset($_POST['getImages']))   {
        $start = $conn->real_escape_string($_POST['start']);
        $sql = $conn->query("SELECT id, path FROM gallery ORDER BY id DESC LIMIT $start, 8");
        
        $response = array();
        while ($data = $sql->fetch_assoc()) {
           $response[] = array("path" => $data['path'], "id" => $data['id']);
        }
        //return json on end
        exit(json_encode(array("images" => $response)));
    }
    
    //UPLOAD IMAGES TO DATABASE
    if (isset($_FILES['attachments'])) {
        $msg = "";
        //check if file exists
        $targetFile = time() . basename($_FILES['attachments']['name'][0]);
        
        if (file_exists($targetFile))   {
            $msg = array("status" => 0, "msg" => "File already exists!");
            
        } else if (move_uploaded_file($_FILES['attachments']['tmp_name'][0], "useruploads/" . $targetFile)) {
            
            $msg = array("status" => 1, "msg" => "File Has Been Uploaded", "path" => "useruploads/" . $targetFile);
                $conn ->query("INSERT INTO `gallery` (path, uploadDate) VALUES ('$targetFile', NOW())");
        }
        exit(json_encode($msg));   
    }
    
    //GET TOTAL NUMBER OF IMAGES IN DATABASE
    $sql = $conn->query("SELECT id FROM gallery");
    $numRows = $sql->num_rows;
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IEF | Add/Edit Gallery</title>
    
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
    <!-- JQuery -->
    <script   src="https://code.jquery.com/jquery-3.4.1.min.js"   integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="   crossorigin="anonymous"></script>
    
    <!--Dag/drop file uploader -->
    <script src="js/vendor/jquery.ui.widget.js" type="text/javascript"></script>
    <script src="js/jquery.iframe-transport.js" type="text/javascript"></script>
    <script src="js/jquery.fileupload.js" type="text/javascript"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote-bs4.min.js"></script>
    
    <link rel="stylesheet" href="styles/styles.css"/>
    
    <style>
        #uploadedFiles img {
            width: 100%;
        }
    </style>
    
  </head>
  
  <body>
    <?php //include "includes/adminheader.php" ?>  
    <div id="headerBackground"></div> 
    <!--Admin header content -->
    <div class="headerMain">
        <!--Set navigation design theme -->
        <nav class="navbar navbar-light bg-light">
            <!--Place navigation to the left -->
            <a href="" 
               class="navbar-brand">
                <img align="right" src ="img\logomain2.png"/>
            </a>
            <p class="navbar-text d-none d-sm-block" 
               id="headerText"
            > 
                <i class="fas fa-user-cog"></i> IEF Admin | 
                <a href="server.php?link=logout">Log out</a> 
            </p>
        </nav>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
    </div>  
  
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
                        <h1>Add or Edit Gallery Image(s) <i class="far fa-images"></i></h1>
                        <div id="headerHR"></div>               
                        <br>
                    </div> 
                    <br><b><a href='portal.php'>Go back</a></b>
                    <hr><br>
                    <!-- drag/drop file upload -->
                    <div id="dropZone">
                        <div class="alert alert-info" role="alert">
                            <b><h5>Drag and drop any image files here!</h5></b>
                            <i class='far fa-check-circle'></i> Accepted file-types: jpg/jpeg and png 
                        </div>
                        <br>
                        Or use the uploader below:
                        <div class="form-group row">
                            <div class="col-lg-6 offset-lg-3">
                                <div class="custom-file">
                                    <input 
                                        type="file"
                                        class="custom-file-input" 
                                        id="fileupload" 
                                        name="attachments[]" 
                                        multiple
                                    >
                                    <label 
                                        class="custom-file-label" 
                                        for="customFile"
                                    >
                                        Choose image(s)
                                    </label>
                                </div>
                            </div>
                        </div>
                        <small><div id="error"></div></small>
                        <h5 id="progress"></h5>
                        <br>
                        <div id="files"></div>
                    </div>
                    <br>
                    Select an image to permanently delete it from the gallery. 
                    <br>
                    <div class="container" id="uploadedFiles">
                        <div class="row">
                            <?php  ?>
                        </div>    
                    </div>
                    <br><hr><br>
                    <p><b><a href='portal.php'>Go back</a></b></p>
                    <br>
                </div> 
            </div>
        </div>
    </div>

    <?php include "includes/footer.php" ?>
    
    <script type="text/javascript">
    //call image function
    $(document).ready(function()   {
        getImages(0, <?php echo $numRows?>);
    });
    
    //get images function
    function getImages(start, max)  {
        
        //if total number of images uploaded is larger than the maximum allowed to be displayed
        if(start > max)
            return;
        
        //ajax call
        $.ajax({
            url: 'galleryportal',
            method: 'POST',
            //datatype server will return
            dataType: 'json',
            //data sent to server
            data: {
                //distinquish between different ajax calls to same file
                getImages: 1,
                start: start
                
            //return array of images
            }, success: function (response) {
                for (var i=0; i < response.images.length; i++)
                    addImage("useruploads/" + response.images[i].path, response.images[i].id);
                
                getImages((start+8), max);
                
            }
            
        });
        
    }
    
    //delete images function 
    function delImg(id)   {
        
        if (id === 0)
            alert('Cannot delete this image yet! Refresh the page to delete')
        else if (confirm('(!) Permanently delete this image?')) {
            
            //ajax call
        $.ajax({
            url: 'galleryportal',
            method: 'POST',
            //datatype server will return
            dataType: 'text',
            //data sent to server
            data: {
                //distinquish between different ajax calls to same file
                delImage: 1,
                id: id
                
            //return array of images
            }, success: function (response) {
                $("#img_"+id).remove();
                
            }
            
        });
               
        }    
    }
    
    $(function() {
        
        var files = $("#files");
        
        $("#fileupload").fileupload({
            url: 'galleryportal',
            dropZone: '#dropZone',
            dataType: 'json',
            autoUpload: false
            
        //once file is added
        }).on('fileuploadadd', function (e, data) {
            
            var fileTypeAllowed = /.\.(jpg|png|jpeg)$/i;
            var fileName = data.originalFiles[0]['name'];
            var fileSize = data.originalFiles[0]['size'];
            
            //validation checks
            if(!fileTypeAllowed.test(fileName))
                $("#error").html('<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-circle"></i> Cannot upload file-type! .jpg .jpeg or .png only</div>');
            else if (fileSize > 2500000)
                $("#error").html('<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-circle"></i> A problem occurred- Please try again!</div>');
            else {
                $("#error").html("");
                data.submit();   
            }
        
        //display file once uploaded
        }).on('fileuploaddone', function(e, data)  {
              
              var status = data.jqXHR.responseJSON.status;
              var msg = data.jqXHR.responseJSON.msg;
              
              if (status == 1)  { 
                  var path = data.jqXHR.responseJSON.path;
                  //id of 0
                  addImage(path, 0);

              } else 
                  $("#error").html(msg);
              
        //one progress status for all files     
        }).on('fileuploadprogressall', function(e, data) {
            //get int value
            var progress = parseInt(data.loaded / data.total * 100, 10);
            //create progress status
            $("#progress").html("Uploading: " + progress + "%" );
            
        });
        
    });
    
    
    function addImage(path, id) {
    
        //format preview upload image (3 per row)
        if ($("#uploadedFiles").find('.row:last').find('.myImg').length === 4)
                      
          $("#uploadedFiles").append('<div class="row"></div>');
            $("#uploadedFiles").find('.row:last').append('<div id="img_'+id+'" class="col-md-3 myImg" onclick="delImg('+id+')"><img src="'+path+'" /></div>');   
        
    };
        
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

    </script>

  </body>
</html>
