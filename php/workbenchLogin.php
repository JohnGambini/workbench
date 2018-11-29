<?php

session_start();

$errorString = "";
	
if (isset($_POST['submit'])) {
	if (empty($_POST['username']) || empty($_POST['password'])) {
		$errorString = "Username or Password is invalid";
	}
	else
	{
		// Define $username and $password
		$username=$_POST['username'];
		$password=$_POST['password'];


		// Establishing Connection with Server by passing server_name, user_id and password as a parameter
		$db = new mysqliDatabase();
		$db->connect(DB_HOST, DB_USER, DB_PASSWORD, DATABASE, DB_CHARSET);

		// To protect MySQL injection for Security purpose
		$username = stripslashes($username);
		$password = stripslashes($password);

		$sqlQuery = "select userBlob, permalink from vw_user where password='$password' AND username='$username'";
		if( ! $db->query($sqlQuery)){
			$db->close();
			$errorString =  "An error occured during mysqli_query<br>" . $sqlQuery;
			
		} else {
	
			$rows = mysqli_fetch_array($db->result);
			if (count($rows) != 0) {
				$_SESSION['userID']=$rows['userBlob']; // Initializing Session
				if( isset($rows['permalink']))
					$href = "location: " . SITE_NAME . SUBSITE_NAME . $rows['permalink'];
					else
						$href = "location: " . SITE_NAME . SUBSITE_NAME;
						header($href); // Redirecting To Other Page
			} else {
				$errorString = "Username or Password is invalid <br>";
			}
		}

		$db->close();
	}
}
	
?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo APP_NAME . " Login Form"?></title>
<style>
#main {
	align:center;
	width:100%;
	margin:50px auto;
	font-family:raleway
}

span {
	color:red
}

h2 {
	background-color:#FEFFED;
	text-align:center;
	border-radius:10px 10px 0 0;
	margin:0em 1em 0.5em 1em;
}

hr {
	border:0;
	border-bottom:1px solid #ccc;
	margin:10px -40px;
	margin-bottom:30px
}

#login {
	width:16em;
	float:middle;
	border-radius:10px;
	font-family:raleway;
	border:2px solid #ccc;
	padding:1em 2em;
	margin: 6em auto;
}

input[type=text],input[type=password] {
	width:100%;
	padding:10px;
	margin:1em auto;
	border:1px solid #ccc;
	font-size:16px;
	font-family:raleway
}

input[type=submit] {
	width:100%;
	background-color:#FFBC00;
	color:#fff;
	border:2px solid #FFCB00;
	padding:10px;
	font-size:20px;
	cursor:pointer;
	border-radius:5px;
	margin:0em auto 1em auto;
}

</style>
<link rel="shortcut icon" href="<?php echo "/" . SUBSITE_NAME ?>./favicon.ico">
</head>
<body>
<div id="main">
<div id="login">
<h2>Login</h2>
<form action="" method="post">
<label>User Name :</label>
<input id="name" name="username" placeholder="username" autofocus type="text">
<label>Password :</label>
<input id="password" name="password" placeholder="**********" type="password">
<input name="submit" type="submit" value=" Login ">
<span><?php echo $errorString ?></span>
</form>
</div>
</div>
</body>
</html>


