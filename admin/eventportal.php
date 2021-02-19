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
    <title>IEF | Add/Edit Events</title>
    
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
    
    <!-- JQuery and datepicker-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script> 
    
    <!--Summernote 
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script> DOESN'T WORK WITH DATEPICKER-->
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

                    <div class="headerWrap">    
                        <h1>Add or edit an Event <i class="far fa-calendar-times"></i></h1>
                        <div id="headerHR"></div> 
                        <br>
                    </div> 
                    <br><b><a href='portal.php'>Go back</a></b>

                    <hr><br>
                    <!-- Grid row-->
                     <div class="row">
                         <!-- Grid row-->
                         <div id="eventAdmin" align="left" class="col-lg-6">
                         <div align='center'><h3>Add a new Event</h3></div> 
                         <br>
                            <div class="adminForm">
                                <form 
                                    id="newEvent" 
                                    method="POST" 
                                    action="eventportal" 
                                    enctype="multipart/form-data"
                                > 
                                    <hr>
                                    <b>Event name:</b>  
                                    <br>
                                    <div class='helpBox'></div>
                                    <br>
                                    <div class="col-xs-4">
                                        <small>
                                            <div class='alert alert-info' 
                                                 role='alert'
                                            >
                                                Keep it brief! It's better to add more info in the description section
                                            </div>
                                        </small>
                                        <input 
                                            class="form-control" 
                                            type="text" 
                                            id="eventTitle" 
                                            name="myEventTitle" 
                                            size="40" 
                                            maxlength="50" 
                                            placeholder="required*" 
                                            required
                                        /> 
                                    </div>
                                    <hr>
                                    <b><i class='far fa-calendar-times'></i> Eventdate:</b>
                                    <br>
                                    <div class='helpBox'></div>
                                        <div class="form-group row">
                                            <div class="col-xs-4">
                                                <small>
                                                    <div class='alert alert-info' 
                                                         role='alert'
                                                    >
                                                        Please use the format YYYY-MM-DD (eg: 2020-04-19)
                                                    </div>
                                                </small>
                                                <input 
                                                    class="form-control" 
                                                    type="text" 
                                                    id="eventDate" 
                                                    name="myEventDate" 
                                                    size="20" 
                                                    maxlength="10" 
                                                    placeholder="required*" 
                                                    required
                                                /> 
                                            </div>
                                        </div>
                                    <hr>
                                    <b><i class='far fa-clock'></i> Event time:</b> 
                                    <br> 
                                    <div class='helpBox'></div>
                                        <div class="form-group row">
                                            <div class="col-xs-3">
                                                <select id = 'eventTime' name='myEventTime' required>
                                                <option value='' disabled selected>Select time</option>
                                                <option value = '08:00'>08:00</option>
                                                <option value = '08:15'>08:15</option>
                                                <option value = '08:30'>08:30</option>
                                                <option value = '08:45'>08:45</option>                    
                                                <option value = '09:00'>09:00</option>
                                                <option value = '09:15'>09:15</option>
                                                <option value = '09:30'>09:30</option>
                                                <option value = '09:45'>09:45</option>
                                                <option value = '10:00'>10:00</option>
                                                <option value = '10:15'>10:15</option>
                                                <option value = '10:30'>10:30</option>
                                                <option value = '10:45'>10:45</option>
                                                <option value = '11:00'>11:00</option>
                                                <option value = '11:15'>11:15</option>
                                                <option value = '11:30'>11:30</option>
                                                <option value = '11:45'>11:45</option>
                                                <option value = '12:00'>12:00</option>
                                                <option value = '12:15'>12:15</option>
                                                <option value = '12:30'>12:30</option>
                                                <option value = '12:45'>12:45</option>
                                                <option value = '13:00'>13:00</option>
                                                <option value = '13:15'>13:15</option>
                                                <option value = '13:30'>13:30</option>
                                                <option value = '13:45'>13:45</option>
                                                <option value = '14:00'>14:00</option>
                                                <option value = '14:15'>14:15</option>
                                                <option value = '14:30'>14:30</option>
                                                <option value = '14:45'>14:45</option>
                                                <option value = '15:00'>15:00</option>
                                                <option value = '15:15'>15:15</option>
                                                <option value = '15:30'>15:30</option>
                                                <option value = '15:45'>15:45</option>
                                                <option value = '16:00'>16:00</option>
                                                <option value = '16:15'>16:15</option>
                                                <option value = '16:30'>16:30</option>
                                                <option value = '16:45'>16:45</option>
                                                <option value = '17:00'>17:00</option>
                                                <option value = '17:15'>17:15</option>
                                                <option value = '17:30'>17:30</option>
                                                <option value = '17:45'>17:45</option>
                                                <option value = '18:00'>18:00</option>
                                                <option value = '18:15'>18:15</option>
                                                <option value = '18:30'>18:30</option>
                                                <option value = '18:45'>18:45</option>
                                                <option value = '19:00'>19:00</option>
                                                <option value = '19:15'>19:15</option>
                                                <option value = '19:30'>19:30</option>
                                                <option value = '19:45'>19:45</option>
                                                <option value = '20:00'>20:00</option>
                                                <option value = '20:15'>20:15</option>
                                                <option value = '20:30'>20:30</option>
                                                <option value = '20:45'>20:45</option>
                                                <option value = '21:00'>21:00</option>
                                                <option value = '21:15'>21:15</option>
                                                <option value = '21:30'>21:30</option>
                                                <option value = '21:45'>21:45</option>
                                              </select>
                                            </div>
                                        </div>
                                    <hr>   
                                    <b><i class='fas fa-map-marker-alt'></i> Event location:</b> 
                                    <br> 
                                    <div class='helpBox'><small> </small></div>
                                    <br>
                                    <input 
                                        class="form-control" 
                                        type="text" 
                                        id="eventLocation" 
                                        name="myEventLocation" 
                                        size="40" 
                                        maxlength="40" 
                                        placeholder="required*" 
                                        required/> 
                                    <hr>

                                    <b>Event description:</b>
                                    <br> 
                                    <div class='helpBox'></div>
                                    <small>
                                        <div class='alert alert-info' 
                                             role='alert'
                                        >
                                            Max length: 350 characters
                                        </div>
                                    </small>
                                    <textarea 
                                        class="form-control summernote" 
                                        rows='6' 
                                        cols='70' 
                                        id="eventDescription" 
                                        name="myEventDesc" 
                                        maxlength='350' 
                                        placeholder="required*" 
                                        required>      
                                    </textarea>
                                    <hr>
                                    <b><i class='fas fa-ticket-alt'></i> Does this event require a ticket? </b>
                                    <br> 
                                    <div class='helpBox'><small> </small></div>
                                    <br>
                                    <label></label>
                                    <select id = "course" name="myEventTicket">
                                      <option value='' disabled selected>Select option</option>
                                      <option value = "Yes">Yes</option>
                                      <option value = "No">No</option>
                                    </select>
                                    <hr>
                                    <b>Attachment:</b>
                                    <br>
                                    <div class='helpBox'></div>
                                    <div class="row">
                                        <small>
                                            <div class='alert alert-info col-xs-4' 
                                                 role='alert'
                                            >
                                                You can attach any additional information, including flyers here 
                                            </div>
                                        </small>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-xs-3">
                                            <div class="custom-file">
                                                <input 
                                                    type="file" 
                                                    class="custom-file-input" 
                                                    name="myEventFile" 
                                                    id="eventFile"
                                                >
                                                <label 
                                                    class="custom-file-label" 
                                                    for="customFile"
                                                >
                                                    Choose attachment
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <hr><br>
                                    <button 
                                        name="newEvent" 
                                        id="newEventButton" 
                                        onclick="return confirm('Create new event?');" 
                                        type="submit" 
                                        class="btn btn-primary"
                                    >
                                        Create Event &nbsp;<i class='far fa-edit'></i>
                                    </button>      
                                    <br><br>
                                </form>
                            </div>
                        </div>

                    <!-- Grid row-->
                    <div id="eventAdmin" align="center" class="col-lg-6">
                        <h3>Edit an existing Event</h3>
                        <br><hr>
                        Select an event to edit or delete it.
                        <br>
                        <div class='row' id='pagination_data'>    
                            <!--Fetch and display events from database --> 
                            <?php ?>   
                        </div>
                    </div>
                </div>
                <hr><br>
                <p><b><a href='portal.php'>Go back</a></b></p>
                <br>
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
                url:"paginationPortalEvent.php",
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
    $(document).ready(function(){  
         //Format date output
         $.datepicker.setDefaults({  
              dateFormat: 'yy-mm-dd'   
         //Set up date picker     
         });  
         $(function(){  
              $("#eventDate").datepicker();      
         }); 

    });  

    //Display choosen file name in submission form
      $(document).on('change', '.custom-file-input', function (event) {
          $(this).next('.custom-file-label').html(event.target.files[0].name);
      })

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
     
  </body>
</html>