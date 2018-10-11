<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Style-Type" content="text/css" /> 
    <title>Current Submissions</title>
    <link href="/library/skin/tool_base.css" type="text/css" rel="stylesheet" media="all" />
    <link href="/library/skin/morpheus-default/tool.css" type="text/css" rel="stylesheet" media="all" />
    <script type="text/javascript" src="/library/js/headscripts.js"></script>
    <style>body { padding: 5px !important; }</style>
	<style>
ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
	overflow: hidden;
    background-color: red;
	text-align: center;
}

li {
    float: left;
	border-right: 1px solid #bbb;
}

li a {
    display: block;
    color: white;
    text-align: center;
    padding: 12px 12px;
}

li a:hover {
    background-color:grey ;
}

a:link, a:visited {
    background-color: red;
    color: white;
    padding: 14px 25px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
}

a:hover {
	background-color:grey;
}

p {
	display: inline-block;
	margin-top: 20px;
	margin-left: 60px;
	text-align: center;
}
</style>
  </head>
  <body>
  <ul>
  <li><a href="landing.php">Home</a></li>
  <li><a href="lost.php">Lost Something?</a></li>
  <li><a href="found.php">Found something?</a></li>
  <li><a href="limbo_login.php">Admins</a></li>
</ul>
<p><a href= "admin.php"> Delete an Entry </a></p>
<p><a href= "admin1a.php"> Update Status </a></p>
<p><a href= "admin1b.php"> Change Password </a></p>
<p><a href= "admin1c.php"> Add Admin </a></p>
<p><a href= "admin1d.php"> Delete Admin </a></p>
<!--
Team members: William Esposito, Hannah Youssef, Jenna Daly

This PHP script was modified based on prints.php.
-->
<!DOCTYPE html>
<html>
<?php
# Connect to MySQL server and the database
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
  echo '<p>' . mysqli_error( $dbc ) . '</p>'  ;
}

$sql = ("UPDATE users SET pass2 = '$pass2' WHERE user_id = $user_id");

if (mysqli_query($dbc, $sql)) {
    echo "Password changed";
} else {
    echo "Error" ;
}

# Close the connection
mysqli_close( $dbc ) ;
?>
</html>
  </body>
  
<form action="admin1b.php" method="POST">

<p>Change password to= <input type="text" name="pass2" value="<?php if (isset($_POST['pass2'])) echo $_POST['pass2']; ?>"> </p>
<p> where user id (Press submit twice) = <input type="text" name="user_id" value="<?php if (isset($_POST['user_id'])) echo $_POST['user_id']; ?>"> </p>
<p><input type="submit"></p>
</form>

</html>