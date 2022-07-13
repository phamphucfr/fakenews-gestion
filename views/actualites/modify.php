<?php
// modify.php - view modification d'un article

// Création d'un tampon mémoire - buffer - pour éviter que
// la porteuse http n'ait envie de printer la réponse trop vite

ob_start();

?>
<h1>Modification d'un article</h1>
<br/>
<div>
    
    <form action="index.php" id="zeform" method="POST">
        <input type="hidden" name="section" value="<?= $section; ?>"/>
        <input type="hidden" name="action" value="<?= $action; ?>"/>
        <input type="hidden" name="id_actualite" value="<?= $actu->getIdActu(); ?>"/>  
    
        <div style="margin-top: 50px;">
            <p>Titre de l'article:</p>
            <br/>
            <p>
                <input type="text" id="titre" name="titre" value="<?= $actu->getTitre(); ?>" class="champText" style="width: 100%;"/>
            </p>
            <p id="err-titre">
            </p>
        </div>
        <div style="margin-top: 50px;">
            <p>Image de l'article:</p>
            <br/>
            <p>
                <input type="text" id="image" name="image" value="<?= $actu->getImage(); ?>" class="champText" style="width: 100%;"/>
            </p>
        </div>
        <div style="margin-top: 50px;max-height: 300px;">
                <p>Thème lié à cet article:</p>
                <br/>
                <p>
                <select name="theme" style="width:250px; height:30px;">
                <?php $listeThemes = ManagerTheme::findAll($cnx); 
                     foreach($listeThemes as $theme) { ?>
                    <option value="<?= $theme->getIdTheme(); ?>" <?php if($theme==$actu->getTheme()) echo " selected"; ?> >
                        <?= $theme->getLibelle(); ?>
                    </option>

                 <?php } ?> 
                </select>  
                </p><br/><br/>
                <p>Publier cet article après Envoyer?</p>
                <br/>
                <p>
                <select name="publish" style="width:250px;height:30px;">
                    <option value="<?= $actu->getPublish(); ?>"><?= ($actu->getPublish()==1)?"Oui":"Non"; ?></option>  
                    <option value="<?= ($actu->getPublish()==1)?"0":"1"; ?>"><?= ($actu->getPublish()==1)?"Non":"Oui"; ?></option>        
                </select>  
                </p>
        </div>
            
        <div style="margin-top: 50px;">
            <p>Contenu de l'article:</p>
            <br/>
            <p>
            <textarea id="contenu" name="contenu" style="width:100%; height:400px;"><?php echo $actu->getContenu(); ?>
            </textarea>  
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

<script src="tools/validate.js"></script>

<?php
 
$content = ob_get_clean();
include("template.php");

?>