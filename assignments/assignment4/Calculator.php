<?php

class Calculator {

    public function calc($operator = null, $num1 = null, $num2 = null) {

        if (!is_numeric($num1) || !is_numeric($num2)) {
            return "<p>Cannot perform operation.  You must have three arguments.  A string for the operator (+,-,*,/) and two integers or floats for the numbers.</p>";
        }

        switch ($operator) {

            case "+":
                $result = $num1 + $num2;
                return "<p>The calculation is $num1 + $num2. The answer is $result.</p>";
            
                case "-":
                $result = $num1 - $num2;
                return "<p>The calculation is $num1 - $num2. The answer is $result.</p>";

            case "*":
                $result = $num1 * $num2;
                return "<p>The calculation is $num1 * $num2. The answer is $result.</p>";

            case "/":
                if ($num2 == 0) {
                    return "<p>The calculation is $num1 / $num2. The answer is cannot divide a number by zero.</p>";
                }
                $result = $num1 / $num2;
                return "<p>The calculation is $num1 / $num2. The answer is $result.</p>";

            default:
                return "<p>Cannot perform operation.  You must have three arguments.  A string for the operator (+,-,*,/) and two integers or floats for the numbers.</p>";
        }
    }
}
?>

<!---
1. Explain the purpose of require_once "Calculator.php"; in th index.php page. What would be the difference if include or require were used instead of require_once? It includes the required file and will stop if the file is missing. If include once was used then there would be a warning message.
2. How does the divide method specifically prevent and report an error for division by zero? Why is this a critical consideration in calculator applications? The method checks if the second number is 0 right away before trying to divide and if it is zero it will return a message saying you can't divide by zero. If you don't include this it can cause an error. Not mathematically possible to divide by zero.
3. Explain the difference between the Calculator class and the $Calculator object. Why do we create an instance of the class?
The calculator class defines what the calculator should do while the object is an instance of the class that can call within the class and provide results. We use instance to store data and run methods within the class.
4. Why is it important to check that the last two parameters are numbers in our Calculator class?
because the if they're not numbers then we can get an error. 
5. Index.php handles the display of the results using HTML, while Calculator.php contains the core calculation logic. Discuss the importance of separating user interface (presentation) concerns from business logic.
This makes debugging easier and makes the code easier to read. In the real world multiple people will be working on editing code and speration makes it easier to work with. 
-->