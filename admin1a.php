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
require( 'includes/limbo_db.php' ) ;
    
# Create a query to get the name and price sorted by price
$query = 'SELECT id, datelost, item, location, description, status FROM stuff ORDER BY id ASC' ;

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
  echo '<TH>ID</TH>';
  echo '<TH>Date/time</TH>';
  echo '<TH>Item</TH>'; 
  echo '<TH>Location</TH>';
  echo '<TH>Description</TH>';
  echo '<TH>Status</TH>';  
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
	echo '<TD>' . $row['id'] . '</TD>' ;
    echo '<TD>' . $row['datelost'] . '</TD>' ;
    echo '<TD>' . $row['item'] . '</TD>' ;
    echo '<TD>' . $row['location'] . '</TD>' ;
    echo '<TD>' . $row['description'] . '</TD>' ;  
    echo '<TD>' . $row['status'] . '</TD>' ;
    echo '</TR>' ;
  }

  # End the table
  echo '</TABLE>';
  
  
if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
    $id = $_POST['id'] ;
}
if ( $_SERVER[ 'REQUEST_METHOD' ] == 'GET' ) {
	$id = "" ;
}
if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
    $status = $_POST['status'] ;
}
if ( $_SERVER[ 'REQUEST_METHOD' ] == 'GET' ) {
	$status = "" ;
}

  # Free up the results in memory
  mysqli_free_result( $results ) ;
}
else
{
  # If we get here, something has gone wrong
  echo '<p>' . mysqli_error( $dbc ) . '</p>'  ;
}

//$sql = "UPDATE stuff SET status= " .$status. "WHERE id= " .$id;

//$sql = "UPDATE stuff SET status= 'found' WHERE id= 6";
$sql = ("UPDATE stuff SET status = '$status' WHERE id = $id");

if (mysqli_query($dbc, $sql)) {
    echo "Change made";
} else {
    echo "Error" ;
}

# Close the connection
mysqli_close( $dbc ) ;
?>
</html>
  </body>
  
<form action="admin1a.php" method="POST">

<p>Change status to <input type="text" name="status" value="<?php if (isset($_POST['status'])) echo $_POST['status']; ?>"> </p>
<p> where id (Press submit twice) = <input type="text" name="id" value="<?php if (isset($_POST['id'])) echo $_POST['id']; ?>"> </p>
<p><input type="submit"></p>
</form>

</html>