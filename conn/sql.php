<?php 

$sql ="SELECT orders.O_ID,orders.P_Number,orders.U_ID,orders.O_Unit,product.P_Number,product.P_Name,product.P_Price,product.P_Photo,user.U_FName,user.U_LName,orders.O_Status FROM orders
INNER JOIN product ON product.P_Number = orders.P_Number
INNER JOIN user ON user.U_ID = orders.U_ID
WHERE user.U_ID = '".$_SESSION['User']."' ";


?>