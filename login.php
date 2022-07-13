<!DOCTYPE html   >
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="styles.css"/>
	<title>APP NewsSystem PHP 7 Custom</title>
</head>

<body>
<div>
<!-- Header Template -->
<header><a href="index.php" alt="Page d'administration"><?php include("header.html"); ?></a></header>
<div><h1>SVP Identifiez-vous</h1></div>

 <?php if(isset($_GET['error'])) { ?> 
<div style="background-color: red;color: white;">
    <p>Mauvais couple Identifiant/Password</p>
</div>
<?php } ?>
<form action="check.php" method="POST">
    <p>Compte d'utilisateur de droit limité pour le test:</p>
    <p>Identifiant: user   /  Mot de passe: pass</p>
    <br/><br/>
    <div>
        <label>Identifiant</label>
        <p><input type="text" name="email" class="champText" /></p>
    </div><br/>
    <div>
        <label>Mot de passe</label>
        <p><input type="password" name="password" class="champText" /></p>
    </div><br/>
    <div>
        <p></p>
        <p><input type="submit" value="Authentifier" /></p>
    </div><br/>
</form>

	
<!-- Footer Template -->
	<footer><?php include("footer.html"); ?></footer>
</div>
</body>
	
</html>


