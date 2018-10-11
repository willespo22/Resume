<!DOCTYPE html>
<html>
  <head>
<meta charset="UTF-8">
<title>Add Admins</title>
    <link href="css/main.css" type="text/css" rel="stylesheet"/>
    <link href="css/deleteadmin.css" type="text/css" rel="stylesheet"/>
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
    <div id = "messageT1" style="font-weight:bold"> Delete Admins </div>
    <div id = "messageT2"> If you want to delete an administator account, please do so below. </div>
</div>
    
<?php
    
# Team Members: Hannah Youssef and William Esposito and Jenna Daly
    
# Connect to MySQL server and the database
require( 'includes/limbo_db.php' ) ;
    
# Includes these helper functions
require( 'includes/limbohelpers.php' ) ;

# Create a query to get the name and price sorted by price
$query = 'SELECT user_id, email, pass2 FROM users ORDER BY user_id ASC' ;

# Execute the query
$results = mysqli_query( $dbc , $query ) ;

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

  # For each row result, generate a table row
  /* while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
  {
    echo '<TR>' ;
    echo '<TD>' . $row['datelost'] . '</TD>' ;
    echo '<TD>' . $row['status'] . '</TD>' ;
    echo '<TD>' . $row['item'] . '</TD>' ;
    echo '</TR>' ;
  } */
    
    while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
  {
    echo '<TR>' ;
	echo '<TD>' . $row['user_id'] . '</TD>' ;
    echo '<TD>' . $row['email'] . '</TD>' ;
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

  # Free up the results in memory
  mysqli_free_result( $results ) ;
}
else
{
  # If we get here, something has gone wrong
  echo '<p>' . mysqli_error( $dbc ) . '</p>'  ;
}

$sql = "DELETE FROM users WHERE user_id=" .$user_id. " LIMIT 1 ";

if (mysqli_query($dbc, $sql)) {
    echo '<p style="font-family: Trebuchet MS">Row deleted</p>';
} else {
    echo '<p style="font-family: Trebuchet MS">Error!</p>' ;
}

# Close the connection
mysqli_close( $dbc ) ;
?>
</html>
  </body>
  
<form action="deleteadmin.php" method="POST">

<p style="font-family: Trebuchet MS">Enter the admin's username that you want to delete: <br>(Press submit twice)<input type="text" name="user_id" value="<?php if (isset($_POST['user_id'])) echo $_POST['user_id']; ?>"> </p>
<p><input type="submit"></p>
</form>

</html>