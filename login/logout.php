
<?php
echo "<script type='text/javascript'>alert('ขอบคุณที่ใช้บริการ');</script>";
session_start();
session_destroy();
echo "<META HTTP-EQUIV='Refresh' CONTENT ='1;URL=../index.php'>";
?>
