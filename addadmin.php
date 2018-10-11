<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Add Admins</title>
    <link href="css/main.css" type="text/css" rel="stylesheet"/>
    <link href="css/addadmin.css" type="text/css" rel="stylesheet"/>
</head>
<body>
    <div id = "header">
        <header>
            <img src="LibraryLIMBO.jpg" style="width:1655px;height:550px;">
        </header>
    </div>
 <ul>
  <li><a href="landing.php">Home</a></li>
  <li><a href="lost.php">Lost Something?</a></li>
  <li><a href="found.php">Found something?</a></li>
  <li><a href="limbo_login.php">Admins</a></li>
</ul>  
    <div id = "message">
    <div id = "messageT1" style="font-weight:bold"> Add Admins </div>
    <div id = "messageT2"> If you want to add another administator account, please type the username and password below. </div>
</div>
    
<?php
    
# Team Members: Hannah Youssef and William Esposito and Jenna Daly
# Version 1.5 November 2, 2017
# Lab 9

# Connect to MySQL server and the database

      
require( 'includes/limbo_db.php' ) ;
    
# Includes these helper functions
require( 'includes/limbohelpers.php' ) ;

#Initialize variables
$pass1 = null;
$pass2 = null;
$salted = null;      

#password hashing & salting  
$hashed = hash('sha512', $salted); 
      
$salted = "ipFJIPhwfpihfpwhfhp98khgyotftt".$pass1;

          
if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
    $email = $_POST['email'] ;

    $pass1 = $_POST['pass1'] ;
    
    $pass2 = $_POST['pass2'] ;


}
    
    
# If user opened the page without submitting, initialize the fields
if ( $_SERVER[ 'REQUEST_METHOD' ] == 'GET' ) {
  $email = "" ;
  $pass1 = "" ;
  $pass2 = "" ;    

if(isset($_GET['id'])) show_record($dbc, $_GET['id']) ;
}

    
# Otherwise, user submitted the form, so let's validate
else if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' )
{
    
# Initialize an error array.
  $errors = array();

    $email = $_POST['email'] ;

    $pass1 = $_POST['pass1'] ;
    
    $pass2 = $_POST['pass2'] ;

  # Check for a name & email address.
  if ( empty( $_POST[ 'email' ] ) ) {
  	$errors[] = 'email' ;
  }
  else {
  	$email = trim( $email )  ;
  }

  if ( empty( $_POST[ 'pass1' ] ) ) {
  	$errors[] = 'pass1' ;
  }
  else {
  	$pass1 = trim( $pass1 )  ;
  }
   if ( empty( $_POST[ 'pass2' ] ) ) {
  	$errors[] = 'pass2' ;
  }
  else {
    $pass2 = trim( $pass2 )  ;  
  }    
  if ($pass1 != $pass2) {
      $errors[] = '<p style="font-family: Trebuchet MS">Passwords do not match</p>' ;
  }


  # Report result.
  if( !empty( $errors ) )
  {
    echo '<p style="font-family: Trebuchet MS">Error! Please enter your </p>' ;
    foreach ( $errors as $field ) { echo " - $field " ; }
  }
  else {
  	echo '<p style="font-family: Trebuchet MS">Success! Thanks!</p>' ;
  }
}

 
# Show the link records
show_recordstwo($dbc);
 
# Insert the records      
insert_recordtwo($dbc, $email, $hashed, $pass2);      

# Close the connection
mysqli_close( $dbc ) ;
    

# Show the input form with whatever we got for fields
  show_form($email,$pass1,$pass2) ;



# Shows the input form
function show_form($email,$pass1,$pass2) {
  echo '<form action="addadmin.php" method="POST">' ;
  echo '<p>Add Email: <input type="text" name="email" value="' . $email . '"> </p> ' ;
  echo '<p>With Password: <input type="password" name="pass1" value="' . $pass1 . '"></p>' ;
  echo '<p>Repeat Password: <input type="password" name="pass2" value="' . $pass2 . '"></p>' ;       
  echo '<p><input type="submit"></p>' ;
  echo '</form>' ;
}
    
?>

</html>