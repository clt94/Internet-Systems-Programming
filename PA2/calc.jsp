<html>
  <head>
    <title> Calculator </title>
  </head>
  <h1>Calculator</h1>
  <body>
    <p>
      <form action = "http://localhost:8080/isp/pa2/calc.jsp" method = "post">
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
      <%
        String strNum1 = request.getParameter("num1");
        String strNum2 = request.getParameter("num2");
        String operation = request.getParameter("operation");
		double num1 = 0;
		double num2 = 0;
		double answer = 0;
		String calculation = "";
        if(strNum1 != null && strNum2 != null && operation != null) 
		{
          try
		  {
            if(strNum1.matches(".*[0-9].*") && strNum2.matches(".*[0-9].*"))
            {
              num1 = Double.parseDouble(strNum1);
              num2 = Double.parseDouble(strNum2);
            }
            else
              throw new RuntimeException("Input must be numbers.");
		  
            if((num1 % 1 == 0 && num2 % 1 != 0) || (num1 % 1 != 0 && num2 % 1 == 0))
              throw new RuntimeException("Numbers must of the same type.");
            else if(operation.equals("/") && num2 == 0)
   			  throw new RuntimeException("Cannot divide by 0");
            else 
            {
              if(operation.equals("+"))
                answer = num1 + num2;
              else if(operation.equals("-"))
                answer = num1 - num2;
              else if(operation.equals("*"))
                answer = num1 * num2;
              else if(operation.equals("/"))
                answer = num1 - num2;
              else if(operation.equals("%"))
                answer = num1 % num2; 
			  if(num1 % 1 == 0 && num2 % 1 == 0)
				calculation = (int)num1 + " " + operation + " " + (int)num2 + " = " + (int)answer;
			  else
				calculation = num1 + " " + operation + " " + num2 + " = " + answer;
              %>
              Calculation:
                <%= calculation %>
              <%
            }
          }
          catch(Exception ex)
          {
            out.println("Error: " + ex.getMessage());
          }
        }
      %>
    </p>
  </body>
</html>
