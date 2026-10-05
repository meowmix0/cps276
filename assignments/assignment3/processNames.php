<?php

$outputList = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['clear'])) {
        $outputList = "";
    }

    if (isset($_POST['add'])) {

        $name = $_POST['name'];
        $existingList = $_POST['namelist'];

        $parts = explode(" ", $name);

        if (isset($parts[1])) {
            $first = $parts[0];
            $last  = $parts[1];
            $splitName = "$last, $first";
        } else {
            $splitName = $name;
        }

        if ($existingList !== "") {
            $nameArray = explode("\n", $existingList);
        } else {
            $nameArray = [];
        }

        $nameArray[] = $splitName;

        sort($nameArray);

        $outputList = implode("\n", $nameArray);
    }
}

$form = <<<HTML
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Add Names</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<div class="container mt-4">
    <h1>Add Names</h1>

    <form method="post" action="processNames.php">
        <button class="btn btn-primary" type="submit" name="add">Add Name</button>
        <button class="btn btn-primary" type="submit" name="clear">Clear Names</button>

        <div class="form-group mb-3 mt-3">
            <label for="name" class="form-label">Enter Name</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>

        <div class="form-group mb-3">
            <label for="namelist" class="form-label">List of Names</label>
            <textarea style="height: 500px;" class="form-control" id="namelist" name="namelist">$outputList</textarea>
        </div>
    </form>
</div>
</body>
</html>
HTML;

echo $form;
?>
<!---
1. What is the purpose of separating the functionality between index.php and processNames.php in this assignment?
The reason we seperate the files is to keep the form display blank and store the form inputs in a different file.
2. How does the $_SERVER["REQUEST_METHOD"] variable help determine when to process form submissions in PHP?
The variable tells PHP that the form was submitted using post and to continue the process.
3. How does PHP handle string-to-array conversion using the explode function, and why is this useful in this application?
PHP uses explode to break a string into an array from where the space was entered. This way we can use the array to easily sort alphabetically.
4. What role does the implode function play in formatting the output for the textarea?
The implode function converts the array into a string which can be displayed in the order you coded within the text area.
5. How does processNames.php determine whether to add a new name or clear all names based on which button was clicked?
processNames.php will keep adding names or clearly based on the button the user presses. If the user selects add name it knows to save that name.
-->