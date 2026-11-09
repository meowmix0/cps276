<?php

require_once 'classes/Date_time.php';

$dt = new Date_time();
$notes = $dt->checkSubmit();

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Add Note</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        textarea {
            width: 200px;
            height: 400px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Add Note</h1>
        <p><a href="display_notes.php">Display Notes</a></p>

        <div><?php echo $notes; ?></div>

        <form action="index.php" method="post" novalidate>
            <div class="form-group">
                <label for="dateTime">Date and Time</label>
                <input type="datetime-local" class="form-control" id="dateTime" name="dateTime">
            </div>
            <div class="form-group">
                <label for="note">Note</label>
                <textarea name="note" id="note" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <input type="submit" name="addNote" class="btn btn-primary" value="Add Note">
            </div>
        </form>
    </div>
</body>
</html>

<!-- 
1. Why store a timestamp or standard format instead of a display string?
    We should store a timestamp or standard format instead of a display string because a timestamp is easier for a database to use and it follows ISO-8601 standards.
2. Why put date work in a class?
    We should put date work in a class because it's easier to manage and allows us to reuse the code without duplicating.
3. How does the app show only notes in a requested range?
    The app shows only notes in a requested range by using the checkSubmit method in the date_time class to filter the notes based on the beginning and ending dates provided by the user.
4. Why do time zones matter?
    Time zones matter because the time can be different depending on the location of the user and storing timestamps in a standard format allows for consistent handling of time across different time zones.
5. Why check that the start date is not after the end date?
    We should check the start date is not after the end date to ensure the date provided by the user is valid. A note in the future cannot be displayed in the past so this stops the user from getting an error. 
-->