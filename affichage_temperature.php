<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="style.css" />
	<title>Affichage de la température</title>
		<h1><b>Bienvenue !</b></h1>
</head>
<body>

	<?php
		try
		{
			$bdd = new PDO('mysql:host=localhost;dbname=bdd_temperaturevilles','root', '');
		}
		catch(Exception $e)
		{
			die('erreur');
		}
		$requete = 'SELECT * FROM temperaturevilles';
		$reponse = $bdd->query($requete);

		$reponse = $bdd->prepare("SELECT temperature, DATE_FORMAT(last_update, '%d %M %Y à %Hh%i') AS last_update FROM temperaturevilles WHERE ville = ? ");
        $reponse->execute(array($_GET['ville']));

        while ($donnees = $reponse->fetch())
        {
	        echo (" le  " . $donnees['last_update'] . " à " . htmlspecialchars(ucfirst($_GET['ville'])) . " il fait actuellement "  . $donnees['temperature'] . "°C" );
        }

        $reponse->closeCursor();

        ?>


</body>
</html>


