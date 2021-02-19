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
    <title>IEF | Events</title>
    
    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.css" />
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/d6cf5ed24c.js" crossorigin="anonymous"></script>
    <!--Ajax/jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script> 
    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web&display=swap" rel="stylesheet">
    <!-- Parallax effect -->
    <script src="https://cdn.jsdelivr.net/npm/simple-parallax-js@5.2.0/dist/simpleParallax.min.js"></script>
    
    <link rel="stylesheet" href="styles/styles.css"/>

  </head>
  
<body>
    <?php include "includes/cookies.php" ?> 
    <?php include "includes/header.php" ?>  
      
    <!--Main body content --> 
    <div class="mainBody">

        <img id="aboutImg" 
             style="filter: blur(8px); -webkit-filter: blur(8px);" 
             src="img\eventsbanner.jpg"
             class="parallaxEffect" 
             alt="image"
        />

       <div class="contentWrap">

        <div class="row justify-content-end">  
            <div id="aboutQuote" align="center" class="qoute col-md-4">
                <div class="infoBox"> 
                    <div id="eventsBox" class="aboutBox bubble">
                        <!-- Validation message -->
                        <?php include("errors.php"); ?>

                        <h1><i class="far fa-calendar-times"></i> Filter Events</h1>
                        <small>Choose from between two dates to see what's on!</small>
                            <hr>
                            <form action='events.php' method='POST' id='eventFilterForm'>
                            <div class="col-md-12">  
                                     <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date" />  
                                </div>  
                            <br>
                                <div class="col-md-12">  
                                     <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" />  
                                </div>  
                            <br>
                                <div class="col-md-5">  
                                     <input type="submit" name="filter" id="filterEvent" value="Search" class="btn btn-primary" />  
                                </div>  
                            </form>
                            <hr>
                    </div> 
                </div>
            </div>

            <!--Fetch and display events from database -->          
            <?php
            if (!isset($_POST["from_date"], $_POST["to_date"]))  {
            $query = "SELECT * FROM events ORDER BY eventDate DESC LIMIT 10;";
                $result = mysqli_query($conn, $query);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $event = $row["eventName"];
                        $date = $row["eventDate"];
                        $time = $row["eventTime"];
                        $loc = $row["eventPlace"];  
                        $desc = $row["eventDesc"]; 
                        $attachment = $row["eventFile"];
                        $ticket = $row["eventTicket"];
                        $today = date("Y-m-d");

                        //display if event requires a ticket 
                        if ($ticket=="Yes") {
                            $ticketStatus = "<i class='fas fa-ticket-alt'></i> <i>Event Requires a Ticket</i>";
                        } else if ($ticket=="No") {
                            $ticketStatus = "";
                        }

                        //display attachment if there is an attached file 
                        if ($attachment==null) {
                            $attachmentStatus = "";
                        } else {
                            $attachmentStatus = "<a class='btn btn-primary btn-sm' href='useruploads/$attachment' id='attachmentButton' role='button'>See attachment &nbsp;<i class='far fa-file-alt'></i></a>";
                        }

                    echo "
                    <div id='aboutQuote' align='center' class='qoute col-md-8'>
                        <div class='infoBox'> 
                            <div id='eventsBox' class='aboutBox bubble'>
                                <div class='headerWrap'>
                                    <div id='headerLink'>
                                    <h1>$event</h1>
                                    </div>
                                    <div id='headerHR'></div>
                                </div>   
                        <br>
                            $ticketStatus
                        <hr>
                        <p><p><i class='far fa-calendar-times'></i> ". date("d/m/Y", strtotime($date)) ." | <i class='fas fa-map-marker-alt'></i> $loc | <i class='far fa-clock'></i> $time";

                    echo " ".($today == $date ? "<span class='badge badge-pill badge-danger'>Today!</span>" : "")." ";

                    echo "
                        <br>
                        $desc
                        $attachmentStatus        
                        <hr>
                        </p>
                        </div> 
                        </div>
                    </div>
                            ";    
                    }  

                    } else {

                    echo "
                        <div id='aboutQuote' align='center' class='qoute col-md-8'>
                            <div class='infoBox'> 
                                <div id='eventsBox' class='aboutBox bubble'>
                                    <div class='headerWrap'>
                                        <div id='headerLink'>
                                        <h1>No Results</h1>
                                        </div>
                                        <div id='headerHR'></div>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    ";
                    }

                    } else {

                    echo "
                        $output      
                    ";
            }   
            ?>

        </div>
       </div>    
    </div>

    <?php include "includes/footer.php" ?> 
        
    <script>  
    //DATE FILTER
    $(document).ready(function(){  
           $.datepicker.setDefaults({  
                dateFormat: 'yy-mm-dd'   
           });  
           $(function(){  
                $("#from_date").datepicker();  
                $("#to_date").datepicker();  
           });  
           $('#filter').click(function(){  
                var from_date = $('#from_date').val();  
                var to_date = $('#to_date').val();  
                if(from_date != '' && to_date != '')  
                {  
                     $.ajax({  
                          url:"server.php",  
                          method:"POST",  
                          data:{from_date:from_date, to_date:to_date},  
                          success:function(data)  
                          {  
                               $('#aboutQuote').html(data);  
                          }  
                     });  
                }  
                else  
                {  
                     alert("Please Select Date");  
                }  
           });  
      });  
      
    //PARALLAX
    var image = document.getElementsByClassName('parallaxEffect');
        new simpleParallax(image, {
        scale: 1.2
    });

    //VALIDATION MSG FADE-OUT EFFECT
    $(document).ready(function () {
        $("#regerror").delay(7000).fadeOut("slow");
    });
    </script>
 
  </body>
</html>

