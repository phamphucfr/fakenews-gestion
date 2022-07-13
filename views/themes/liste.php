<?php
// liste.php - view liste themes

// Création d'un tampon mémoire - buffer - pour éviter que
// la porteuse http n'ait envie de printer la réponse trop vite

ob_start();

?>

<h1></h1>
<br/>
<div style="display:inline-block;width:80%">
     <p><?php include("views/search.php"); ?></p> 
</div><div style="display:inline-block;">
    <a href="index.php?section=1&action=1"><button style="width: 140px;"><strong style="color: #238ae5;">Nouveau thème</strong></button></a> 
</div>
<br/>

<?php if(!empty($listeThemes) ){ ?>

<table>
 <caption><?= count($listeThemes) ?> thème(s) trouvé(s)</caption>
    <tr class="tableheaders">
        <th>id</th>
        <th>Libellé des thèmes</th>
        <th></th>
        <th></th>
    </tr>
    <?php foreach ($listeThemes as $theme){ ?>
    <tr>
        <td><?php echo $theme->getIdTheme(); ?></td>
        <td><?php echo $theme->getLibelle(); ?></td>
        <td><a href="index.php?section=1&action=2&id_theme=<?php echo $theme->getIdTheme(); ?>"><button><strong>Modifier</strong></button><a></td>
        <td><a href="index.php?section=1&action=3&id_theme=<?php echo $theme->getIdTheme(); ?>"><button><strong style="color: red;">Supprimer</strong></button><a></td>
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