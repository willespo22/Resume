<!--
This file is prints_login.php
This PHP script front-ends linkyprints.php with a login page.
Originally created By Ron Coleman.
Revision history:
Who    Date        Comment
RC  07-Nov-13   Created.
-->
<!DOCTYPE html>
<html>
<head>
     <meta charset="UTF-8">
<title>Admin Login</title>
    <link href="css/main.css" type="text/css" rel="stylesheet"/>
    <link href="css/limbo_login.css" type="text/css" rel="stylesheet"/>
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
    <div id = "messageT1" style="font-weight:bold"> Admin Login Page </div>
    <div id = "messageT2"> Welcome, Admin! </div>
    <div id = "messageT3"> Please login with your credentials. </div>
  </head>
<!--
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
</style>
</head>
    -->
    <hr>
</body>
</html>
<html>
    
<?php
# Connect to MySQL server and the database
require( 'C:\Program Files (x86)\EasyPHP-Devserver-17\eds-www\includes\limbo_db.php' ) ;

# Connect to MySQL server and the database
require( 'C:\Program Files (x86)\EasyPHP-Devserver-17\eds-www\includes\limbo_login_tools.php' ) ;
   
    
    
    
    if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {

    $user = $_POST['user'] ;

    $pid = validate($user) ;

	$pass2 = $_POST['pass2'] ;

    $pidtwo = validatetwo($pass2) ;

    if($pid == -1 || $pidtwo == -1 )
      echo '<P style=color:red>Login failed please try again.</P>' ;

    else
      load('adminlanding.php'); #,$pid);
}
?>
<!-- Get inputs from the user. -->
<h1 style="font-family: Trebuchet MS">Admin Login</h1>
<form action="limbo_login.php" method="POST">
<table>
<tr style="font-family: Trebuchet MS">
<td>Email:</td><td><input type="text" name="user"></td>
<td>Password:</td><td><input type="password" name="pass2"></td>
</tr>
</table>
<p><input type="submit" ></p>
</form>
</html>