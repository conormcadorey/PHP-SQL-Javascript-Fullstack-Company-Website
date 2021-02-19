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
            $query = "SELECT * FROM users LIMIT $start_from, $record_per_page;";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {

                    $adminName = $row["username"];
                    $adminEmail = $row["email"];
                    $adminStatus = $row["admin"];
                    $adminid = $row["userID"];
                    
                    //Main admin not editable
                    if ($adminName == "Admin" )  {
                        
                        echo "
                        <div class='editEventCard'>
                            <h4><b>$adminName</b></h4>
                            <p>Email: $adminEmail </p>
                            <a class='btn btn-primary disabled' id='editAdminButton' role='button'>
                                Cannot edit! &nbsp;<i class='far fa-edit'></i>
                            </a>
                            <hr>
                        </div>
                        ";    
                    } else {   
                        echo "
                        <div class='editEventCard'>
                            <h4><b>$adminName</b></h4>
                            <p>Email: $adminEmail </p>
                            <a class='btn btn-primary' href='editadmin.php?adminid=$adminid' id='editAdminButton' role='button'>Edit Admin &nbsp;<i class='far fa-edit'></i></a>
                            <hr>
                        </div>
                        ";  
                        }   
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

