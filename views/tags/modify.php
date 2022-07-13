<?php
// modify.php - view modification d'un tag

// Création d'un tampon mémoire - buffer - pour éviter que
// la porteuse http n'ait envie de printer la réponse trop vite

ob_start();

?>

<div>
     <form action="index.php" id="zeform" method="POST">
        <input type="hidden" name="section" value="<?= $section; ?>"/>
        <input type="hidden" name="action" value="<?= $action; ?>"/>
        <input type="hidden" name="id_keyword" value="<?= $tag->getIdTag(); ?>"/>
    
        <div style="margin-top: 50px;">
            <p>Libellé du Mot-clé à modifier</p>
            <br/>
            <p>
                <input type="text" id="libelle" name="libelle" class="champText" value="<?= $tag->getNameTag(); ?>" />
            </p>
            <p id="err-libelle">
            </p>
        </div>
        <div>
            <p><br/>
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