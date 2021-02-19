<?php

include ("conn.php");

$record_per_page = 9;
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

$query = "SELECT * FROM gallery ORDER BY id DESC LIMIT $start_from, $record_per_page";
    $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_array($result)) {

            $img = $row["path"];
            $uploadDate = $row["uploadDate"];
            $img = "<img id='modalImg' src='useruploads/" . $row['path'] . "' style='max-width: 100%; height: auto;'/>";

            $output .= "
                <div class='col-md-4 mainGalleryImg'>
                    <div class='myImg'>
                        <div class='pop'>
                            $img
                        </div>
                        <br>
                    </div>
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
            $page_query = "SELECT * FROM gallery ORDER BY id DESC";
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




