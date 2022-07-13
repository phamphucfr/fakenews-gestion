<?php
// liste.php - view liste des tags

// Création d'un tampon mémoire - buffer - pour éviter que
// la porteuse http n'ait envie de printer la réponse trop vite

ob_start();

?>

<h1></h1>
<br/>
<div style="display:inline-block;width:80%">
     <p><?php include("views/search.php"); ?></p> 
</div><div style="display:inline-block;">
    <a href="index.php?section=2&action=1"><button style="width: 140px;"><strong style="color: #238ae5;">Nouveau mot-clé</strong></button></a> 
</div>
<br/>

<?php if(!empty($listeTags) ){ ?>

<table>
 <caption><?= count($listeTags) ?> mots-clés trouvé(s)</caption>
    <tr class="tableheaders">
        <th>id</th>
        <th>Libellé des mots-clés</th>
        <th></th>
        <th></th>
    </tr>
    <?php foreach ($listeTags as $motcle){ ?>
    <tr>
        <td><?php echo $motcle->getIdTag(); ?></td>
        <td><?php echo $motcle->getNameTag(); ?></td>
        <td><a href="index.php?section=2&action=2&id_keyword=<?php echo $motcle->getIdTag(); ?>"><button><strong>Modifier</strong></button><a></td>
        <td><a href="index.php?section=2&action=3&id_keyword=<?php echo $motcle->getIdTag(); ?>"><button><strong style="color: red;">Supprimer</strong></button><a></td>
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