<?php
session_start();
session_unset();
session_destroy();
if(isset($_GET['pages'])){
    $pages = $_GET['pages'];
    header("location:../index.php");
}
else{
    header("location:../index.php");
}
?>