<?php
session_start();
$id = $_GET['id'];
$db = mysqli_connect("localhost:3306", "root", "","coursescs");
$firstQuery = "SELECT FirstName FROM studentaccounts WHERE Username = '$id'";
$lastQuery = "SELECT LastName FROM studentaccounts WHERE Username = '$id'";
$majQuery = "SELECT Major FROM studentaccounts WHERE Username = '$id'";
$lastResult = mysqli_query($db,$lastQuery);
$firstResult = mysqli_query($db,$firstQuery);
$majResult = mysqli_query($db,$majQuery);
$Lrow = mysqli_fetch_array($lastResult, MYSQLI_NUM);
$Frow = mysqli_fetch_array($firstResult, MYSQLI_NUM);
$Mrow = mysqli_fetch_array($majResult, MYSQLI_NUM);
$first = $Frow[0];
$last = $Lrow[0];
$maj = $Mrow[0];
?>

<!DOCTYPE html>
<html>
<head>
	<title>University of Akron Computer Science Department </title>
	<meta charset = "utf-8"/>
	<link rel="stylesheet" href="styles.css">
    <style type = "text/css">
	table {border:none; width:75%;margin-left:auto;margin-right:auto;}
    td, th {padding:15px;border-bottom: 1px solid #ddd;}
	tr:nth-child(even) {background-color: #f2f2f2;}
    </style>
</head>

<body>
<?php
print "<form action = 'http://localhost/isp/prj/Main.php?id=$id' method = 'post'>";
print "<h1><a href=\"http://localhost/isp/prj/Welcome.php\" title=\"Go to Homepage\">University of Akron Computer Science Department</a></h1>";
print "<h2> Welcome back, $first $last</h2>";
?>

      <p>
        <input type = "radio"  name = "action"  value = "display" checked = "checked" />
		Display classes taken <br />
        <input type = "radio"  name = "action"  value = "displayNeg" />
		Display classes needed to graduate <br />
        <input type = "radio"  name = "action"  value = "update" />
		Add classes<br />
        <input type = "submit" name = "execute" value = "Go" />
		
        <span id = "out"></span>

      </p>
    
	
	<?php
	if($_SESSION["action"] == '')
		{
			$action = "display";
		} else {
			$action = $_SESSION["action"];
		}
	if(array_key_exists('execute', $_POST)) {
		$_SESSION["action"] = $_POST["action"];
		$action = $_SESSION["action"];
		if($action == "display"){
			$query = "SELECT * FROM user_$id";
			print "<table>";
			
			$result = mysqli_query($db,$query);
	
			$rows = mysqli_num_rows($result);
			$row = mysqli_fetch_array($result);
			$num_fields = mysqli_num_fields($result);
			$keys = array_keys($row);
			for ($index = 0; $index < $num_fields; $index++) 
				print "<th>" . $keys[2 * $index + 1] . "</th>";
			print "</tr>";
				
		
			//Output values stored in rows
			for ($row_num = 0; $row_num < $rows; $row_num++) {
				
				print "<tr align = 'center'>";
				$values = array_values($row);
				
				for ($i = 0; $i < $num_fields; $i++){
					$value = htmlspecialchars($values[2 * $i + 1]);
					print "<th>" . $value . "</th> ";
				}
				print "</tr>";
				$row = mysqli_fetch_array($result);
				
			}
		}
		
		
		else if($action == "displayNeg"){
			$query = "SELECT * FROM user_$id";
			$elective = "";
			print "<table>";
			
			$result = mysqli_query($db,$query);
	
			$rows = mysqli_num_rows($result);
			$row = mysqli_fetch_array($result);
			$num_fields = mysqli_num_fields($result);
			$keys = array_keys($row);
			$vArr = array("e", "e", "e");
			$vArrDisplay = array();
			$vArrCN = array();
			$vArrEl = array();
			$vArrCreate = array();
			$j = 0;
			$k = 0;
				//Output values stored in rows
			for ($row_num = 0; $row_num < $rows; $row_num++) {
				$values = array_values($row);
				
				for ($i = 0; $i < 3; $i++){
					$value = htmlspecialchars($values[2 * $i + 1]);
					$vArr[$i] = $value;
				}
				if($row[4] == 0){
					$vArrCN[$j] = $vArr[1];
					$j++;
				} else {
					$vArrEl[$k] = $vArr[1];
					$k++;
				}
				$row = mysqli_fetch_array($result);
				//print $vArrCN[$row_num];
			}
			
			$query = "CREATE TABLE neg_$id AS (SELECT * FROM $maj);";
			mysqli_query($db,$query);
			print "<table>";
			
			$j = 0;
			for ($row_num = 0; $row_num < $rows - count($vArrEl); $row_num++) {
				
				$query = "DELETE FROM neg_$id WHERE Course_number = $vArrCN[$row_num];";
				mysqli_query($db,$query);
				$j++;
			}
			
			$query = "SELECT * FROM neg_$id";
			$result = mysqli_query($db,$query);
	
			$rows = mysqli_num_rows($result);
			$row = mysqli_fetch_array($result);
			$num_fields = mysqli_num_fields($result);
			if ($rows != 0)
			{
				$keys = array_keys($row);
			}

			
			for ($index = 0; $index < $num_fields; $index++) 
				print "<th>" . $keys[2 * $index + 1] . "</th>";
			print "</tr>";
				
		
			//Output values stored in rows
			if ($rows != 0)
			{
				for ($row_num = 0; $row_num < $rows; $row_num++) {
					
					print "<tr align = 'center'>";
					$values = array_values($row);
					
					for ($i = 0; $i < $num_fields; $i++){
						$value = htmlspecialchars($values[2 * $i + 1]);
						print "<th>" . $value . "</th> ";
					}
					
					print "</tr>";
					$row = mysqli_fetch_array($result);
				}
			}
			print "</table>";
			$ele = 18 - 3 * count($vArrEl);
			if($maj == 'csminor')
			{
				$ele = 6 - 3 * count($vArrEl);
			}
			if ($ele < 0)
				$ele = 0;
			print ($ele) . " credit hours of electives left to take <br><br>";
			print "Here are the available electives below:";
			
			
			
			$query = "CREATE TABLE el_$id AS (SELECT * FROM cselectives);";
			mysqli_query($db,$query);
			print "<table>";
			
			$j = 0;
			if (count($vArrEl) != 0){
				for ($row_num = 0; $row_num < count($vArrEl); $row_num++) {
					
					$query = "DELETE FROM el_$id WHERE Course_number = $vArrEl[$row_num];";
					mysqli_query($db,$query);
					$j++;
				}
			}
			$query = "SELECT * FROM el_$id";
			$result = mysqli_query($db,$query);
	
			$rows = mysqli_num_rows($result);
			$row = mysqli_fetch_array($result);
			$num_fields = mysqli_num_fields($result);
			$keys = array_keys($row);

			
			for ($index = 0; $index < $num_fields; $index++) 
				print "<th>" . $keys[2 * $index + 1] . "</th>";
			print "</tr>";
				
		
			//Output values stored in rows
			for ($row_num = 0; $row_num < $rows; $row_num++) {
				
				print "<tr align = 'center'>";
				$values = array_values($row);
				
				for ($i = 0; $i < $num_fields; $i++){
					$value = htmlspecialchars($values[2 * $i + 1]);
					print "<th>" . $value . "</th> ";
				}
				
				print "</tr>";
				$row = mysqli_fetch_array($result);
			}
			$query = "DROP TABLE IF EXISTS neg_$id;";
			$result = mysqli_query($db,$query);
			$query = "DROP TABLE IF EXISTS el_$id;";
			$result = mysqli_query($db,$query);
		}
		
		
		else if($action == "update"){
			$query = "SELECT * FROM user_$id";
			$elective = "";
			print "Required classes:<br>";
			
			$result = mysqli_query($db,$query);
	
			$rows = mysqli_num_rows($result);
			$row = mysqli_fetch_array($result);
			$num_fields = mysqli_num_fields($result);
			$keys = array_keys($row);
			$vArr = array("e", "e", "e");
			$vArrDisplay = array();
			$vArrCN = array();
			$vArrEl = array();
			$vArrCreate = array();
			$j = 0;
			$k = 0;
			
				//Output values stored in rows
			for ($row_num = 0; $row_num < $rows; $row_num++) {
				$values = array_values($row);
				
				for ($i = 0; $i < 3; $i++){
					$value = htmlspecialchars($values[2 * $i + 1]);
					$vArr[$i] = $value;
				}
				if($row[4] == 0){
					$vArrCN[$j] = $vArr[1];
					$j++;
				} else {
					$vArrEl[$k] = $vArr[1];
					$k++;
				}
				$row = mysqli_fetch_array($result);
				//print $vArrCN[$row_num];
			}
			
			$query = "CREATE TABLE neg_$id AS (SELECT * FROM $maj);";
			mysqli_query($db,$query);
			
			$j = 0;
			for ($row_num = 0; $row_num < $rows - count($vArrEl); $row_num++) {
				
				$query = "DELETE FROM neg_$id WHERE Course_number = $vArrCN[$row_num];";
				mysqli_query($db,$query);
				$j++;
			}
			
			$query = "SELECT * FROM neg_$id";
			$result = mysqli_query($db,$query);
	
			$rows = mysqli_num_rows($result);
			$majRows = $rows;
			$row = mysqli_fetch_array($result);
			$num_fields = mysqli_num_fields($result);
			if ($rows != 0)
			{
				$keys = array_keys($row);
			}
			$vArr = array("e", "e", "e");
			$vArrDisplay = array();
			$vArrMaj = array();
			//Output values stored in rows
			for ($row_num = 0; $row_num < $rows; $row_num++) {
				
				print "<tr align = 'center'>";
				$values = array_values($row);
				
				for ($i = 0; $i < 3; $i++){
					$value = htmlspecialchars($values[2 * $i + 1]);
					$vArr[$i] = $value;
				}
				$vArrDisplay[$row_num] = $vArr[0] . ':' . $vArr[1] . ' ' . $vArr[2];
				$vArrMaj[$row_num] = $vArr[1];
				$row = mysqli_fetch_array($result);
			}
			for ($row_num = 0; $row_num < $rows; $row_num++) {
			
				print "<input type = 'checkbox'  name = '$row_num'  value = '$row_num' />";
				print $vArrDisplay[$row_num];
				print "<br>";
			}
			print "<br>";
			$ele = 18 - 3 * count($vArrEl);
			if($maj == 'csminor')
			{
				$ele = 6 - 3 * count($vArrEl);
			}
			if ($ele < 0)
				$ele = 0;
			print ($ele) . " credit hours of electives left to take <br><br>";
			print "Here are the available electives below:<br><br>";
			
			
			
			$query = "CREATE TABLE el_$id AS (SELECT * FROM cselectives);";
			mysqli_query($db,$query);
			print "<table>";
			
			$j = 0;
			if (count($vArrEl) != 0){
				for ($row_num = 0; $row_num < count($vArrEl); $row_num++) {
					
					$query = "DELETE FROM el_$id WHERE Course_number = $vArrEl[$row_num];";
					mysqli_query($db,$query);
					$j++;
				}
			}
			$query = "SELECT * FROM el_$id";
			$result = mysqli_query($db,$query);
	
			$rows = mysqli_num_rows($result);
			$row = mysqli_fetch_array($result);
			$num_fields = mysqli_num_fields($result);
			$keys = array_keys($row);
			$vArr = array("e", "e", "e");
			$vArrDisplay = array();
			$newRow = $majRows;
			$_SESSION["newRow"] = $newRow;

		
			//Output values stored in rows
			for ($row_num = 0; $row_num < $rows; $row_num++) {
				
				print "<tr align = 'center'>";
				$values = array_values($row);
				
				for ($i = 0; $i < 3; $i++){
					$value = htmlspecialchars($values[2 * $i + 1]);
					$vArr[$i] = $value;
				}
				$vArrDisplay[$row_num] = $vArr[0] . ':' . $vArr[1] . ' ' . $vArr[2];
				$vArrEl[$row_num] = $vArr[1];
				print "</tr>";
				$row = mysqli_fetch_array($result);
			}
			
			for ($row_num = 0; $row_num < $rows; $row_num++) {
				$newRow = $row_num + $majRows;
				print "<input type = 'checkbox'  name = $newRow  value = $newRow />";
				print $vArrDisplay[$row_num];
				print "<br>";
			}
			$query = "DROP TABLE IF EXISTS neg_$id;";
			$result = mysqli_query($db,$query);
			$query = "DROP TABLE IF EXISTS el_$id;";
			$result = mysqli_query($db,$query);
			//print "<input type = 'submit' name = 'executeGrab' value = 'Update classes' />";
			$_SESSION["newRow"] = $newRow;
			$_SESSION["majRows"] = $majRows;
			$_SESSION["vArrEl"] = $vArrEl;
			$_SESSION["vArrMaj"] = $vArrMaj;
			
			print "<input type = 'submit' name = 'executeGrab' value = 'Update classes' />";
		}
		
		//$db->close();
	}
	if(array_key_exists('executeGrab', $_POST)) { 
		$j = 0;
		$newRow = $_SESSION["newRow"];
		$majRows = $_SESSION["majRows"];
		$vArrEl = $_SESSION["vArrEl"];
		$vArrMaj = $_SESSION["vArrMaj"];
		for ($row_num = 0; $row_num < $newRow; $row_num++) {
			if($row_num < $majRows)
			{
				if(isset($_POST[$row_num]))
				{
					$vArrCreate[$j] = $vArrMaj[$row_num];
					$sql = "INSERT INTO user_$id
					SELECT * FROM $maj
					WHERE Course_number = $vArrCreate[$j];";
					mysqli_query($db,$sql);
					$j++;
					
					
				} 
			} else {
				if(isset($_POST[$row_num]))
				{
					$vArrCreate[$j] = $vArrEl[$row_num - $majRows];
						$sql = "INSERT INTO user_$id
						SELECT * FROM cselectives
						WHERE Course_number = $vArrCreate[$j];";
						mysqli_query($db,$sql);
						$j++;
				}
			}
		}		
	
	}

	?>
	

</form>
</body>
</html>