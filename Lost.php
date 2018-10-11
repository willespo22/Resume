<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Lost Something?</title>
    <link href="css/main.css" type="text/css" rel="stylesheet"/>
    <link href="css/lost.css" type="text/css" rel="stylesheet"/>
</head>
<body style="background-color: #DBDBDB;">
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
    $datelost = null;
    $location = null;
    $item = null;
    $desc= null;
    $contact = null;
    $status = null;    

if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
    $datelost = $_POST['datelost'] ;

    $location = $_POST['location'] ;
    
    $item = $_POST ['item'] ;
    
    $desc = $_POST ['desc'] ;
    
    $contact = $_POST ['contact'] ;
	
	$status = $_POST ['status'] ;

}
    
# Validates fields top insert into table
/*if(!valid_number($number)) {
  echo '<p style="color:red">Number error.</p>' ;
} else if (!valid_lname($fname)) {
  echo '<p style="color:red">First name error.</p>' ;
} else if (!valid_lname($lname)) {
  echo '<p style="color:red">Last name error.</p>' ;
} else { */


    
    
    insert_record($dbc, $datelost, $location, $item, $desc, $contact, $status);


    
# If user opened the page without submitting, initialize the fields
if ( $_SERVER[ 'REQUEST_METHOD' ] == 'GET' ) {
  $datelost = "" ;
  $location = "" ;
  $item = "" ;
  $desc = "" ;    
  $contact = "" ;   
  $status = "" ;   
    
if(isset($_GET['id'])) show_record($dbc, $_GET['id']) ;
}

    
# Otherwise, user submitted the form, so let's validate
else if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' )
{
    
  # Initialize an error array.
  $errors = array();

    $datelost = $_POST['datelost'] ;

    $location = $_POST['location'] ;
    
    $item = $_POST ['item'] ;
    
    $desc = $_POST ['desc'] ;
    
    $contact = $_POST ['contact'] ;

	$status = $_POST ['status'] ;
    
  # Check for a name & email address.
  if ( empty( $_POST[ 'datelost' ] ) ) {
  	$errors[] = 'the Date Lost' ;
  }
  else {
  	$datelost = trim( $datelost )  ;
  }

  if ( empty( $_POST[ 'location' ] ) ) {
  	$errors[] = 'the Location' ;
  }
  else {
  	$location = trim( $location )  ;
  }

  if ( empty( $_POST[ 'item' ] ) ) {
  	$errors[] = 'The Item Name' ;
  }
  else {
  	$item = trim( $item )  ;
  }

  if ( empty( $_POST[ 'desc' ] ) ) {
  	$errors[] = 'The Description' ;
  }
  else {
  	$desc = trim( $desc )  ;
  }
    
  if ( empty( $_POST[ 'contact' ] ) ) {
  	$errors[] = 'Your Contact Information' ;
  }
  else {
  	$contact = trim( $contact )  ;
  }    

  if ( empty( $_POST[ 'status' ] ) ) {
  	$errors[] = 'Status' ;
  }
  else {
  	$status = trim( $status )  ;
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
  show_form($datelost,$location,$item,$desc,$contact, $status) ;



# Shows the input form
function show_form($datelost,$location,$item, $desc, $contact, $status) {
  echo '<form action="lost.php" method="POST" style="font-family: Trebuchet MS;">' ;
    
  echo '<p><b>Date/Time Lost: </b><br><em>Enter the date & time the item was lost. If you are not using Google Chrome, enter it in the format: YYYY-MM-DDTHH:MM</em><br><input type="datetime-local" name="datelost" value="' . $datelost . '"> </p> ' ;
    
  echo '<p><b>Location: </b><br><em>Enter the location the item was last seen.</em><br><input type="text" name="location" value="' . $location . '"></p>' ;
    
  echo '<p><b>Item: </b><br><em>Enter a brief name of the item.</em><br><input type="text" name="item" value="' . $item . '"> </p> ' ;
    
  echo '<p><b>Description: </b><br><em>Enter a detailed description of the item.</em><br><input type="text" name="desc" value="' . $desc . '"> </p> ' ; 

  echo '<p><b>Contact Information: </b><br><em>Enter your contact information such as: Name, Email, and Phone Number.</em><br><input type="text" name="contact" value="' . $contact . '"> </p> ' ;

  #submits every form from this page as a "lost" status
  echo '<p><input type="text" name="status" value="lost" hidden> </p> ' ;  
    
  echo '<p><input type="submit"></p>' ;
    
  echo '</form>' ;
}
    
?>
<hr>
    
<footer style="font-family:Trebuchet MS; font-size: 10px; font-style: italic;">
    <p> We hope you found what you needed! </p>
    <p> For any questions or comments, please contact: <a href="mailto:hannah.youssef1@marist.edu">Hannah Youssef</a>, <a href="mailto:william.esposito1@marist.edu">William Esposito</a>, or <a href="mailto:jenna.daly1@marist.edu">Jenna Daly</a>.
    </p>
</footer>
</html>