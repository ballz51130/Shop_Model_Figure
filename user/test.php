<?php 

 for($i = 0; $i < count($_POST['check']); $i++){
    $num = $_POST['check'][$i];
    echo $num .'<br>';
}
?>