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
    
        <div style="margin-top: 50px;">
            <p>Libellé du nouveau thème</p>
            <br/>
            <p>
                <input type="text" id="libelle" name="libelle" value="" class="champText"/>
            </p>
            <p id="err-libelle">
            </p>
        </div>
        <div>
            <p><br/>
<!--                <input type="button" id="btCTheme" onclick="tools/validate.js" class="bouton" value="Créer"/>-->
                <input type="button" onclick="check()" class="bouton" value="Créer"/>
            </p>
            
        </div>
        
    </form>
</div>

<script src="tools/validate.js"></script>

<?php
 
$content = ob_get_clean();
include("template.php");

?>