<!DOCTYPE HTML><html lang="en">
<head>
<meta charset="UTF-8">
<title>Limbo Landing Page</title>
    <link href="css/main.css" type="text/css" rel="stylesheet"/>
    <link href="css/landing.css" type="text/css" rel="stylesheet"/>
</head>
<body style="background-color: #DBDBDB;">
    <div id = "header">
        <header>
            <img src="MaristRiverLimbo.jpg" style="width:1655px;height:550px;">
        </header>
    </div>
 <ul>
  <li><a href="landing.php">Home</a></li>
  <li><a href="lost.php">Lost Something?</a></li>
  <li><a href="found.php">Found something?</a></li>
  <li><a href="limbo_login.php">Admins</a></li>
</ul>   
    
<div id = "message">
    <div id = "messageT1" style="font-weight:bold"> Home </div>
    <div id = "messageT2"> Welcome to <em>Limbo</em>, a Lost & Found Application for Marist College in Poughkeepsie, NY. </div>
    <div id = "messageT3"> Below is a table of all of the lost & found items on campus. If you want to report an item lost or found, you can navigate to the links on top to do so. </div>
    <div id = "messageT3"> If you are an administrator, navigate to the "Admins" link on the top. </div>
</div>
    
<?php
# Connect to MySQL server and the database
require('includes/limbo_db.php') ;
    
require('includes/limbohelpers.php') ;

# Create a query to get the name and price sorted by price
$query = 'SELECT datelost, item, location, description, status FROM stuff ORDER BY datelost DESC' ;

# Execute the query
$results = mysqli_query( $dbc , $query ) ;


admin_message($dbc, $adminmessage);

# Show the link records
show_link_records($dbc);    
    
  if ( $_SERVER[ 'REQUEST_METHOD' ] == 'GET' ) {
  $id = "" ;
  $datelost = "" ;
  $location = "" ;
  $item = "" ;
  $desc = "" ;    
  $contact = "" ;   
    
}  
 
    
    
    if($_SERVER[ 'REQUEST_METHOD' ] == 'GET') {
     if(isset($_GET['id'])) 
         show_record($dbc, $_GET['id']) ;
}



        
# Close the connection
mysqli_close( $dbc ) ;
?>
    
<hr>
    
<footer style="font-family:Trebuchet MS; font-size: 10px; font-style: italic;">
    <p> We hope you found what you needed! </p>
    <p> For any questions or comments, please contact: <a href="mailto:hannah.youssef1@marist.edu">Hannah Youssef</a>, <a href="mailto:william.esposito1@marist.edu">William Esposito</a>, or <a href="mailto:jenna.daly1@marist.edu">Jenna Daly</a>.
    </p>
</footer>
  </body>
</html>