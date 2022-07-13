<?php
// create.php - view création d'un nouveau theme

// Création d'un tampon mémoire - buffer - pour éviter que
// la porteuse http n'ait envie de printer la réponse trop vite

ob_start();

?>
<h1>Nouveau Article</h1>
<br/>
<div>
    <div>
            <p>Libellé du thème :</p>
            <p> <br/>
                <input type="text" id="libelle-theme" name="libelle-theme" value="" class="champText" />
            </p>
            <p id="err-libelle"></p>
    </div>
    <div> <br/>
            <p>
                <input type="button" onclick="ajaxCall()" id="ajaxButton" value="Créer un nouveau Thème"/>
            </p>
    </div>          
<hr style="margin:20px;"/>
</div>
<div>
    
    <form action="index.php" id="zeform" method="POST">
        <input type="hidden" name="section" value="<?= $section; ?>"/>
        <input type="hidden" name="action" value="<?= $action; ?>"/>
    
        <div style="margin-top: 50px;">
            <p>Titre de l'article:</p>
            <br/>
            <p>
                <input type="text" id="titre" name="titre" value="" class="champText" style="width: 100%;"/>
            </p>
            <p id="err-titre">
            </p>
        </div>
        <div style="margin-top: 50px;">
            <p>Image de l'article:</p>
            <br/>
            <p>
                <input type="text" id="image" name="image" value="" class="champText" style="width: 100%;"/>
            </p>
        </div>
        <div style="margin-top: 50px;">
            <p>Thème lié à cet article:</p>
            <br/>
            <p>
            <select id="liste-theme" name="theme" style="width:250px; height:30px;">
            <?php $listeThemes = ManagerTheme::findAll($cnx);
                  foreach($listeThemes as $theme) {   ?>  
                <option value="<?php echo $theme->getIdTheme(); ?>"> 
                        <?php echo $theme->getLibelle(); ?>
                </option>  
                  <?php } ?>        
            </select>  
            </p>
        </div>
        <div style="margin-top: 50px;">
            <p>Publier cet article après Envoyer?</p>
            <br/>
            <p>
            <select name="publish" style="width:250px; height:30px;">
                <option value="1">Oui</option>  
                <option value="0">Non</option>        
            </select>  
            </p>
        </div>
        <div style="margin-top: 50px;">
            <p>Contenu de l'article:</p>
            <br/>
            <p>
            <textarea id="contenu" name="contenu" style="width:100%; height:400px;"></textarea>  
            </p>
            <p id="err-contenu">
            </p>
        </div>
        <div>
            <p><br/>
<!--                <input type="button" id="btCTheme" onclick="tools/validate.js" class="bouton" value="Créer"/>-->
                <input type="button" onclick="checkActu()" class="bouton" value="Envoyer"/>
            </p>
            <br/>
        </div>
        
    </form>
</div>

<script src="views/actualites/ajax_nouveau_theme.js"></script>
<script src="tools/validate.js"></script>

<?php
 
$content = ob_get_clean();
include("template.php");

?>