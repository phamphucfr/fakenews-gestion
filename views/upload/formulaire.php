
<?php

// Création d'un tampon mémoire - buffer - pour éviter que
// la porteuse http n'ait envie de printer la réponse trop vite

ob_start();

?>

<h1>Chargement un fichier sur le site</h1>
<?php if($_SESSION['prenom']=="Phuc"){
    echo "<form method=\"POST\" action=\"upload/upload.php\" enctype=\"multipart/form-data\">"; 
} ?>
    Choisissez un fichier pour télécharger sur le site :
    <br/>    <br/>
    <input type="file" name="fileToUpload" id="filToUpload" style="width: 300px;border: dotted;border-width: 1px;">
    <br/>    <br/>
    
    <input type="submit" name="Upload" id="upload" value=" Télécharger ce fichier  " >
</form>


<?php
 
$content = ob_get_clean();
include("template.php");

?>