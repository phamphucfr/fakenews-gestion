<?php
// tagsGestion.php - view liste des actualités

// Création d'un tampon mémoire - buffer - pour éviter que
// la porteuse http n'ait envie de printer la réponse trop vite

ob_start();

?>

 <p style="text-align: center;color: #238ae5;">  
  <?php if(isset($_GET['id_actualite'])){ 
     $this_actu = ManagerActus::findById($cnx, $_GET['id_actualite']) ;
     echo "Gestion des mots-clés de l'article : "?><strong style="font-size: 1.1em"> <?= $this_actu->getTitre();?></strong> <?php
   } ?>  </p>
    
<form action="index.php?section=0&action=6" id="tags_form" method="POST" > 
<input type="hidden" name="section" value="<?= $section ?>"/>
<input type="hidden" name="action" value="<?= $action ?>"/>
<input type="hidden" name="id_actualite" value="<?= $this_actu->getIdActu(); ?>"/>


<table class="tableTagsGestion">
    <tr>
        <th>Les Mots-clés disponibles</th>

        <th>Les Mots-clés choisis</th>
    </tr>

    <tr>
    <td style="width: 50%;">
        <select id="liste_gauche" name="liste_gauche" style="width: 300px;" size="10" onchange="addToRight()" >
    <?php foreach ($listeTags as $tag){ ?>
            <option value="<?= $tag->getIdTag(); ?>" >
                <?= $tag->getNameTag(); ?>
        </option>
    <?php } ?>
        </select>   
    </td>   
    <td style="width: 50%;">   
        <select id="liste_droite" name="liste_droite[]" style="width: 300px;" size="10" multiple="multiple" onchange="addToLeft()" >
    <?php foreach ($listeTagsActu as $tagsActu){ ?>
       <option value="<?= $tagsActu->getIdTag(); ?>" >
                <?= $tagsActu->getNameTag(); ?>
        </option>
    <?php } ?>
    </select>      
    </td>
    </tr>
    <tr>
    <td></td>    
    <td>
        <input type="button" value="Assigner ces mots-clés à l'article" onclick="envoyer()" /> 
    </td>
    </tr>
</table>
</form>       
 <br/>
 
<script src="views/actualites/tagsGestion.js"></script>

<?php
 
$content = ob_get_clean();
include("template.php");

?>