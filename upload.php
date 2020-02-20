<?php

function bytesToSize1024($bytes, $precision = 2) {
    $unit = array('B','KB','MB');
    return @round($bytes / pow(1024, ($i = floor(log($bytes, 1024)))), $precision).' '.$unit[$i];
}

$surface = $_POST['surface_selected'];
$teeth = $_POST['tooth_selected'];

$sFileName = $_FILES['image_file']['name'];
$sFileType = $_FILES['image_file']['type'];
$sFileSize = bytesToSize1024($_FILES['image_file']['size'], 1);
$imageFileType = strtolower(pathinfo($_FILES['image_file']['name'],PATHINFO_EXTENSION));

$target_dir = "images/teeth/" . $teeth . "/";
$fileName = $surface . "." . $imageFileType ;
$target_file = $target_dir . $fileName;

$uploadOk = 1;

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["image_file"]["name"]);
    if($check !== false) {
        echo "El archivo es una imagen - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "El archivo no es una imagen";
        $uploadOk = 0;
    }
}
// Check if the folder not exists
if (!file_exists($target_dir)) {
    mkdir( $target_dir,0777,false );
}  
// Check if file already exists
if (file_exists($target_file)) {
    unlink($target_file);
}
// Check file size
if ($_FILES["image_file"]["size"] > 5000000) {
    echo "Lo siento, su archivo es muy grande.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    echo "Lo siento, solo archivos JPG, JPEG, PNG & GIF estan permitidos.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Lo siento, su archivo no fue guardado.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["image_file"]["tmp_name"], $target_file)) {
        echo nl2br ("El archivo ". $sFileName . " fue guardado como: " . 
            $teeth . "/" . $fileName);
    } else {
        echo "Lo siento, hubo un error al guardar el archivo.";
    }
}