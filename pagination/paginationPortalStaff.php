<?php

include ("conn.php");

$record_per_page = 5;
$page = ''; //store current page number
$output = '';

//check if page variable is present 
if (isset($_POST["page"]))  {
    
    //ajax function
    $page = $_POST["page"];
    
} else {
    
    $page = 1;
    
}

$start_from = ($page - 1) * $record_per_page;
            
$query = "SELECT * FROM staff LIMIT $start_from, $record_per_page;";         
    $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {

                $name = $row["staffName"];
                $email = $row["staffEmail"];
                $role = $row["staffRole"];
                $desc = $row["staffDesc"];
                $photo = $row["staffPic"];
                $staffid = $row["staffID"];

                //display default image if no uploaded profile photo 
                if (empty($row["staffPic"])){
                    $photo = "<img src='img/profileIcon.png' style='width:95px; height:95px; border-radius: 50%;'/>"; 
                 } else {
                    $photo = "<img src='useruploads/" . $row['staffPic'] . "' style='width:95px; height:95px; border-radius: 50%;'/>";
                 }
                    
                echo "
                    <div class='editEventCard'>
                        <br>
                            <div class='row'>
                            <div class='col-xs-3 mx-auto'>
                               $photo
                            </div>
                            <div class='col-xs-9 mx-auto'>
                                <h4><b>$name</b></h4>
                                <p>$role</p>        
                                <a class='btn btn-primary' href='editstaff.php?staffid=$staffid' id='editStaffButton' role='button'>Edit Profile &nbsp;<i class='far fa-edit'></i></a>
                            </div>
                        </div>
                    <hr>
                    </div>
                 ";  
            }    
        } else {
                echo "
                    <div class='editEventCard'>
                        <p>No Results </p>
                        <hr>
                    </div>
                ";
            }

    //PAGINATION LINKS
    $output .= "<div class='col-md-12' align='center'> <nav aria-label='Page navigation example'>
                <ul class='pagination justify-content-center'> <li class='page-item disabled'>
                        <a class='page-link' href='#' aria-label='Previous'>
                        <span aria-hidden='true'>&laquo;</span>
                        <span class='sr-only'>Previous</span>
                        </a>
                    </li>";  
    $page_query = "SELECT * FROM news ORDER BY articleDate DESC";
    $page_result = mysqli_query($conn, $page_query);
    $total_records = mysqli_num_rows($page_result);
    $total_pages = ceil($total_records/$record_per_page);

    for ($i=1; $i <=$total_pages; $i++)  {
        
        $output .="<span class='pagination_link page-link' style='cursor:pointer;' id='".$i."'>".$i."</span>"; 
                    
    }
    
    $output .= " <li class='page-item disabled'>
                        <a class='page-link' href='#' aria-label='Next'>
                        <span aria-hidden='true'>&raquo;</span>
                        <span class='sr-only'>Next</span>
                        </a>
                    </li></ul>
            </nav> </div>";

    echo $output;
