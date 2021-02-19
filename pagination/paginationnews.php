<?php

include ("conn.php");

$record_per_page = 5;
$page = ''; 
$output = '';

//assign page variable
if (isset($_POST["page"]))  {
    $page = $_POST["page"];   
} else {   
    $page = 1;   
}

    $start_from = ($page - 1) * $record_per_page;
        $query = "SELECT * FROM news ORDER BY articleDate DESC LIMIT $start_from, $record_per_page;";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {

                    $title = $row["articleTitle"];
                    $date = $row["articleDate"];
                    $photo = $row["articlePhoto"];
                    $articleid = $row["articleID"];
                    
                    //display default image if no uploaded image 
                    if (empty($row["articlePhoto"])){
                        $photo = "<img src='img/newsdefaultimg.jpg' style='max-width: 100%; height: auto;'/>"; 
                     } else {
                        $photo = "<img src='useruploads/" . $row['articlePhoto'] . "' style='max-width: 100%; height: auto;'/>";
                     }                     
                    
                    echo "   
                    <div class='newsPrevContainer col-xl-12'> 
                        <div class='row'>
                            <div class='col-xl-5 pl-0'><a href='newspage.php?articleid=$articleid'>$photo</a></div>
                                <div class='col-xl-7' align='left' style='margin: auto;'>
                                    <a href='newspage.php?articleid=$articleid'><h3>$title</h3></a>
                                        <div class='helpBox'></small></div>
                                        <p>"; $content=substr($row['articleContent'], 0, 200); echo" $content...</p>
                                    <hr>
                                    <a href='newspage.php?articleid=$articleid'><i class='far fa-arrow-alt-circle-right'></i> Read more </a>| <small><i class='far fa-calendar-times'></i> ". gmdate("d/m/Y | H:i", strtotime($date)) ."</small>                     
                                </div>
                            </div>
                        </div>
                    </div>

                    ";
                         } 
                    } else {
                        echo "   
                        <div class='container'>
                            <div class='row'>
                                <div class='newsPreview col-xs-12 mx-auto'> 
                                    <h5><i>No Results</i></h5>
                                </div>
                            </div>
                        </div>
                        ";
                    }

                    //PAGINATION LINKS
                    $output .= "<div class='col-md-12' align='center'> 
                                <br>
                                <nav aria-label='Page navigation example'>
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

