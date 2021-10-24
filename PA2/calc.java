import java.util.Scanner;

public class calc {
    public static void main(String[] args){
        Scanner input = new Scanner(System.in);
        boolean validInput = true;
        System.out.print("Choose your operation(+, -, *, /, %, q): ");
        String userinput = input.nextLine();
        userinput.replaceAll("\\s", "");
        char choice = userinput.toLowerCase().charAt(0);
        if(!isChoice(choice))
        {
            System.out.println("Input must be +, -, *, /, %, or q.");
            validInput = false;
        }
        while(choice != 'q'){
            float num1 = 0;
            float num2 = 0;
            if(validInput)
            {
                System.out.print("Enter a number: ");
                try {
                    num1 = Float.parseFloat(input.nextLine());
                } catch (NumberFormatException e) {
                    System.out.println("Input must be a number.");
                    validInput = false;
                }
            }
            if(validInput)
            {   
                System.out.print("Enter another number: ");
                try {
                    num2 = Float.parseFloat(input.nextLine());
                } catch (NumberFormatException e) {
                    System.out.println("Input must be a number.");
                    validInput = false;
                }
                if(choice == '/' && num2 == 0)
                {
                    System.out.println("Cannot divide by 0.");
                    validInput = false;
                }
            }
            if(!(!isFloat(num1) && !isFloat(num2)) && !(isFloat(num1) && isFloat(num2)))
            {
                validInput = false;
                System.out.println("Both numbers must be of the same type.");
            }
            if(validInput)
            {
                float answer = 0;
                switch(choice){
                    case '+':
                        answer = num1 + num2;
                        break;
                    case '-':
                        answer = num2 - num1;
                        break;
                    case '*':
                        answer = num1 * num2;
                        break;
                    case '/':
                        answer = num1 / num2;
                        break;
                    case '%':
                        answer = num1 % num2;
                        break;
                    default:
                        System.out.println("Uh oh... something went wrong.");
                        break;
                }
                if(isFloat(num1))
                    System.out.println(num1 + " " + choice + " " + num2 + " = " + answer);
                else
                    System.out.println((int)num1 + " " + choice + " " + (int)num2 + " = " + (int)answer);
            }
            validInput = true;
            System.out.print("Choose your operation(+, -, *, /, %, q): ");
            userinput = input.nextLine();
            userinput.replaceAll("\\s", "");
            choice = userinput.toLowerCase().charAt(0);
            if(!isChoice(choice))
            {
                System.out.println("Input must be +, -, *, /, %, or q.");
                validInput = false;
            }
        }
    }
    
    public static boolean isFloat(float num)
    {
        float temp = (int)Math.floor(num);
        if(temp == num)
            return false;
        else 
            return true;
    }
    
    public static boolean isChoice(char choice)
    {
        if(choice == '+' || choice == '-' || choice == '*' || choice == '/' || choice == '%' || choice == 'q')
            return true;
        else
            return false;
    }
}