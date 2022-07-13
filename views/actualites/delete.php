<?php
// delete.php - view suppression d'un theme

// Création d'un tampon mémoire - buffer - pour éviter que
// la porteuse http n'ait envie de printer la réponse trop vite

ob_start();

?>

<div>
    <form action="index.php" id="zeform" method="POST">
        <input type="hidden" name="section" value="<?= $section; ?>"/>
        <input type="hidden" name="action" value="<?= $action; ?>"/>
        <input type="hidden" name="id_actualite" value="<?= $actu->getIdActu(); ?>"/>  
    
        <div style="margin-top: 50px;">
            <p>Etes-vous sûr(e) de vouloir supprimer l'article intitulé " <strong style="color: red;font-size: 1.2em;"><?= $actu->getTitre(); ?></strong> " ?</p>
            <br/>
            <p id="err-titre">
            </p>
        </div>
        <div>
            <p><br/>
                <input type="button" onclick="checkActu()" class="bouton" value="Oui"/>
                <input type="button" class="bouton" value="Non" onClick="location.href='index.php?section=0&action=0'"/>
            </p>
            
        </div>
        
    </form>
</div>

<script src="tools/validate.js"></script>

<?php
 
$content = ob_get_clean();
include("template.php");

?>