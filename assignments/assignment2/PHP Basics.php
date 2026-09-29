<?php

$num = array();
for ($i = 1; $i <= 50; $i++) {
    if ($i % 2 == 0) {
    $num[] = $i;
    }
}

$evens = implode(" - ", $num);

$form = <<<HTML
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<form>
  <div class="mb-3">
    <label for="emailInput" class="form-label">Email address</label>
    <input type="email" class="form-control" id="emailInput" placeholder="name@example.com">
  </div>
  <div class="mb-3">
    <label for="exampleTextarea" class="form-label">Example textarea</label>
    <textarea class="form-control" id="exampleTextarea" rows="3"></textarea>
  </div>
</form>
HTML;

function createTable($rows, $cols) {
    $html = "<table class='table table-bordered'>";
    for ($row = 1; $row <= $rows; $row++) {
        $html .= "<tr>";
        for ($col = 1; $col <= $cols; $col++) {
            $html .= "<td>Row " . $row . ", Col " . $col . "</td>";
        }
        $html .= "</tr>";
    }
    $html .= "</table>";
    return $html;
}

$table = createTable(8, 6);
?>

<!DOCTYPE html>
<html>
<body>
<p>Even Numbers: <?php echo $evens; ?></p>
 
<?php echo $form; ?>
 
<?php echo $table; ?>
 
</body>
</html>

<!--
1. The assignment specifies that "all PHP written at the top above the HTML Doctype". Based on Chapter 4, explain how PHP is processed on the server before the resulting HTML is sent to the browser, and explain how the assignment's PHP variables can be created before they are echoed in the HTML body. Before any output is sent to the browser it executes all the code inside the PHP tags, this means that all php should be at the top before we echo the result.

2. Beyond simply finding even numbers, describe a scenario where you would use a similar foreach loop with a conditional (if) statement to filter or process elements from an array based on different criteria like finding all numbers divisiable by 7.
Another use would be using a foreach loop to get details about a price list then a supplier might send for their products.  
$seven = array();
for ($i = 1; $i <= 50; $i++) {
    if ($i % 7 == 0) {
    $seven[] = $i;
    }

3. Explain when heredoc is useful for creating a multi-line PHP string such as the form in this assignment. How does heredoc allow you to write multiple lines of text and include variables in the string?
Heredoc lets you write HTML across multiple lines as one string without quotes and it still lets you use variables within the string.

4. The createTable function uses nested for loops to build the table. Describe the role of each loop: which one is responsible for iterating through the rows, and which for the columns? How does the concatenation (.=) inside these loops incrementally build the complete HTML table string? The outer loop $row makes each row. The inner loop $col makes each cell inside that row. The concatenation .= keeps adding new HTML onto $html so once both loops finish $html its the whole table.

5. The createTable() function returns a string that is later echoed. Explain what returning a value from a function does and how the returned table string can then be used by the code that calls createTable(). return sends a value back out of the function and ends its execution. $table = createTable(8, 6) the value we'll echo later stores that returned string in $table. This builds the table separate from displaying it so the function is reusable for different sizes. -->
