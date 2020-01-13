<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
     <link rel="stylesheet" href="../style.css">
    <title>Document</title>
</head>
<body>
<div class="menubar">
          <div class="contriner">
               <div class="logo">
               <div id="mySidenav" class="sidenav">
               <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
               <a href="#">About</a>
               <a href="#">Services</a>
               <a href="#">Clients</a>
               <a href="#">Contact</a>
               </div>
                 <h1><span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; open</span></h1>
               </div>
               <ul class="menu">

                    <li>
                        <a href=""> <button>Logout</button></a>
                    </li>
                    
                 </ul> 

          </div>
    </div>
     <section class="info1">
          <div class="contriner1">
            
          </div>
     </section> 
     <footer>
          <p> 2019-2020 </p>
     </footer>
     <script>
               function openNav() {
               document.getElementById("mySidenav").style.width = "350px";
               }

               function closeNav() {
               document.getElementById("mySidenav").style.width = "0";
               }
               </script>
</body>
</html>