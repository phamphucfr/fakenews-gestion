<<<<<<< HEAD
<?php
// upload.php - Business autour de l'upload

$name = $_FILES['fileToUpload']['name'];
$tmpName = $_FILES['fileToUpload']['tmp_name'];
$size = $_FILES['fileToUpload']['size'];

//var_dump($name);
//var_dump($tmpName);
//var_dump($size);

//final path
$finalPath = "../medias"."/".$name;


try{
    move_uploaded_file($tmpName, $finalPath);
    
    echo '<script type="text/javascript"> ';
    echo '  if (confirm("Chargement réussi du fichier. Voulez-vous upload un autre?")) {';
    echo '    document.location = "../index.php?section=3";';
    echo '  }else document.location = "../index.php";';
    echo '</script>';

} 
catch (Exception $ex) {
    echo "Problème !!! ";
}



=======
<?php
// upload.php - Business autour de l'upload

$name = $_FILES['fileToUpload']['name'];
$tmpName = $_FILES['fileToUpload']['tmp_name'];
$size = $_FILES['fileToUpload']['size'];

//var_dump($name);
//var_dump($tmpName);
//var_dump($size);

//final path
$finalPath = "../medias"."/".$name;


try{
    move_uploaded_file($tmpName, $finalPath);
    
    echo '<script type="text/javascript"> ';
    echo '  if (confirm("Chargement réussi du fichier. Voulez-vous upload un autre?")) {';
    echo '    document.location = "../index.php?section=3";';
    echo '  }else document.location = "../index.php";';
    echo '</script>';

} 
catch (Exception $ex) {
    echo "Problème !!! ";
}



>>>>>>> 4a905b012ce5d2f203a260dfd4f591892503f9d0
?>