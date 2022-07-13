<?php
// delete.php - view suppression d'un theme

// Création d'un tampon mémoire - buffer - pour éviter que
// la porteuse http n'ait envie de printer la réponse trop vite

ob_start();

?>

<div>
    <form action="index.php" method="POST">
        <input type="hidden" name="section" value="<?= $section; ?>"/>
        <input type="hidden" name="action" value="<?= $action; ?>"/>
        <input type="hidden" name="id_theme" value="<?= $theme->getIdTheme(); ?>"/>
    
        <div style="margin-top: 50px;">
            <p>Etes-vous sûr(e) de vouloir supprimer le thème <strong style="color: red;font-size: 1.2em;"><?= $theme->getLibelle(); ?></strong>  ?</p>
            <br/>
            <p id="err-libelle">
            </p>
        </div>
        <div>
            <p><br/>
                <input type="submit" class="bouton" value="Oui"/><input type="button" class="bouton" value="Non" onClick="location.href='index.php?section=<?= $section ?>&action=0'"/>
            </p>
            
        </div>
        
    </form>
</div>


<?php
 
$content = ob_get_clean();
include("template.php");

?>