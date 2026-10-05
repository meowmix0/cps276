<?php

$form = <<<HTML
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
            <textarea style="height: 500px;" class="form-control" id="namelist" name="namelist"></textarea>
        </div>
    </form>
</div>
</body>
</html>
HTML;

echo $form;
?>
