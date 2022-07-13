<!DOCTYPE html   >
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="styles.css" />
	<title>APP NewsSystem PHP 7 Custom</title>  
</head>

<body>
<div>
<!-- Header Template -->
<header><a href="index.php" alt="Page d'administration"><?php include("header.html"); ?></a>
<p style="text-align:center;color: #238ae5;font-size: 1.2em;"><?php
if(isset($_SESSION['authen'])){ 
    echo  "Bonjour "?><strong><?= $_SESSION['prenom']." ".$_SESSION['nom'] ?></strong><?php ;     
}
?></p>

<p style="text-align:center;"><a href="tools/disconnect.php"  ><input type="button" value="Déconnexion" style="color: #238ae5;" /></a></p>
<br/>

</header>

<nav>
  <a href="index.php?section=0" class="<?php echo ($section==0)?"selected":""; ?>">Actualités</a>
  <a href="index.php?section=1" class="<?php echo ($section==1)?"selected":""; ?>">Thèmes</a>
  <a href="index.php?section=2" class="<?php echo ($section==2)?"selected":""; ?>">Mots-clés</a>
  <a href="index.php?section=3" class="<?php echo ($section==3)?"selected":""; ?>">Upload</a>
</nav>
	
<!-- Le contenu central -->	
	<section><?= $content ?></section>
	
	
<!-- Footer Template -->
<footer><?php include("footer.html"); ?></footer>
</div>
</body>
	
</html>


