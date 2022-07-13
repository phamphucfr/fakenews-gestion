<?php
// create.php - view création d'un nouveau theme

// Création d'un tampon mémoire - buffer - pour éviter que
// la porteuse http n'ait envie de printer la réponse trop vite

ob_start();

?>

<div>
    <form action="index.php" id="zeform" method="POST">
        <input type="hidden" name="section" value="<?= $section; ?>"/>
        <input type="hidden" name="action" value="<?= $action; ?>"/>
        <input type="hidden" name="id_theme" value="<?= $theme->getIdTheme(); ?>"/>
    
        <div style="margin-top: 50px;">
            <p>Libellé du thème à modifier</p>
            <br/>
            <p>
                <input type="text" id="libelle" name="libelle" class="champText" value="<?= $theme->getLibelle(); ?>" />
            </p>
            <p id="err-libelle">
            </p>
        </div>
        <div>
            <p><br/>
<!--                <input type="button" id="btMTheme" onclick="tools/validate.js" class="bouton" value="Modifier"/>-->
                <input type="button" onclick="check()" class="bouton" value="Modifier"/>
            </p>
            
        </div>
        
    </form>
</div>

<script src="tools/validate.js"></script>

<?php
 
$content = ob_get_clean();
include("template.php");

?>