<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Lost Something?</title>
    <link href="css/main.css" type="text/css" rel="stylesheet"/>
    <link href="css/lost.css" type="text/css" rel="stylesheet"/>
</head>
<body>
    <div id = "header">
        <header> Marist College Limbo </header>
    </div>
 <ul>
  <li><a href="landing.php">Home</a></li>
  <li><a href="lost.php">Lost Something?</a></li>
  <li><a href="found.php">Found something?</a></li>
  <li><a href="limbo_login.php">Admins</a></li>
</ul>  
    <div id = "message">
    <div id = "messageT1" style="font-weight:bold"> Lost Something? </div>
    <div id = "messageT2"> If you lost something, here is where you report it. </div>
    <div id = "messageT3"> Please fill out all of the fields! </div>
</div>
    
<?php
    
# Team Members: Hannah Youssef and William Esposito and Jenna Daly
# Version 1.5 November 2, 2017
# Lab 9

# Connect to MySQL server and the database
require('includes/limbo_db.php' ) ;

# Includes these helper functions
require('includes/Limbohelpers.php' ) ;

# Initializng variables
    $adminmessage= null;

if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
    $adminmessage = $_POST['adminmessage'] ;


}
    
# Validates fields top insert into table
/*if(!valid_number($number)) {
  echo '<p style="color:red">Number error.</p>' ;
} else if (!valid_lname($fname)) {
  echo '<p style="color:red">First name error.</p>' ;
} else if (!valid_lname($lname)) {
  echo '<p style="color:red">Last name error.</p>' ;
} else { */


    
    #Insert message into table
    insert_adminmessage($dbc, $adminmessage);


    
# If user opened the page without submitting, initialize the fields
if ( $_SERVER[ 'REQUEST_METHOD' ] == 'GET' ) {
   $adminmessage = null; 
    
if(isset($_GET['id'])) show_record($dbc, $_GET['id']) ;
}

    
# Otherwise, user submitted the form, so let's validate
else if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' )
{
    
  # Initialize an error array.
  $errors = array();

    $adminmessage = $_POST['adminmessage'] ;
    
  # Check for a name & email address.
  if ( empty( $_POST[ 'adminmessage' ] ) ) {
  	$errors[] = 'message' ;
  }
  else {
  	$datelost = trim( $adminmessage )  ;
  }


  # Report result.
  if( !empty( $errors ) )
  {
     echo '<p style="font-family: Trebuchet MS;">Error! Please enter </p>' ;
    foreach ( $errors as $field ) { echo '<p style="font-family: Trebuchet MS;"> - ', $field ; }
  }
  else {
  	echo '<p style="font-family: Trebuchet MS;">Success! Thanks!</p>' ;
  }
}

 
# Show the link records
#show_link_records($dbc);

# Close the connection
mysqli_close( $dbc ) ;
    

# Show the input form with whatever we got for fields
  show_form($adminmessage) ;



# Shows the input form
function show_form($adminmessage) {
  echo '<form action="admin1e.php" method="POST" style="font-family: Trebuchet MS;">' ;
  echo '<p>Message: <input type="text" name="adminmessage" value="' . $adminmessage . '"></p>' ;
  echo '<p><input type="submit"></p>' ;
  echo '</form>' ;
}
    
?>

</html>