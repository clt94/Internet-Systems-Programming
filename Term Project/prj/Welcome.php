<?php
session_start();
$_SESSION["maj"] = '';
$_SESSION["first"] = '';
$_SESSION["last"] = '';
$_SESSION["action"] = '';
$_SESSION["newRow"] = 4;
$_SESSION["majRows"] = 4;
$_SESSION["vArrEl"] = array();
$_SESSION["vArrMaj"] = array();
?>

<!DOCTYPE html>
<html>
<head>
	<title>University of Akron Computer Science Department </title>
	<meta charset = "utf-8"/>
	<link rel="stylesheet" href="styles.css">
</head>
<style>
</style>
<body>
<h1>University of Akron Computer Science Department</h1>
<a href="http://localhost/isp/prj/ISP_Final_Report.docx"style = "color:blue;">Download Project Report </a> <br>
<a href="http://localhost/isp/prj/ISP_Final_PPT.pptx"style = "color:blue;">Download Project PPT </a> <br>

<form action = "http://localhost/isp/prj/Welcome.php" method = "post">
	<label for = "username"> Student ID </label>
	<input type = "text" id = "username" name = "username" required><br>	
	<input type = "radio" id = "currentUser" name = "action" value = "currentUser">
	<label for = "currentUser"> Login </label><br>
	<input type = "radio" id = "newUser" name = "action" value = "newUser">
	<label for = "newUser"> Create Account </label><br>

	<input type = "submit" name = "execute" value = "Submit" />
	<input type = "reset"/>
</form>
<br><a href="http://localhost/isp/prj/TechnicalDocument.docx"style = "color:blue;">Technical Document</a> <br>
	
	<?php
	//session_start();
	//user inputs
	if(array_key_exists('execute', $_POST)) { 
	
		$db = mysqli_connect("localhost:3306", "root", "","Coursescs");
		$action = $_POST["action"];
		$id = $_POST["username"];
		
		if ($id == "") 
			$id = 0;

		if($action == "currentUser")
		{

			if ($result = $db->query("SHOW TABLES LIKE 'user_".$id."'")) {
				if($result->num_rows == 1) {
					header("Location: http://localhost/isp/prj/Main?id=$id");
					exit();
				}
				else {
				print "ID $id not found, please enter a valid ID or create one";
				$id = 0;
				}	
			}
		
		}
		else if($action == "newUser")
		{		
			if ($result = $db->query("SHOW TABLES LIKE 'user_".$id."'")) {
				if($result->num_rows == 1) {
					print "ID $id found, please enter a vacant ID or login with an established ID";
					$id = 0;
				}
				else {
				header("Location: http://localhost/isp/prj/Create.php?id=$id");
				exit();
				}
			}
		}
			
		if (!$db) {
			print "Error - Could not connect to MySQL";
			exit;
		}
		
		$db->close();
	}
	?>
</body>
</html>