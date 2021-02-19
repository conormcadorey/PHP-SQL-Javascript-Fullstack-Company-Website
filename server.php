<?php
    session_start();
   
    $email = "";
    $password ="";
    $errors = array();

//connection to database 

include ("conn.php");

if (!$conn)  {
    
    die("connection failed: ".mysqli_connect_error());
    
}

//EXISTING USER SIGN IN  

if(isset($_POST['signin'])) {
    $email = mysqli_real_escape_string($conn,$_POST["myemail"]);
    $password = mysqli_real_escape_string($conn, $_POST["mypassword"]);
    
    //sign-in field validation 
    if(empty($email))   {
        array_push($errors, "<div class='alert alert-danger' role='alert'><i class='fas fa-exclamation-circle'></i> Enter an email!</div>");
    }
    
    if(empty($password))   {
        array_push($errors, "<div class='alert alert-danger' role='alert'><i class='fas fa-exclamation-circle'></i> Enter a password!</div>");
    }
    
    //sign user in if no errors are present 
    
    if(count($errors) == 0) {
        
        //$passencrypt = md5($password);
        
        $query= "SELECT * FROM `users` WHERE email='$email'";

        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0)   {
            
            //store result in an array
            while($row = mysqli_fetch_array($result))   {
                
                if (password_verify($password, $row["password"]))   {
                
                    //return true;
                    $_SESSION['email'] = $email;
                    header('location: portal.php');
                    
                } else {
                    
                    array_push($errors, "<div class='alert alert-danger' role='alert'><i class='fas fa-exclamation-circle'></i> The email or password entered is incorrect/invalid</div>");

                }
                
            } 
          
        }  else {
                    
                    array_push($errors, "<div class='alert alert-danger' role='alert'><i class='fas fa-exclamation-circle'></i> The email or password entered is incorrect/invalid</div>");
            
        }
        
    }
    
}
               
//EXISTING USER SIGN OUT  

$link = $_GET["link"];
  if($link == "logout") {
//if(isset($_GET['logout'])) {
    session_start();
    session_destroy();
    unset($_SESSION['email']);
    header('location: index.php?logout=success');
}   

//CREATE NEW EVENT 

if(isset($_POST["newEvent"]))   {
    
    $eventTitle = mysqli_real_escape_string($conn, $_POST["myEventTitle"]);
    $eventDate = mysqli_real_escape_string($conn, $_POST["myEventDate"]);
    $eventTime = mysqli_real_escape_string($conn, $_POST["myEventTime"]);
    $eventPlace = mysqli_real_escape_string($conn, $_POST["myEventLocation"]);
    $eventDesc = mysqli_real_escape_string($conn, $_POST["myEventDesc"]);
    $eventTicket = mysqli_real_escape_string($conn, $_POST["myEventTicket"]);
    
    //If file-uploader is empty and there are no errors
    if ($_FILES["myEventFile"]["size"] == 0) {
        
        $noFiles = null;
        
        $insertquery = "INSERT INTO `events` (eventID, eventName, eventTime, eventDate, eventPlace, eventDesc, eventTicket, eventFile) VALUES (null, '$eventTitle', '$eventTime', '$eventDate','$eventPlace', '$eventDesc', '$eventTicket', '$noFiles')";
                                
            $result = mysqli_query($conn, $insertquery) or die(mysqli_error($conn));
                                
                array_push($errors, "<div class='alert alert-success' id='regerror' role='alert'><i class='far fa-check-circle'></i> Event created!</div>"); 
    
    } else {            

    $file = $_FILES["myEventFile"];
    
    $fileName = $_FILES["myEventFile"]["name"];
    $fileTmpName = $_FILES["myEventFile"]["tmp_name"];
    $fileSize = $_FILES["myEventFile"]["size"];
    $fileError = $_FILES["myEventFile"]["error"];
    $fileType = $_FILES["myEventFile"]["type"];
    
    //explode elements that make up file (file name and extension) 
    $fileExt = explode(".", $fileName);
        //convert all file-extensions to lowercase
        $fileActualExt = strtolower(end($fileExt));
        
        //restrict allowed uploadable file types
        $allowed = array("jpg", "jpeg", "png", "pdf", "doc", "docx", "txt");
        
            //Check file-type is allowed
            if (in_array($fileActualExt, $allowed))   {
            
                //Check for upload error
                if ($fileError ===0)   {
                    
                    //Check for valid file-size
                    if ($fileSize < 20000000)    {
                        
                        //Create new unique filename using microseconds
                        $fileNameNew = uniqid("", true).'.'.$fileActualExt;
                            
                            //Destination for uploaded file
                            $fileDestination = "useruploads/".$fileNameNew;
                            
                                //Function to uploads file
                                move_uploaded_file($fileTmpName, $fileDestination);
                                
                                $insertquery2 = "INSERT INTO `events` (eventID, eventName, eventTime, eventDate, eventPlace, eventDesc, eventTicket, eventFile) VALUES (null, '$eventTitle', '$eventTime', '$eventDate','$eventPlace', '$eventDesc', '$eventTicket', '".$fileNameNew."')";
                                
                                    $result2 = mysqli_query($conn, $insertquery2) or die(mysqli_error($conn));    
                                    
                                    array_push($errors, "<div class='alert alert-success' id='regerror' role='alert'><i class='far fa-check-circle'></i> Event created!</div>"); 
                                    
                    } else {
                       
                        array_push($errors, "<div class='alert alert-danger' role='alert'><i class='fas fa-exclamation-circle'></i> File too big- Please try another image!</div>");
                        
                    }
                    
                } else {
                        
                      array_push($errors, "<div class='alert alert-danger' role='alert'><i class='fas fa-exclamation-circle'></i> A problem occurred- Please try again!</div>");
                    
                    }
                    
                } else {
                
                    array_push($errors, "<div class='alert alert-danger' role='alert'><i class='fas fa-exclamation-circle'></i> Cannot upload file-type! Accepted: .jpg, .jpeg, .png, .pdf, .doc, .docx, .txt</div>");
            }    
    } 
    
}

//ADMIN UPDATE EVENT TITLE
   
    if(isset($_POST["updateEventTitle"]))     {
        
        $updateEventTitle = mysqli_real_escape_string($conn, $_POST["myUpdateEventTitle"]);
        $updateid = $_GET["eventid"];
     
        if(empty($updateEventTitle))   {
            array_push($errors, "<div class='alert alert-danger' role='alert'><i class='fas fa-exclamation-circle'></i> Please enter a new name! </div>");
       
   } else {
        
        $updatequery = "UPDATE `events` SET eventName='$updateEventTitle' WHERE eventID = '$updateid'";
        
        $result = mysqli_query($conn, $updatequery) or die (mysqli_error($conn));

            header("location: editevent.php?eventid=$updateid");
        
                array_push($errors, "<div class='alert alert-success' id='regerror' role='alert'><i class='far fa-check-circle'></i> Changes saved!</div>"); 
            
        }         
    } 

//ADMIN UPDATE EVENT DATE
   
    if(isset($_POST["updateEventDate"]))     {
        
        $updateEventDate = mysqli_real_escape_string($conn, $_POST["myUpdateEventDate"]);
        $updateid = $_GET["eventid"];
     
        if(empty($updateEventDate))   {

        header("location: editevent.php?eventid=$updateid");
        
            array_push($errors, "<div class='alert alert-danger' role='alert'><i class='fas fa-exclamation-circle'></i> Please enter a new date! </div>");
       
   } else {
        
        $updatequery = "UPDATE `events` SET eventDate='$updateEventDate' WHERE eventID = '$updateid'";
        
        $result = mysqli_query($conn, $updatequery) or die (mysqli_error($conn));

            header("location: editevent.php?eventid=$updateid");
        
                array_push($errors, "<div class='alert alert-success' id='regerror' role='alert'><i class='far fa-check-circle'></i> Changes saved!</div>"); 
            
        }         
    } 
    
//ADMIN UPDATE EVENT TIME
   
    if(isset($_POST["updateEventTime"]))     {
        
        $updateEventTime = mysqli_real_escape_string($conn, $_POST["myUpdateEventTime"]);
        $updateid = $_GET["eventid"];
     
        if(empty($updateEventTime))   {

        header("location: editevent.php?eventid=$updateid");
        
            array_push($errors, "<div class='alert alert-danger' role='alert'><i class='fas fa-exclamation-circle'></i> Please enter a new time! </div>");
       
   } else {
        
        $updatequery = "UPDATE `events` SET eventTime='$updateEventTime' WHERE eventID = '$updateid'";
        
        $result = mysqli_query($conn, $updatequery) or die (mysqli_error($conn));

            header("location: editevent.php?eventid=$updateid");
        
                array_push($errors, "<div class='alert alert-success' id='regerror' role='alert'><i class='far fa-check-circle'></i> Changes saved!</div>"); 
            
        }         
    } 
    
//ADMIN UPDATE EVENT LOCATION
   
    if(isset($_POST["updateEventPlace"]))     {
        
        $updateEventPlace = mysqli_real_escape_string($conn, $_POST["myUpdateEventPlace"]);
        $updateid = $_GET["eventid"];
     
        if(empty($updateEventPlace))   {

        header("location: editevent.php?eventid=$updateid");
        
            array_push($errors, "<div class='alert alert-danger' role='alert'><i class='fas fa-exclamation-circle'></i> Please enter a new location! </div>");
       
   } else {
        
        $updatequery = "UPDATE `events` SET eventPlace='$updateEventPlace' WHERE eventID = '$updateid'";
        
        $result = mysqli_query($conn, $updatequery) or die (mysqli_error($conn));

            header("location: editevent.php?eventid=$updateid");
        
                array_push($errors, "<div class='alert alert-success' id='regerror' role='alert'><i class='far fa-check-circle'></i> Changes saved!</div>"); 
            
        }         
    } 
    
//ADMIN UPDATE EVENT DESCRIPTION
   
    if(isset($_POST["updateEventDesc"]))     {
        
        $updateEventDesc = mysqli_real_escape_string($conn, $_POST["myUpdateEventDesc"]);
        $updateid = $_GET["eventid"];
     
        if(empty($updateEventDesc))   {
  
        header("location: editevent.php?eventid=$updateid");
        
            array_push($errors, "<div class='alert alert-danger' role='alert'><i class='fas fa-exclamation-circle'></i> Please enter a new description! </div>");
       
   } else {
        
        $updatequery = "UPDATE `events` SET eventDesc='$updateEventDesc' WHERE eventID = '$updateid'";
        
        $result = mysqli_query($conn, $updatequery) or die (mysqli_error($conn));

            header("location: editevent.php?eventid=$updateid");
        
                array_push($errors, "<div class='alert alert-success' id='regerror' role='alert'><i class='far fa-check-circle'></i> Changes saved!</div>");  
            
        }         
    } 
    
//ADMIN UPDATE EVENT TICKET
   
    if(isset($_POST["updateEventTicket"]))     {
        
        $updateEventTicket = mysqli_real_escape_string($conn, $_POST["myUpdateEventTicket"]);
        $updateid = $_GET["eventid"];
     
        if(empty($updateEventTicket))   {

        header("location: editevent.php?eventid=$updateid");
        
            array_push($errors, "<div class='alert alert-danger' role='alert'><i class='fas fa-exclamation-circle'></i> Please enter an option! </div>");
       
   } else {
        
        $updatequery = "UPDATE `events` SET eventTicket='$updateEventTicket' WHERE eventID = '$updateid'";
        
        $result = mysqli_query($conn, $updatequery) or die (mysqli_error($conn));

            header("location: editevent.php?eventid=$updateid");
        
                array_push($errors, "<div class='alert alert-success' id='regerror' role='alert'><i class='far fa-check-circle'></i> Changes saved!</div>"); 
            
        }         
    } 
    
//ADMIN UPDATE EVENT ATTACHMENT 
    
    if(isset($_POST["updateEventFile"]))   {
        
        $updateid = $_GET["eventid"];
        $file = $_FILES["myUpdateEventFile"];
    
    $fileName = $_FILES["myUpdateEventFile"]["name"];
    $fileTmpName = $_FILES["myUpdateEventFile"]["tmp_name"];
    $fileSize = $_FILES["myUpdateEventFile"]["size"];
    $fileError = $_FILES["myUpdateEventFile"]["error"];
    $fileType = $_FILES["myUpdateEventFile"]["type"];
    
    //explode elements that make up file (file name and extension) 
    $fileExt = explode(".", $fileName);
        //convert all file-extensions to lowercase
        $fileActualExt = strtolower(end($fileExt));
        
        //restrict allowed uploadable file types
        $allowed = array("jpg", "jpeg", "png", "pdf", "doc", "docx", "txt");
        
            //Check file-type is allowed
            if (in_array($fileActualExt, $allowed))   {
            
                //Check for upload error
                if ($fileError ===0)   {
                    
                    //Check for valid file-size
                    if ($fileSize < 20000000)    {
                        
                        //Create new unique filename using microseconds
                        $fileNameNew = uniqid("", true).'.'.$fileActualExt;
                            
                            //Destination for uploaded file
                            $fileDestination = "useruploads/".$fileNameNew;
                            
                                //Function to uploads file
                                move_uploaded_file($fileTmpName, $fileDestination);
                                
                                $updatequery = "UPDATE `events` SET eventFile='".$fileNameNew."' WHERE eventID = '$updateid'";
                                
                                    $result2 = mysqli_query($conn, $updatequery) or die(mysqli_error($conn));    
                                    
                                    array_push($errors, "<div class='alert alert-success' id='regerror' role='alert'><i class='far fa-check-circle'></i> Event updated!</div>"); 
                                    
                    } else {
                       
                        array_push($errors, "<div class='alert alert-danger' role='alert'><i class='fas fa-exclamation-circle'></i> File too big- Please try another image!</div>");
                        
                    }
                    
                } else {
                        
                      array_push($errors, "<div class='alert alert-danger' role='alert'><i class='fas fa-exclamation-circle'></i> A problem occurred- Please try again!</div>");
                    
                    }
                    
                } else {
                
                    array_push($errors, "<div class='alert alert-danger' role='alert'><i class='fas fa-exclamation-circle'></i> Cannot upload file-type! Accepted: .jpg, .jpeg, .png, .pdf, .doc, .docx, .txt</div>");
            }
        
    }
    
 //ADMIN REMOVE EVENT ATTACHMENTS
    
    if(isset($_POST["deleteEventFile"]))     {
        
        $updateid = $_GET["eventid"];
     
        $updatequery = "UPDATE `events` SET eventFile=null WHERE eventID = '$updateid'";
        
        $result = mysqli_query($conn, $updatequery) or die (mysqli_error($conn));

            header("location: editevent.php?eventid=$updateid");
        
                array_push($errors, "<div class='alert alert-success' id='regerror' role='alert'><i class='far fa-check-circle'></i> Event updated!</div>"); 
                
    } 
    
//ADMIN DELETE EVENT
    
    if(isset($_POST["deleteEvent"]))     {
        
        $deleteid = $_GET["eventid"];
     
        $deletequery = "DELETE FROM `events` WHERE eventID = '$deleteid'";
        
        $result = mysqli_query($conn, $deletequery) or die (mysqli_error($conn));

            header('location: eventportal.php');
        
                array_push($errors, "<div class='alert alert-success' id='regerror' role='alert'><i class='far fa-check-circle'></i> Event deleted!</div>"); 
                
    } 
    
//ADMIN CREATE NEW STAFF MEMBER 

if(isset($_POST["newStaffBtn"]))   {
    
    //Text inputs 
    $staffName = mysqli_real_escape_string($conn, $_POST["myStaffName"]);
    //$staffEmail = mysqli_real_escape_string($conn, $_POST["myStaffEmail"]);
    $staffJob = mysqli_real_escape_string($conn, $_POST["myStaffJob"]);
    $staffBio = mysqli_real_escape_string($conn, $_POST["myStaffBio"]); 
    
    //Staff email option
    if (isset($_POST["myStaffNoEmail"])){
       $staffEmail = "Email Unavailable";
    } else {
       $staffEmail = mysqli_real_escape_string($conn, $_POST["myStaffEmail"]);
    } 
    
    //If file-uploader is empty and there are no errors
    if ($_FILES["myStaffPhoto"]["size"] == 0) {
        
        $noPhoto = null;
        
        $insertquery ="INSERT INTO `staff` (staffID, staffName, staffEmail, staffRole, staffDesc, staffPic) VALUES (null, '$staffName', '$staffEmail', '$staffJob','$staffBio', '$noPhoto')";
                                
            $result = mysqli_query($conn, $insertquery) or die(mysqli_error($conn));
                                
                array_push($errors, "<div class='alert alert-success' id='regerror' role='alert'><i class='far fa-check-circle'></i> Staff member created!</div>"); 
    
    } else {            
    //else if user selects an image to upload
    //Image input
    $file = $_FILES["myStaffPhoto"];
    
    $fileName = $_FILES["myStaffPhoto"]["name"];
    $fileTmpName = $_FILES["myStaffPhoto"]["tmp_name"];
    $fileSize = $_FILES["myStaffPhoto"]["size"];
    $fileError = $_FILES["myStaffPhoto"]["error"];
    $fileType = $_FILES["myStaffPhoto"]["type"];
    
    //explode elements that make up file (file name and extension) 
    $fileExt = explode(".", $fileName);
        //convert all file-extensions to lowercase
        $fileActualExt = strtolower(end($fileExt));
        
        //restrict allowed uploadable file types
        $allowed = array("jpg", "jpeg", "png");
        
            //Check file-type is allowed
            if (in_array($fileActualExt, $allowed))   {
            
                //Check for upload error
                if ($fileError ===0)   {
                    
                    //Check for valid file-size
                    if ($fileSize < 10000000)    {
                        
                        //Create new unique filename using microseconds
                        $fileNameNew = uniqid("", true).'.'.$fileActualExt;
                            
                            //Destination for uploaded file
                            $fileDestination = "useruploads/".$fileNameNew;
                            
                                //Function to uploads file
                                move_uploaded_file($fileTmpName, $fileDestination);
                                
                                $insertquery2 ="INSERT INTO `staff` (staffID, staffName, staffEmail, staffRole, staffDesc, staffPic) VALUES (null, '$staffName', '$staffEmail', '$staffJob','$staffBio', '".$fileNameNew."')";
                                
                                    $result2 = mysqli_query($conn, $insertquery2) or die(mysqli_error($conn));    
                                    
                                    array_push($errors, "<div class='alert alert-success' id='regerror' role='alert'><i class='far fa-check-circle'></i> Staff member created!</div>"); 
                                    
                    } else {
                       
                        array_push($errors, "<div class='alert alert-danger' role='alert'><i class='fas fa-exclamation-circle'></i> File too big- Please try another image!</div>");
                        
                    }
                    
                } else {
                        
                      array_push($errors, "<div class='alert alert-danger' role='alert'><i class='fas fa-exclamation-circle'></i> A problem occurred- Please try again!</div>");
                    
                    }
                    
                } else {
                
                    array_push($errors, "<div class='alert alert-danger' role='alert'><i class='fas fa-exclamation-circle'></i> Cannot upload file-type! .jpg .jpeg or .png only</div>");
            }    
    }            
}   
    
//ADMIN UPDATE STAFF NAME
   
    if(isset($_POST["updateStaffNameSubmit"]))     {
        
        $updateStaffName = mysqli_real_escape_string($conn, $_POST["myUpdateStaffName"]);
        $updateid = $_GET["staffid"];
     
        if(empty($updateStaffName))   {

        header("location: editstaff.php?staffid=$updateid");
        
            array_push($errors, "<div class='alert alert-danger' role='alert'><i class='fas fa-exclamation-circle'></i> Please enter a new name!</div>");
       
   } else {
        
        $updatequery = "UPDATE `staff` SET staffName='$updateStaffName' WHERE staffID = '$updateid'";
        
        $result = mysqli_query($conn, $updatequery) or die (mysqli_error($conn));

            array_push($errors, "<div class='alert alert-success' id='regerror' role='alert'><i class='far fa-check-circle'></i> Changes saved!</div>"); 
            
        }         
    } 
    
//ADMIN UPDATE STAFF EMAIL
   
    if(isset($_POST["updateStaffEmailSubmit"]))     {
        
        $updateStaffEmail = mysqli_real_escape_string($conn, $_POST["myUpdateStaffEmail"]);
        $updateid = $_GET["staffid"];
     
        if(empty($updateStaffEmail))   {

        header("location: editstaff.php?staffid=$updateid");
        
            array_push($errors, "<div class='alert alert-danger' role='alert'><i class='fas fa-exclamation-circle'></i> Please enter a new email!</div>");
       
   } else {
        
        $updatequery = "UPDATE `staff` SET staffEmail='$updateStaffEmail' WHERE staffID = '$updateid'";
        
        $result = mysqli_query($conn, $updatequery) or die (mysqli_error($conn));

            array_push($errors, "<div class='alert alert-success' id='regerror' role='alert'><i class='far fa-check-circle'></i> Changes saved!</div>"); 
          
        }         
    } 

    
//ADMIN REMOVE STAFF EMAIL
    
    if(isset($_POST["removeStaffEmailSubmit"])) {

        $updateid = $_GET["staffid"];

        $updatequery = "UPDATE `staff` SET staffEmail='Email Unavailable' WHERE staffID = '$updateid'";
        
        $result = mysqli_query($conn, $updatequery) or die (mysqli_error($conn));

            array_push($errors, "<div class='alert alert-success' id='regerror' role='alert'><i class='far fa-check-circle'></i> Changes saved!</div>"); 
  
}
    
//ADMIN UPDATE STAFF JOB ROLE  
    
    if(isset($_POST["updateStaffJobSubmit"]))     {
        
        $updateStaffJob = mysqli_real_escape_string($conn, $_POST["myUpdateStaffJob"]);
        $updateid = $_GET["staffid"];
     
        if(empty($updateStaffJob))   {

        header("location: editstaff.php?staffid=$updateid");
        
            array_push($errors, "<div class='alert alert-danger' role='alert'><i class='fas fa-exclamation-circle'></i> Please enter a new job title!</div>");
       
   } else {
        
        $updatequery = "UPDATE `staff` SET staffRole='$updateStaffJob' WHERE staffID = '$updateid'";
        
        $result = mysqli_query($conn, $updatequery) or die (mysqli_error($conn));

            array_push($errors, "<div class='alert alert-success' id='regerror' role='alert'><i class='far fa-check-circle'></i> Changes saved!</div>"); 
            
        }         
    }
    
//ADMIN UPDATE STAFF BIO
    
    if(isset($_POST["updateStaffBioSubmit"]))     {
        
        $updateStaffBio = mysqli_real_escape_string($conn, $_POST["myUpdateStaffBio"]);
        $updateid = $_GET["staffid"];
     
        if(empty($updateStaffBio))   {

        header("location: editstaff.php?staffid=$updateid");
        
            array_push($errors, "<div class='alert alert-danger' role='alert'><i class='fas fa-exclamation-circle'></i> Please enter a new staff bio!</div>");
       
   } else {
        
        $updatequery = "UPDATE `staff` SET staffDesc='$updateStaffBio' WHERE staffID = '$updateid'";
        
        $result = mysqli_query($conn, $updatequery) or die (mysqli_error($conn));

            array_push($errors, "<div class='alert alert-success' id='regerror' role='alert'><i class='far fa-check-circle'></i> Changes saved!</div>"); 
            
        }         
    }
    
//ADMIN UPDATE STAFF PHOTO
 
   if(isset($_POST["updateStaffPhotoSubmit"]))   {
        
    $updateid = $_GET["staffid"];   
       
    //Image input
    $file = $_FILES["upload_image"];
    
    $fileName = $_FILES["upload_image"]["name"];
    $fileTmpName = $_FILES["upload_image"]["tmp_name"];
    $fileSize = $_FILES["upload_image"]["size"];
    $fileError = $_FILES["upload_image"]["error"];
    $fileType = $_FILES["upload_image"]["type"];
    
    //explode elements that make up file (file name and extension) 
    $fileExt = explode(".", $fileName);
        //convert all file-extensions to lowercase
        $fileActualExt = strtolower(end($fileExt));
        
        //restrict allowed uploadable file types
        $allowed = array("jpg", "jpeg", "png");
        
            //Check file-type is allowed
            if (in_array($fileActualExt, $allowed))   {
            
                //Check for upload error
                if ($fileError ===0)   {
                    
                    //Check for valid file-size
                    if ($fileSize < 10000000)    {
                        
                        //Create new unique filename using microseconds
                        $fileNameNew = uniqid("", true).'.'.$fileActualExt;
                            
                            //Destination for uploaded file
                            $fileDestination = "useruploads/".$fileNameNew;
                            
                                //Function to uploads file
                                move_uploaded_file($fileTmpName, $fileDestination);
                                
                                $updatequery = "UPDATE `staff` SET staffPic='".$fileNameNew."' WHERE staffID = '$updateid'";
                                
                                    $result = mysqli_query($conn, $updatequery) or die(mysqli_error($conn));
                                
                                    array_push($errors, "<div class='alert alert-success' id='regerror' role='alert'><i class='far fa-check-circle'></i> Changes saved!</div>"); 
                                    
                    } else {
                       
                        array_push($errors, "<div class='alert alert-danger' role='alert'><i class='fas fa-exclamation-circle'></i> File too big- Please try another image!</div>");
                        
                    }
                    
                } else {
                      
                      array_push($errors, "<div class='alert alert-danger' role='alert'><i class='fas fa-exclamation-circle'></i> A problem occurred- Please try again!</div>");
                    
                    }
                    
                } else {
                
                    array_push($errors, "<div class='alert alert-danger' role='alert'><i class='fas fa-exclamation-circle'></i> Cannot upload file-type! .jpg .jpeg or .png only</div>");
            }    
                    
}  
 

//ADMIN DELETE STAFF MEMBER 
    
    if(isset($_POST["myDeleteStaff"]))     {
        
        $deleteid = $_GET["staffid"];
     
        $deletequery = "DELETE FROM `staff` WHERE staffID = '$deleteid'";
        
        $result = mysqli_query($conn, $deletequery) or die (mysqli_error($conn));
        
            header('location: staffportal.php');
        
                array_push($errors, "<div class='alert alert-success' id='regerror' role='alert'><i class='far fa-check-circle'></i> Staff member deleted!</div>"); 

    }            
                
    
//ADMIN CREATE NEW NEWS ARTICLE 
    
if(isset($_POST["newArticleBtn"]))   {
    
    //Text inputs 
    $articleTitle = mysqli_real_escape_string($conn, $_POST["myArticleTitle"]);
    $articleContent = mysqli_real_escape_string($conn, $_POST["myArticleContent"]);
    
    //If file-uploader is empty and there are no errors
    if ($_FILES["myStaffPhoto"]["size"] == 0) {
        
        $noPhoto = null;
        
        $insertquery ="INSERT INTO `news` (articleID, articleTitle, articleContent, articleDate, articlePhoto) VALUES (null, '$articleTitle', '$articleContent', now(), '$noPhoto')";
                                
            $result = mysqli_query($conn, $insertquery) or die(mysqli_error($conn));
                                
                array_push($errors, "<div class='alert alert-success' role='alert'><i class='far fa-check-circle'></i> Article published!</div>"); 
    
    } else { 
    
    //Image input
    $file = $_FILES["myArticlePhoto"];
    
    $fileName = $_FILES["myArticlePhoto"]["name"];
    $fileTmpName = $_FILES["myArticlePhoto"]["tmp_name"];
    $fileSize = $_FILES["myArticlePhoto"]["size"];
    $fileError = $_FILES["myArticlePhoto"]["error"];
    $fileType = $_FILES["myArticlePhoto"]["type"];
    
    //explode elements that make up file (file name and extension) 
    $fileExt = explode(".", $fileName);
        //convert all file-extensions to lowercase
        $fileActualExt = strtolower(end($fileExt));
        
        //restrict allowed uploadable file types
        $allowed = array("jpg", "jpeg", "png");
        
            //Check file-type is allowed
            if (in_array($fileActualExt, $allowed))   {
            
                //Check for upload error
                if ($fileError ===0)   {
                    
                    //Check for valid file-size
                    if ($fileSize < 10000000)    {
                        
                        //Create new unique filename using microseconds
                        $fileNameNew = uniqid("", true).'.'.$fileActualExt;
                            
                            //Destination for uploaded file
                            $fileDestination = "useruploads/".$fileNameNew;
                            
                                //Function to uploads file
                                move_uploaded_file($fileTmpName, $fileDestination);
                                
                                $insertquery2 ="INSERT INTO `news` (articleID, articleTitle, articleContent, articleDate, articlePhoto) VALUES (null, '$articleTitle', '$articleContent', now(), '".$fileNameNew."')";
                                
                                    $result2 = mysqli_query($conn, $insertquery2) or die(mysqli_error($conn));
                                
                                    array_push($errors, "<div class='alert alert-success' role='alert'><i class='far fa-check-circle'></i> Article published!</div>"); 
                                    
                    } else {
                       
                        array_push($errors, "<div class='alert alert-danger' role='alert'><i class='fas fa-exclamation-circle'></i> File too big- Please try another image!</div>");
                        
                    }
                    
                } else {
                        
                      array_push($errors, "<div class='alert alert-danger' role='alert'><i class='fas fa-exclamation-circle'></i> A problem occurred- Please try again!</div>");
                    
                    }
                    
                } else {
                
                    array_push($errors, "<div class='alert alert-danger' role='alert'><i class='fas fa-exclamation-circle'></i> Cannot upload file-type! .jpg .jpeg or .png only</div>");
            }    
      }              
} 

//ADMIN UPDATE NEWS ARTICLE TITLE 

if(isset($_POST["updateArticleTitleSubmit"]))     {
        
        $updateArticleTitle = mysqli_real_escape_string($conn, $_POST["myUpdateArticleTitle"]);
        $updateid = $_GET["articleid"];
     
        if(empty($updateArticleTitle))   {

        header("location: editnews.php?articleid=$updateid");
        
            array_push($errors, "<div class='alert alert-danger' role='alert'><i class='fas fa-exclamation-circle'></i> Please enter a new title!</div>");
       
   } else {
        
        $updatequery = "UPDATE `news` SET articleTitle='$updateArticleTitle' WHERE articleID = '$updateid'";
        
        $result = mysqli_query($conn, $updatequery) or die (mysqli_error($conn));

            header("location: editnews.php?articleid=$updateid");
        
                array_push($errors, "<div class='alert alert-success' id='regerror' role='alert'><i class='far fa-check-circle'></i> Changes saved!</div>"); 
            
        }         
    } 
    
//ADMIN UPDATE NEWS ARTICLE CONTENT
    
if(isset($_POST["updateArticleContentSubmit"]))     {
        
        $updateArticleContent = mysqli_real_escape_string($conn, $_POST["myUpdateArticleContent"]);
        $updateid = $_GET["articleid"];
     
        if(empty($updateArticleContent))   {

        header("location: editnews.php?articleid=$updateid");
        
            array_push($errors, "<div class='alert alert-danger' role='alert'><i class='fas fa-exclamation-circle'></i> Please enter a new article content!</div>");
       
   } else {
        
        $updatequery = "UPDATE `news` SET articleContent='$updateArticleContent' WHERE articleID = '$updateid'";
        
        $result = mysqli_query($conn, $updatequery) or die (mysqli_error($conn));

            header("location: editnews.php?articleid=$updateid");
        
                array_push($errors, "<div class='alert alert-success' id='regerror' role='alert'><i class='far fa-check-circle'></i> Changes saved!</div>"); 
            
        }         
    } 

//ADMIN UPDATE NEWS ARTICLE IMAGE

   if(isset($_POST["updateArticlePhotoSubmit"]))   {
        
    $updateid = $_GET["articleid"];     
       
    //Image input
    $file = $_FILES["myUpdateArticlePhoto"];
    
    $fileName = $_FILES["myUpdateArticlePhoto"]["name"];
    $fileTmpName = $_FILES["myUpdateArticlePhoto"]["tmp_name"];
    $fileSize = $_FILES["myUpdateArticlePhoto"]["size"];
    $fileError = $_FILES["myUpdateArticlePhoto"]["error"];
    $fileType = $_FILES["myUpdateArticlePhoto"]["type"];
    
    //explode elements that make up file (file name and extension) 
    $fileExt = explode(".", $fileName);
        //convert all file-extensions to lowercase
        $fileActualExt = strtolower(end($fileExt));
        
        //restrict allowed uploadable file types
        $allowed = array("jpg", "jpeg", "png");
        
            //Check file-type is allowed
            if (in_array($fileActualExt, $allowed))   {
            
                //Check for upload error
                if ($fileError ===0)   {
                    
                    //Check for valid file-size
                    if ($fileSize < 10000000)    {
                        
                        //Create new unique filename using microseconds
                        $fileNameNew = uniqid("", true).'.'.$fileActualExt;
                            
                            //Destination for uploaded file
                            $fileDestination = "useruploads/".$fileNameNew;
                            
                                //Function to uploads file
                                move_uploaded_file($fileTmpName, $fileDestination);
                                
                                $updatequery = "UPDATE `news` SET articlePhoto='".$fileNameNew."' WHERE articleID = '$updateid'";
                                
                                    $result = mysqli_query($conn, $updatequery) or die(mysqli_error($conn));
                                
                                    header("location: editnews.php?articleid=$updateid");
                                    
                                    array_push($errors, "<div class='alert alert-success' id='regerror' role='alert'><i class='far fa-check-circle'></i> Changes saved!</div>"); 
                                    
                    } else {
                       
                        array_push($errors, "<div class='alert alert-danger' role='alert'><i class='fas fa-exclamation-circle'></i> File too big- Please try another image!</div>");
                        
                    }
                    
                } else {
                        
                      array_push($errors, "<div class='alert alert-danger' role='alert'><i class='fas fa-exclamation-circle'></i> A problem occurred- Please try again!</div>");
                    
                    }
                    
                } else {
                
                    array_push($errors, "<div class='alert alert-danger' role='alert'><i class='fas fa-exclamation-circle'></i> Cannot upload file-type! .jpg .jpeg or .png only</div>");
            }    
                    
} 

//ADMIN DELETE NEWS ARTICLE
    
    if(isset($_POST["myDeleteArticle"]))     {
        
        $deleteid = $_GET["articleid"];
     
        $deletequery = "DELETE FROM `news` WHERE articleID = '$deleteid'";
        
        $result = mysqli_query($conn, $deletequery) or die (mysqli_error($conn));

            header('location: newsportal.php');
        
                array_push($errors, "<div class='alert alert-success' id='regerror' role='alert'><i class='far fa-check-circle'></i> Article deleted!</div>");   
                
    } 
    
    
//CREATE NEW ADMIN 
    
    if(isset($_POST["newAdminBtn"]))   {
        
        //Text inputs 
        $adminEmail = mysqli_real_escape_string($conn, $_POST["myAdminEmail"]);
        $adminName = mysqli_real_escape_string($conn, $_POST["myAdminName"]);
        $adminPass = mysqli_real_escape_string($conn, $_POST["myAdminPassword"]);
        $adminPassConfirm = mysqli_real_escape_string($conn, $_POST["myAdminPasswordConfirm"]);
        
        if ($adminPass == $adminPassConfirm)    {
            
            $hashPass = password_hash($adminPass, PASSWORD_BCRYPT);
            
            $query = $query = "INSERT INTO `users` (userID, email, password, username, admin) VALUES (null, '$adminEmail', '$hashPass', '$adminName', 'Yes')";
        
                $result = mysqli_query($conn, $query) or die (mysqli_error($conn));

                    header("location: adminportal.php");
        
                    array_push($errors, "<div class='alert alert-success' id='regerror' role='alert'><i class='far fa-check-circle'></i> New Admin created!</div>"); 
            
        } else  {
            
            array_push($errors, "<div class='alert alert-danger' role='alert'><i class='fas fa-exclamation-circle'></i> New password does not match</div>");
    
        }
        
        
    }
    
    
//EDIT ADMIN USERNAME
    
    if(isset($_POST["updateAdminNameSubmit"]))     {
        
        $updateAdminName = mysqli_real_escape_string($conn, $_POST["myUpdateAdminName"]);
        $updateid = $_GET["adminid"];
     
        if(empty($updateAdminName))   {

        header("location: editadmin.php?adminid=$updateid");
        
            array_push($errors, "<div class='alert alert-danger' role='alert'><i class='fas fa-exclamation-circle'></i> Please enter a new username!</div>");
       
   } else {
        
        $updatequery = "UPDATE `users` SET username='$updateAdminName' WHERE userID = '$updateid'";
        
        $result = mysqli_query($conn, $updatequery) or die (mysqli_error($conn));

            array_push($errors, "<div class='alert alert-success' id='regerror' role='alert'><i class='far fa-check-circle'></i> Changes saved!</div>"); 
            
        }         
    }
    
    
//EDIT ADMIN EMAIL
    
    if(isset($_POST["updateAdminEmailSubmit"]))     {
        
        $updateAdminEmail = mysqli_real_escape_string($conn, $_POST["myUpdateAdminEmail"]);
        $updateid = $_GET["adminid"];
     
        if(empty($updateAdminEmail))   {

        header("location: editadmin.php?adminid=$updateid");
        
            array_push($errors, "<div class='alert alert-danger' role='alert'><i class='fas fa-exclamation-circle'></i> Please enter a new email!</div>");
       
   } else {
        
        $updatequery = "UPDATE `users` SET email='$updateAdminEmail' WHERE userID = '$updateid'";
        
        $result = mysqli_query($conn, $updatequery) or die (mysqli_error($conn));

            array_push($errors, "<div class='alert alert-success' id='regerror' role='alert'><i class='far fa-check-circle'></i> Changes saved!</div>"); 
            
        }         
    }
    
    
//CHANGE ADMIN USER PASSWORD 

if (isset($_POST["updateAdminPasswordSubmit"]))  {
    
    $updatePass1 = mysqli_real_escape_string($conn, $_POST["myUpdateAdminPassword"]);
    $updatePass2 = mysqli_real_escape_string($conn, $_POST["myUpdateAdminPasswordConfirm"]);
    $updateid = $_GET["adminid"];
    
        if ($updatePass1 == $updatePass2)    {
            
            $hashPass = password_hash($updatePass1, PASSWORD_BCRYPT);
            
            $updatequery = "UPDATE `users` SET password='$hashPass' WHERE username = '$updateid'";
        
                $result = mysqli_query($conn, $updatequery) or die (mysqli_error($conn));

                    header("location: login.php");
        
                    array_push($errors, "<div class='alert alert-success' id='regerror' role='alert'><i class='far fa-check-circle'></i> Changes saved!</div>"); 
            
        } else  {
            
            array_push($errors, "<div class='alert alert-danger' role='alert'><i class='fas fa-exclamation-circle'></i> New password does not match</div>");
    
        }
}


//ADMIN DELETE ADMIN USER
    
    if(isset($_POST["myDeleteAdmin"]))     {
        
        $deleteid = $_GET["adminid"];
     
        $deletequery = "DELETE FROM `users` WHERE userID = '$deleteid'";
        
        $result = mysqli_query($conn, $deletequery) or die (mysqli_error($conn));

            header('location: adminportal.php');
        
                array_push($errors, "<div class='alert alert-success' id='regerror' role='alert'><i class='far fa-check-circle'></i> Admin user deleted!</div>");   
                
    } 
    
    
//FILTER EVENT RESULTS
    
    if (isset($_POST["from_date"], $_POST["to_date"]))  {
        
        $output = "";
        
        $filterQuery = "SELECT * FROM `events` WHERE eventDate BETWEEN '".$_POST["from_date"]."' AND '".$_POST["to_date"]."' ORDER BY eventDate DESC LIMIT 10;";
        
            $result = mysqli_query($conn, $filterQuery) or die (mysqli_error($conn));

                if (mysqli_num_rows($result) >0)    {
                    
                    array_push($errors, "<div class='alert alert-success' id='regerror' role='alert'><i class='far fa-check-circle'></i> There are event(s) between your selected dates!</div>"); 

                    while($row = mysqli_fetch_array($result))   {

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
                    
                    //display if there is an attached file 
                    if ($attachment==null) {
                        $attachmentStatus = "";
                    } else {
                        $attachmentStatus = "<a class='btn btn-primary btn-sm' href='useruploads/$attachment' id='attachmentButton' role='button'>See attachment &nbsp;<i class='far fa-file-alt'></i></a>";
                    }
                        
                    $output .="    
                    
                    <div id='aboutQuote' align='center' class='qoute col-md-7'>
    
                        <div class='infoBox'> 
                
                        <div id='eventsBox' class='aboutBox bubble'>

                        <div class='headerWrap'>
                            <div id='headerLink'>
                            <h1>$event</h1>
                            </div>
                            <div id='headerHR'></div>
                        </div>
                        <br>$ticketStatus
                        <hr>
                        <p><p><i class='far fa-calendar-times'></i> ". date("d/m/Y", strtotime($date)) ." | <i class='fas fa-map-marker-alt'></i> $loc | <i class='far fa-clock'></i> $time";
            
                    $output .=" ".($today == $date ? "<span class='badge badge-pill badge-danger'>Today!</span>" : "")." ";
        
                    $output .="
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
                    
                }  else {
                    
                    $output .= "
                    
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
                        </div>";       
                }
                
                //send data to ajax success function
                //echo $output; 
           
}

//USER CHANGE ADMIN PASSWORD 

if (isset($_POST["changePassButton"]))  {
    
    $updatePass1 = mysqli_real_escape_string($conn, $_POST["myChangePass1"]);
    $updatePass2 = mysqli_real_escape_string($conn, $_POST["myChangePass2"]);
    
        if ($updatePass1 == $updatePass2)    {
            
            $hashPass = password_hash($updatePass1, PASSWORD_BCRYPT);
            
            $updatequery = "UPDATE `users` SET password='$hashPass' WHERE username = 'Admin'";
        
                $result = mysqli_query($conn, $updatequery) or die (mysqli_error($conn));

                    header("location: login.php");
        
                    array_push($errors, "<div class='alert alert-success' id='regerror' role='alert'><i class='far fa-check-circle'></i> Changes saved!</div>"); 
            
        } else  {
            
            array_push($errors, "<div class='alert alert-danger' role='alert'><i class='fas fa-exclamation-circle'></i> New password does not match</div>");
    
        }
}

//FORGOT PASSWORD FORM

    if (isset($_POST["resetPasswordSubmit"]))  {
        
        //Create tokens 
        $selector = bin2hex(random_bytes(8));
        //Authenticate user token
        $token = random_bytes(32);
        
        //Create reset link 
        $url = "www.interethnicforum.org.uk/createnewpassword.php?selector=" . $selector . "&validator=" . bin2hex($token);
        
        //Create token expiry date set to one hour after creation
        $expires = date("U") + 1800;
        
        $userEmail = $_POST["myemail"];
        
        //Delete existing db tokens for the user
        $sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?;";
            //Create prepared statement
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql))   {

                echo "ERROR!";
                exit();
                
            } else {
                
                //Prepared statement cont
                //Data to replace '?'  
                mysqli_stmt_bind_param($stmt, "s", $userEmail);
                mysqli_stmt_execute($stmt);
                
            }
            
            //Insert token into database 
            $sql = "INSERT INTO pwdReset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?, ?, ?, ?);";
        
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql))   {
                
                echo "ERROR!";
                exit();
                
            } else {
                
                //Encrypt sensitive data
                $hashedToken = password_hash($token, PASSWORD_DEFAULT);
                
                mysqli_stmt_bind_param($stmt, "ssss", $userEmail, $selector, $hashedToken, $expires);
                mysqli_stmt_execute($stmt);
                
            }
            
            //close db connection
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            
            //Set up email
            $to = $userEmail;
            $subject = 'Password reset: interethnicforum.org.uk';
            $message = '<p>We received a password reset request. The link to reset your password is below. If you did not make this resquest, then please ignore this message.</p>';
            //Continue above message variable
            //$message .= '<p>Here is your password reset link: </br>';
            $message .= '<a href="' .$url. '">' . $url .'</a>';
            
            //tell mail function how to send email
            $headers = "From: Inter Ethnic Forum <intereth@interethnicforum.org.uk>\r\n";
            $headers .= "Reply-To: intereth@interethnicforum.org.uk\r\n";
            $headers .= "Content-type: text/html\r\n";
            
            mail($to, $subject, $message, $headers, "-fintereth@interethnicforum.org.uk");
            
            header("Location: forgotpassword.php?reset=success");
            
    } else {
        //header("Location: index.php");
    }

//RESET FORGOT PASSWORD FORM

if (isset($_POST[createPasswordSubmit])) {
    
    $selector = $_POST["selector"];
    $validator = $_POST["validator"];
    $password = $_POST["pwd"];
    $passwordRepeat = $_POST["pwd-repeat"];
    
    if  (empty($password) || empty($passwordRepeat))  {
        header("Location: createnewpassword.php?newpwd=empty");
        exit();    
    } else if ($password != $passwordRepeat) {
        header("Location: createnewpassword.php?newpwd=pwdnotsame");
        exit();  
    }
    
    //Check for tokens
    //Get current date to check for token expiry 
    $currentDate = date("U");
    
    //select token from database
    $sql = "SELECT * FROM pwdReset WHERE pwdResetSelector=? AND pwdResetExpires >=?";
    //Create prepared statement
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql))   {

                echo "ERROR!";
                exit();
                
            } else {
                
                //Prepared statement cont
                //Select correct token using selector 
                mysqli_stmt_bind_param($stmt, "ss", $selector, $currentDate);
                mysqli_stmt_execute($stmt);
                
                $result = mysqli_stmt_get_result($stmt);
                    if (!$row = mysqli_fetch_assoc($result))  {
                        echo "Please resubmit your reset request!";
                        exit();
                    } else {
                        
                        //convert validator token into binary
                        $tokenBin = hex2bin($validator);
                        $tokenCheck = password_verify($tokenBin, $row["pwdResetToken"]);
                        
                        if ($tokencheck === false)   {
                            echo "Please resubmit your reset request!";
                            exit();
                        } else if ($tokenCheck === true)    {
                            
                            $tokenEmail = $row["pwdResetEmail"]; //''
                            
                            $sql = "SELECT * FROM users WHERE email=?;";
                            $stmt = mysqli_stmt_init($conn);
                            if (!mysqli_stmt_prepare($stmt, $sql))  {
                                echo "ERROR!";
                                exit();   
                            } else {
                                
                                mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                                mysqli_stmt_execute($stmt);
                                $result = mysqli_stmt_get_result($stmt);
                                if (!$row = mysqli_fetch_assoc($result))  {
                                    echo "There was an error!";
                                    exit();
                                } else {
                                    
                                    //Update password inside user table
                                    $sql = "UPDATE users SET password=? WHERE email=?";
                                    $stmt = mysqli_stmt_init($conn);
                                        if (!mysqli_stmt_prepare($stmt, $sql))  {
                                        echo "ERROR!";
                                        exit();   
                                    } else {
                                
                                        //create and hash new password
                                        $newPwdHash = password_hash($password, PASSWORD_BCRYPT);
                                        mysqli_stmt_bind_param($stmt, "ss", $newPwdHash, $tokenEmail);
                                        mysqli_stmt_execute($stmt);
                                        
                                        //delete existing user tokens on success
                                        $sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?";
                                        $stmt = mysqli_stmt_init($conn);
                                        if (!mysqli_stmt_prepare($stmt, $sql))  {
                                            echo "ERROR!";
                                            exit();    
                                        } else {
                                            mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                                            mysqli_stmt_execute($stmt);
                                            header("Location: login.php");
                                            
                                            array_push($errors, "<div class='alert alert-success' id='regerror' role='alert'><i class='far fa-check-circle'></i> Password updated! Please log in</div>"); 
                                            
                                        }
                                    }
                        
                                }
                            }
                            
                        }
                        
                        //match db token to token sent from from 
                        
                    }
                
            }
    
} else {
    //header("Location: index.php");
}


     
                
?>




