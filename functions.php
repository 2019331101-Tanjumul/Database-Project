<?php
function prx($data){ 
    echo '<pre>';
    print_r($data); 
    die(); 
}
function get_safe_value($data){ 
    global $con; 
 if($data){ 
    return mysqli_real_escape_string($con,$data);
 }
}
?>