<?php
// liste.php - view liste des actualités

// Création d'un tampon mémoire - buffer - pour éviter que
// la porteuse http n'ait envie de printer la réponse trop vite

ob_start();

?>

<h1></h1>
<br/>
<div style="display:inline-block;width:80%">
     <p><?php include("views/search.php"); ?></p> 
</div><div style="display:inline-block;">
    <a href="index.php?section=0&action=1"><button style="width: 140px;"><strong style="color: #238ae5;">Nouvel Article</strong></button></a> 
</div>
<br/>

<?php if(!empty($listeActus) ){ ?>
<table>
 <caption><?= count($listeActus) ?> article(s) trouvé(s)</caption>
    <tr class="tableheaders">
        <th>Titres des actualités</th>
        <th>Thème</th>
        <th>Date de modification</th>
        <th>Gestion des mots-clés</th>
        <th>Publier?</th>
        <th></th>
        <th></th>
    </tr>
    <?php foreach ($listeActus as $actu){ ?>
    <tr>
        <td><?= $actu->getTitre(); ?></td>
        <td><?= $actu->getTheme()->getLibelle() ; ?></td>
        <td>Créé le :<?= $actu->getDateCrea(); ?><br/>Dernière modification le :<?= $actu->getDateModif(); ?></td>
        <td><a href="index.php?section=0&action=6&id_actualite=<?= $actu->getIdActu(); ?>"><img src="medias/tag.jpg" width="80" /></a></td>
        <td>
            <form action="index.php" id="publish-form" method="POST">
            <input type="hidden" name="section" value="0"/>
            <input type="hidden" name="action" value="5"/>    
            <input type="hidden" name="id_actualite" value="<?= $actu->getIdActu(); ?>"/>    
            <input type="submit" name="publish<?= $actu->getIdActu(); ?>" value="<?= ($actu->getPublish()==1)?"Online":"Offline";?>"
                   <?php if($actu->getPublish()==1) echo "style='background-color:green;color:white;'"  ?>/>          
            </form>
        </td>
     
        <td><a href="index.php?section=0&action=2&id_actualite=<?php echo $actu->getIdActu(); ?>"><button><strong>Modifier</strong></button><a></td>
        <td><a href="index.php?section=0&action=3&id_actualite=<?php echo $actu->getIdActu(); ?>"><button><strong style="color: red;">Supprimer</strong></button><a></td>
    </tr>
    <?php } ?>
    </table>
    

<?php } else { ?>
    <p>Aucun résultat pour la recherche !</p>
<?php } ?>

<script src="tools/validate.js"></script>

<?php
 
$content = ob_get_clean();
include("template.php");

?>