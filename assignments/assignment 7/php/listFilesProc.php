<?php
require_once "classes/Pdo_methods.php";
$pdo = new PdoMethods();
$sql = "SELECT file_name, file_path FROM files";
$records = $pdo->selectNotBinded($sql);
$fileList = "";

if($records == 'error'){
    $fileList = "<p>There was an error getting files.</p>";
}
else{
    $fileList = "<ul>";
    foreach($records as $row){
        $fileList .= "<li><a target='_blank' href='" . $row['file_path'] . "'>" . $row['file_name'] . "</a></li>";
    }
    $fileList .= "</ul>";
}
?>