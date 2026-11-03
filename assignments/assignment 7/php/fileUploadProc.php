<?php
$message = "";

if(isset($_POST['fileUpload'])){
    if($_POST['fileName'] == ""){
        $message = "<p>Please enter a file name.</p>";
    }
    else if($_FILES['file']['name'] == ""){
        $message = "<p>Please choose a file.</p>";
    }
    else if($_FILES['file']['size'] > 1000000){
        $message = "<p>The file is too large.</p>";
    }
    else if($_FILES['file']['type'] != "application/pdf"){
        $message = "<p>The file must be a PDF.</p>";
    }
    else{
        $filePath = "files/" . $_FILES['file']['name'];

        if(move_uploaded_file($_FILES['file']['tmp_name'], $filePath)){
            require_once "classes/Pdo_methods.php";
            $pdo = new PdoMethods();
            $sql = "INSERT INTO files (file_name, file_path) VALUES (:fileName, :filePath)";
            $bindings = [
                [':fileName', $_POST['fileName'], 'str'],
                [':filePath', $filePath, 'str']
            ];
            $result = $pdo->otherBinded($sql, $bindings);

            if($result == 'noerror'){
                $message = "<p>File uploaded successfully.</p>";
            }
            else{
                $message = "<p>There was a problem uploading the file.</p>";
            }
        }
        else{
            $message = "<p>There was a problem uploading the file.</p>";
        }
    }
}
?>