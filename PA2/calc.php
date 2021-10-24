<!DOCTYPE html>
<html lang = "en">
  <head>
    <title> Calculator </title>
    <meta charset = "utf-8" />
  </head>
  <body>
    <p>
	  <form action = "http://localhost/isp/pa2/calc.php" method = "post">
		<input type = "text" name = "num1"/>
		<br>
		<input type = "text" name = "num2"/>
		<br>
		<input type = "submit" name = "operation" value = "+"/>
		<input type = "submit" name = "operation" value = "-"/>
		<input type = "submit" name = "operation" value = "*"/>
		<input type = "submit" name = "operation" value = "/"/>
		<input type = "submit" name = "operation" value = "%"/>
		<br>
	  </form>
	</p>
  </body>
</html>

<?php
  if(isset($_POST['num1']) && isset($_POST['num2']) && isset($_POST['operation']))
  {
    $num1 = $_POST["num1"];
    $num2 = $_POST["num2"];
	if(is_numeric($num1) && is_numeric($num2))
	{
	  $operation = $_POST["operation"];
	  if($operation == "+")
		$answer = $num1 + $num2;
	  else if($operation == "-")
		$answer = $num1 - $num2;
	  else if($operation == "*")
		$answer = $num1 * $num2;
	  else if($operation == "/")
		$answer = $num1 / $num2;
	  else if($operation == "%")
		$answer = $num1 % $num2;
	  echo "<p>" . $num1 . " " . $operation . " " . $num2 . " = " . $answer . "</p>";
	}
	else
	  echo "<p>Both values must be a number.</p>";
  }
?>