<?php
$id = $_GET['id'];
session_start();

?>
<!DOCTYPE html>
<html>
<head>
	<title>University of Akron Computer Science Department </title>
	<meta charset = "utf-8"/>
	<link rel="stylesheet" href="styles.css">
</head>
<?php
print "<form action = 'http://localhost/isp/prj/Create.php?id=$id' method = 'post'>";
print "<h1><a href=\"http://localhost/isp/prj/Welcome.php\" tite=\"Go to Homepage\">University of Akron Computer Science Department</a></h1>";
?>
 <p>
	First Name
	<input type="text" name="firstn"/><br />
	Last Name
	<input type="text" name="lastn"/><br />
	<span id = "out"></span> <br /><br />
  </p>
<h2> Please select pertaining major or minor:</h2>
	 <p>
        <input type = "radio" name="action" value="Management" checked="checked" />
		CS Management <br />
        <input type = "radio" name="action" value="Systems" />
		CS Systems <br />
        <input type = "radio" name="action" value="Minor" />
		CS Minor <br />
        <input type = "submit" name="executeGrab" value = "Select major/minor" />
        <span id = "out"></span>
     </p>
<h2> Please select the classes already completed:</h2>	
	<?php
		$db = mysqli_connect("localhost:3306", "root", "","Coursescs");
		//$query = "DROP TABLE IF EXISTS $id;";
		//$result = mysqli_query($db,$query);
		$first = $_SESSION["first"];
		$last = $_SESSION["last"];
		if($_SESSION["maj"] == '')
		{
			$maj = "empty";
		} else {
			$maj = $_SESSION["maj"];
		}
		$id = (string) $id;
		$query = "CREATE TABLE user_$id (
					Subject_number INT(5) NOT NULL,
					Course_number INT(3) NOT NULL,
					Course_name CHAR(72),
					Credit TINYINT(1),
					Taken boolean,	
					PRIMARY KEY (Course_number)
					);";
		mysqli_query($db,$query);

		if(array_key_exists('executeGrab', $_POST)) { 
			$action = $_POST["action"];
			if($_POST["firstn"] != '')
				$_SESSION["first"] = $_POST["firstn"];
			if($_POST["lastn"] != '')
				$_SESSION["last"] = $_POST["lastn"];
			if($action == "Management"){
				$_SESSION["maj"] = "csmgmt";
				$maj = "csmgmt";
				
			} else if($action == "Systems") {
				$_SESSION["maj"] = "cssystems";
				$maj = "cssystems";

			} else {
				$_SESSION["maj"] = "csminor";
				$maj = "csminor";

			}				
		
		
		}
		//$result = mysqli_query($db,$query);
		$query = "SELECT * FROM $maj";
		$result = mysqli_query($db,$query);
		$rows = mysqli_num_rows($result);
		$row = mysqli_fetch_array($result);
		$num_fields = mysqli_num_fields($result);
		$first = $_SESSION["first"];
		$last = $_SESSION["last"];
		$vArr = array("e", "e", "e");
		$vArrDisplay = array();
		$vArrCN = array();
		$vArrCreate = array();
			//Output values stored in rows
		for ($row_num = 0; $row_num < $rows; $row_num++) {
			$values = array_values($row);
			
			for ($i = 0; $i < 3; $i++){
				$value = htmlspecialchars($values[2 * $i + 1]);
				$vArr[$i] = $value;
			}
			$vArrDisplay[$row_num] = $vArr[0] . ':' . $vArr[1] . ' ' . $vArr[2];
			$vArrCN[$row_num] = $vArr[1];
			$row = mysqli_fetch_array($result);
		}
		
        for ($row_num = 0; $row_num < $rows; $row_num++) {
			
			print "<input type = 'checkbox'  name = '$row_num'  value = '$row_num' />";
			print $vArrDisplay[$row_num];
			print "<br>";
		}
		
		if(array_key_exists('execute', $_POST)) { 
			$j = 0;
			for ($row_num = 0; $row_num < $rows; $row_num++) {
				if(isset($_POST[$row_num]))
				{
					$vArrCreate[$j] = $vArrCN[$row_num];
					$sql = "INSERT INTO user_$id
					SELECT * FROM $maj
					WHERE Course_number = $vArrCreate[$j];";
					mysqli_query($db,$sql);
					$j++;
					
					
				}
			
			}
			$sql = "INSERT INTO studentaccounts (Username, FirstName, LastName, Major)
					VALUES ('$id', '$first', '$last', '$maj');";
			mysqli_query($db,$sql);
			header("Location: http://localhost/isp/prj/Main?id=$id");
			exit();	
		
		
		}

	?>
	
<input type = "submit" name = "execute" value = "Submit" />
</form>
<body>
</body>
</html>