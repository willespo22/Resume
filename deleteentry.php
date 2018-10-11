<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Delete an Entry</title>
    <link href="css/main.css" type="text/css" rel="stylesheet"/>
    <link href="css/deleteentry.css" type="text/css" rel="stylesheet"/>
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
    <div id = "messageT1" style="font-weight:bold"> Delete an Entry </div>
    <div id = "messageT2"> If you want to delete an entry in the database, please do so below. </div>
</div>
    
<?php
    
# Team Members: Hannah Youssef and William Esposito and Jenna Daly
# Version 1.5 November 2, 2017
# Lab 9

# Connect to MySQL server and the database
require('includes/limbo_db.php' ) ;
    
require('includes/Limbohelpers.php' ) ;    

# Create a query to get the name and price sorted by price
$query = 'SELECT id, datelost, item, location, description, status FROM stuff ORDER BY id ASC' ;

# Execute the query
$results = mysqli_query( $dbc , $query ) ;

# Show results
if( $results )
{
  # But...wait until we know the query succeeded before
  # starting the table.
  echo '<H1 style="font-family: Trebuchet MS">Current Items</H1>' ;
  echo '<TABLE>';
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

  # Free up the results in memory
  mysqli_free_result( $results ) ;
}
else
{
  # If we get here, something has gone wrong
  echo '<p style="font-family: Trebuchet MS;>' . mysqli_error( $dbc ) . '</p>'  ;
}

$sql = "DELETE FROM stuff WHERE id=" .$id. " LIMIT 1 ";

if (mysqli_query($dbc, $sql)) {
    echo '<p style="font-family: Trebuchet MS;>Row deleted</p>';
} 
    

# Close the connection
mysqli_close( $dbc ) ;
?>
</html>
  </body>
  
<form action="deleteentry.php" method="POST">

<p style="font-family: Trebuchet MS; margin-bottom: 0px; margin-top: 20px;"><strong>Type the ID number of the item you wish to delete:</strong> <br>(Changes are reflected on the landing page)<input type="text" name="id" value="<?php if (isset($_POST['id'])) echo $_POST['id']; ?>"> </p>
    
<p style="font-family: Trebuchet MS; margin-bottom: 0px; margin-top: 5px;"><input type="Submit"></p>
</form>

<hr>
    
<footer style="font-family:Trebuchet MS; font-size: 10px; font-style: italic;">
    <p> We hope you found what you needed! </p>
    <p> For any questions or comments, please contact: <a href="mailto:hannah.youssef1@marist.edu">Hannah Youssef</a>, <a href="mailto:william.esposito1@marist.edu">William Esposito</a>, or <a href="mailto:jenna.daly1@marist.edu">Jenna Daly</a>.
    </p>
</footer>
    
</html>