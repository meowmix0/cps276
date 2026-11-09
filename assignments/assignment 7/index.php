<?php require_once "php/fileUploadProc.php"; ?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>File Upload</title>
  </head>
  <body>
    
    <div class="container">
        <h1>File Upload</h1>
        <p><a href="listFiles.php">Show File List</a></p>
      <?php echo $message; ?>
                <form method="post" action="index.php" enctype="multipart/form-data">
        <div class="form-group">
          <label for="fileName">File Name</label>
          <input type="text" class="form-control" id="fileName" name="fileName" >
        </div>
        <div class="form-group">
          <input type="file" name="file" accept="application/pdf">
        </div>
        <button type="submit" name="fileUpload" class="btn btn-primary">Upload File</button>
      </form>
    </div>

  </body>
</html>

<!--
1.  Explain why were are using the DB_conn class. We use a DB_conn class to manage the database connection settings, like host and credentials in one place. This makes it easier to maintain if any changes are needed.


2. Explain why we are using the Pdo_methods class. WE use Pdo_methods class is to make modifications to the database like adding, deleting and updating the data. Since this is now in one location it makes it easier to make a change if the database is huge and many changes are needed in differernt areas, having it in one centralized location makes it easier to maintain.


3. Why are we storing the PDF files on the web server and not in the database. We are storing the files on a server because to use less memory. 


4. The PdoMethods class extends DatabaseConn. Explain the benefits of this inheritance structure and how it promotes code reusability and separation of concerns. Inheritance allows PdoMethods to automatically access the database connection functionality defined. 


5. In the fileUploadProc.php, the code uses prepared statements with bindings. Explain how this approach prevents SQL injection attacks and why it's considered a security best practice.
When you use prepared statements with bindings, the sql query is compiled first and prevents sql injection attacks. -->

 