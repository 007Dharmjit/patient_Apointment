<?php 
include('xyz.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $hospi = $_POST['hos'];
    $add = $_POST['addr'];

    echo"$hospi";
    echo"$add";
}

?>