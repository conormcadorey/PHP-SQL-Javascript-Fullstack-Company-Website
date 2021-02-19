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
    <title>IEF | Edit Event</title>
    
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

                    <?php
                    $displayid=$_GET["eventid"];
                    $query = "SELECT * FROM `events` WHERE eventID ='$displayid'";;
                    $result = mysqli_query($conn, $query);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {

                            $eventTitle = $row["eventName"];
                            $eventDate = $row["eventDate"];
                            $eventTime = $row["eventTime"];
                            $eventPlace = $row["eventPlace"];
                            $eventDesc = $row["eventDesc"];
                            $eventTicket = $row["eventTicket"];
                            $eventid = $row["eventID"];
                            $attachment = $row["eventFile"];
                            $iddata = $row["eventID"];
                            $displayid=$row["eventid"];

                            //display attachment if there is an attached file 
                            if ($attachment==null) {
                                $attachmentStatus = "";
                            } else {
                                $attachmentStatus = "&nbsp;&nbsp;<a class='btn btn-primary btn-sm' href='useruploads/$attachment' id='attachmentButton' role='button'><i class='far fa-file-alt'></i> &nbsp; View current attachment</a>
                                &nbsp;&nbsp;<input class='btn btn-primary btn-sm' onclick='updateEvent()' type='submit' name='deleteEventFile' value='Remove attachment(s)'>";
                            }

                            echo "
                            <div class='headerWrap'>    
                                <h1>Edit event, '$eventTitle' <i class='far fa-edit'></i></h1>
                                <div id='headerHR'></div>
                            </div> 
                            <br><b><a href='eventportal.php'>Go back</a></b>
                            <hr>
                            <br>
                            <!-- Grid row-->
                             <div class='row'>
                                <div align='left' class='col-lg-6'>
                                   <b>Name</b> 
                                   <br>
                                   <div class='helpBox'></div>
                                   <form action='editevent.php?eventid=$iddata'  
                                       method='POST' 
                                       id='updateEventTitle'
                                   >
                                       <div class='form-group row'>
                                         <small>
                                           <div class='alert alert-info' role='alert'>
                                               Keep it brief! It's better to add more info in the description section
                                           </div>
                                         </small>
                                           <input class='form-control' 
                                           type='text' 
                                           id='updateEventTitle' 
                                           name='myUpdateEventTitle' 
                                           size='40' 
                                           maxlength='40' 
                                           value='$row[eventName]' 
                                           required
                                           >
                                       </div>
                                       <input 
                                       class='btn btn-primary btn-sm' 
                                       type='submit' 
                                       name='updateEventTitle' 
                                       value='Update' 
                                       id='updateBtn'
                                       disabled> 
                                   </form>
                                   <br><hr><br>
                                </div> 

                                <div align='left' class='col-lg-6'>
                                    <b><i class='far fa-calendar-times'></i> Date</b> 
                                    <br>
                                    <div class='helpBox'></div>
                                    <form action='editevent.php?eventid=$iddata' 
                                        method='POST' 
                                        id='updateEventDate'
                                    >
                                        <div class='form-group row'>
                                          <small>
                                            <div class='alert alert-info' role='alert'>
                                                Please use the format YYYY-MM-DD (eg: 2020-04-19)
                                            </div>
                                          </small>
                                            <input class='form-control' 
                                            type='text' 
                                            id='updteEventDate' 
                                            name='myUpdateEventDate' 
                                            size='15' 
                                            maxlength='10' 
                                            value='$row[eventDate]' 
                                            required/> 
                                        </div>

                                        <input 
                                            class='btn btn-primary 
                                            btn-sm' 
                                            type='submit' 
                                            name='updateEventDate' 
                                            value='Update' 
                                            id='updateBtn'
                                        > 
                                    </form>
                                    <br><hr>
                                </div>

                                <div align='left' class='col-lg-6'>
                                    <b><i class='far fa-clock'></i> Time:</b> $eventTime
                                    <br> 
                                    <div class='helpBox'></div>
                                    <form action='editevent.php?eventid=$iddata' 
                                        method='POST' 
                                        id='updateEventTime'
                                    >
                                        <div class='form-group row'>
                                            <select 
                                                id = 'updateEventTime' 
                                                name='myUpdateEventTime' 
                                                required
                                            >
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

                                        <input class='btn btn-primary btn-sm' 
                                        type='submit' 
                                        name='updateEventTime' 
                                        value='Update'
                                        id='updateBtn'> 
                                    </form>
                                    <br><br><hr>
                                </div>
                                 
                                <div align='left' class='col-lg-6'>
                                    <i class='fas fa-map-marker-alt'></i> 
                                    <b>Location</b>
                                    <br> 
                                    <div class='helpBox'></div>
                                    <form action='editevent.php?eventid=$iddata' 
                                        method='POST' 
                                        id='updateEventPlace'
                                    >
                                        <div class='form-group row'>
                                            <input 
                                                class='form-control' 
                                                type='text' 
                                                id='updateEventPlace' 
                                                name='myUpdateEventPlace' 
                                                size='30' 
                                                maxlength='35' 
                                                value='$row[eventPlace]' 
                                                required
                                            /> 
                                        </div>
                                        <input 
                                            class='btn btn-primary btn-sm' 
                                            type='submit' 
                                            name='updateEventPlace' 
                                            value='Update'
                                            id=''
                                        > 
                                    </form>
                                    <br><hr><br>
                                </div>

                                <div align='left' class='col-lg-12'>
                                    <b>Event description</b>
                                    <br> 
                                    <div class='helpBox'></div>
                                    <form action='editevent.php?eventid=$iddata' 
                                        method='POST' 
                                        id='updateEventDesc'
                                    >                        
                                        <div class='form-group row'>
                                            <small>
                                              <div class='alert alert-info' role='alert'>
                                                  Max length: 350 characters
                                              </div>
                                            </small>
                                            <span style='width: 100%;'> 
                                                <textarea class='form-control summernote' 
                                                rows='6' 
                                                cols='70' 
                                                id='updateEventDesc' 
                                                name='myUpdateEventDesc'
                                                maxlength='350' 
                                                required>$row[eventDesc]
                                                </textarea>
                                            </span>
                                        </div>   
                                        <input class='btn btn-primary btn-sm'
                                        onclick='updateEvent()' 
                                        type='submit' 
                                        name='updateEventDesc' 
                                        value='Update'> 
                                    </form>
                                    <br><hr><br>
                                </div>
                                 
                                <div align='left' class='col-lg-6'>
                                    <b><i class='fas fa-ticket-alt'></i> Ticket required:</b> $eventTicket 
                                    <br> 
                                    <div class='helpBox'><small> </small></div>
                                    <form 
                                        action='editevent.php?eventid=$iddata' 
                                        method='POST' 
                                        id='updateEventTicket'
                                    >
                                        <p>Does this event require a ticket? <br /> 
                                        <label></label>
                                        <select id ='ticketOption' name='myUpdateEventTicket' required>
                                          <option value='' disabled selected>Select option</option>
                                          <option value = 'Yes'>Yes</option>
                                          <option value = 'No'>No</option>
                                        </select> 
                                            <br><br>
                                        <input 
                                            class='btn btn-primary btn-sm' 
                                            onclick='updateEvent()' 
                                            type='submit' 
                                            name='updateEventTicket' 
                                            value='Update'
                                        > 
                                    </form>
                                    <br><br><br><hr>
                                </div>
                                 
                                <div align='left' class='col-xl-6'>
                                    <b>Add/Change attachment</b>
                                    <br>
                                    <form 
                                        action='editevent?eventid=$iddata' 
                                        method='POST' 
                                        id='updateEventFile' 
                                        enctype='multipart/form-data'
                                     >
                                        <div class='helpBox'></div>
                                        <div class='form-group row'>      
                                            <div class='col-lg-12 pl-0 pr-0'>
                                            <small>
                                                <div class='alert alert-info' role='alert'>
                                                    You can attach any additional information or flyers etc here
                                                </div>
                                            </small>
                                                <div class='custom-file'>
                                                    <input type='file' class='custom-file-input' name='myUpdateEventFile' id='updateEventFile' required>
                                                    <label class='custom-file-label' for='customFile'>Choose file</label>
                                                    <br>
                                                    <br>
                                                    <input class='btn btn-primary btn-sm' 
                                                    onclick='updateEvent()' 
                                                    type='submit' 
                                                    name='updateEventFile'
                                                    value='Update'> 
                                                    $attachmentStatus 
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <br><hr><br>
                                </div>
                                
                                <div align='left' class='col-xl-12'>
                                    <form 
                                        action='editevent.php?eventid=$iddata' 
                                        method='POST' 
                                        id='deleteEvent'
                                    >
                                        <br>
                                        <button 
                                            class='btn btn-primary' 
                                            onclick='adminDeleteEvent()' 
                                            type='submit' 
                                            name='deleteEvent' 
                                            value=''
                                        > 
                                            <i class='far fa-trash-alt'></i> Delete this Event? 
                                        </button>
                                    </form>
                                    <br><br><hr><br>    
                                ";
                        }
                            } else {
                                echo" <div class='headerWrap'>    
                                        <h1>No results! <i class='fas fa-exclamation-circle'></i></h1>
                                        <div id='headerHR'></div>
                                      </div> 
                                      <hr>
                                      This event doesn't exist or has been deleted
                                      <br>";
                            }
                    ?>     
                    <p align='center'>
                       <b><a href='eventportal.php'>Go back</a></b>
                    </p>
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
      $(document).ready(function(){  
           //Format date output
           $.datepicker.setDefaults({  
                dateFormat: 'yy-mm-dd'   
           //Set up date picker     
           });  
           $(function(){  
                //$("#updateEventDate").datepicker();   
                $("#updteEventDate").datepicker();  
           }); 
            
      });  
        
        $('.summernote').summernote({
            placeholder: 'required*',
            tabsize: 2,
            height: 250,

            toolbar: [
            // [groupName, [list of button]]
            ['style', ['bold', 'italic', 'underline']],
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
        
        //Validation message fade out
        $(document).ready(function () {
            $("#regerror").delay(3000).fadeOut("slow");
        });
        
        
        //Display choosen file name in submission form
        $(document).on('change', '.custom-file-input', function (event) {
            $(this).next('.custom-file-label').html(event.target.files[0].name);
        })
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

    var r =confirm('Are you sure you want to delete this event permenantly?');
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
      
  </body>
</html>
