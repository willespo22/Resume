<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Change Password</title>
    <link href="css/main.css" type="text/css" rel="stylesheet"/>
    <link href="css/changepass.css" type="text/css" rel="stylesheet"/>
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
    <div id = "messageT1" style="font-weight:bold"> Change Password </div>
    <div id = "messageT2"> If you want to change your password, please enter the fields below. </div>
</div>
    
<?php
    
# Team Members: Hannah Youssef and William Esposito and Jenna Daly
# Version 1.5 November 2, 2017
# Lab 9
    
# Connect to MySQL server and the database
    
    
require( 'includes/limbo_db.php' ) ;
    
# Includes these helper functions
require( 'includes/limbohelpers.php' ) ;
# Create a query to get the name and price sorted by price
$query = 'SELECT user_id, email, pass2, pass1 FROM users ORDER BY user_id ASC' ;

# Execute the query
$results = mysqli_query( $dbc , $query ) ;
    
#Initialize variables
$salted = null;
$pass1 = null;
    
#password hashing & salting  
$hashed = hash('sha512', $salted); 
      
$salted = "ipFJIPhwfpihfpwhfhp98khgyotftt".$pass1;    

# Show results
if( $results )
{
  # But...wait until we know the query succeeded before
  # starting the table.
  echo '<H1>Current DB</H1>' ;
  echo '<TABLE border="1">';
  echo '<TR>';
  echo '<TH>User ID</TH>';
  echo '<TH>Email</TH>';
  echo '</TR>';
    
    while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
  {
    echo '<TR>' ;
	echo '<TD>' . $row['user_id'] . '</TD>' ;
    echo '<TD>' . $row['email'] . '</TD>' ;
	//probably shouldn't display other people's password
    echo '</TR>' ;
  }

  # End the table
  echo '</TABLE>';
  
  
if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
    $user_id = $_POST['user_id'] ;
}
if ( $_SERVER[ 'REQUEST_METHOD' ] == 'GET' ) {
	$user_id = "" ;
}
if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
    $pass2 = $_POST['pass2'] ;
}
if ( $_SERVER[ 'REQUEST_METHOD' ] == 'GET' ) {
	$pass2 = "" ;
}

  # Free up the results in memory
  mysqli_free_result( $results ) ;
}
else
{
  # If we get here, something has gone wrong
  echo '<p style="font-family: Trebuchet MS">' . mysqli_error( $dbc ) . '</p>'  ;
}

$sql = ("UPDATE users SET pass2 = '$pass2' WHERE user_id = $user_id");

if (mysqli_query($dbc, $sql)) {
    echo '<p style="font-family: Trebuchet MS">Success! Password changed</p>';
} else {
    echo '<p style="font-family: Trebuchet MS">Error!</p>' ;
}

# Close the connection
mysqli_close( $dbc ) ;
?>
</html>
  </body>
  
<form action="changepass.php" method="POST">

<p style="font-family: Trebuchet MS">Change password to: <input type="text" name="pass2" value="<?php if (isset($_POST['pass2'])) echo $_POST['pass2']; ?>"> </p>
<p style="font-family: Trebuchet MS"> User id: (Press submit twice) = <input type="text" name="user_id" value="<?php if (isset($_POST['user_id'])) echo $_POST['user_id']; ?>"> </p>
<p><input type="submit"></p>
</form>

</html>