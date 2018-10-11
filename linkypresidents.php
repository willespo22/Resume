<!DOCTYPE HTML><html lang="en">
<head>
<meta charset="UTF-8">
<title>PHP Sticky Form</title>
</head>
<body>
    
<?php
    
# Team Members: Hannah Youssef and William Esposito
# Version 1.5 November 2, 2017
# Lab 9

# Connect to MySQL server and the database
require( 'includes/connect_db.php' ) ;

# Includes these helper functions
require( 'includes/helpers.php' ) ;

if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
    $number = $_POST['number'] ;

    $fname = $_POST['fname'] ;
    
    $lname = $_POST ['lname'] ;

}
    
# Validates fields top insert into table
if(!valid_number($number)) {
  echo '<p style="color:red">Number error.</p>' ;
} else if (!valid_lname($fname)) {
  echo '<p style="color:red">First name error.</p>' ;
} else if (!valid_lname($lname)) {
  echo '<p style="color:red">Last name error.</p>' ;
} else {
  insert_record($dbc,$number,$fname,$lname) ;
}

    
# If user opened the page without submitting, initialize the fields
if ( $_SERVER[ 'REQUEST_METHOD' ] == 'GET' ) {
  $number = "" ;
  $fname = "" ;
  $lname = "" ;
    
if(isset($_GET['id'])) show_record($dbc, $_GET['id']) ;
}

    
# Otherwise, user submitted the form, so let's validate
else if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' )
{
    
  # Initialize an error array.
  $errors = array();

  $number = $_POST[ 'number' ] ;
  $fname = $_POST[ 'fname' ] ;
  $lname = $_POST[ 'lname' ] ;

  # Check for a name & email address.
  if ( empty( $_POST[ 'number' ] ) ) {
  	$errors[] = 'number' ;
  }
  else {
  	$number = trim( $number )  ;
  }

  if ( empty( $_POST[ 'fname' ] ) ) {
  	$errors[] = 'fname' ;
  }
  else {
  	$fname = trim( $fname )  ;
  }

  if ( empty( $_POST[ 'lname' ] ) ) {
  	$errors[] = 'lname' ;
  }
  else {
  	$lname = trim( $lname )  ;
  }

  # Report result.
  if( !empty( $errors ) )
  {
    echo 'Error! Please enter your ' ;
    foreach ( $errors as $field ) { echo " - $field " ; }
  }
  else {
  	echo "<p>Success! Thanks!</p>" ;
  }
}

 
# Show the link records
show_link_records($dbc);

# Close the connection
mysqli_close( $dbc ) ;
    

# Show the input form with whatever we got for fields
  show_form($number,$fname,$lname) ;


# Shows the input form
function show_form($number,$fname,$lname) {
  echo '<form action="linkypresidents.php" method="POST">' ;
  echo '<p>Number: <input type="number" name="number" value="' . $number . '"> </p> ' ;
  echo '<p>First Name: <input type="text" name="fname" value="' . $fname . '"></p>' ;
  echo '<p>Last Name: <input type="text" name="lname" value="' . $lname . '"> </p> ' ;
  echo '<p><input type="submit"></p>' ;
  echo '</form>' ;
}
    
?>

</html>