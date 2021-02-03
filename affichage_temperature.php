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

		while($donnees = $reponse->fetch()){
			echo ' A ';
			echo $donnees['ville'];
			echo ', il fait actuellement ';
			echo $donnees['temperature'];
			echo '°C';
		}
	    # $reponse->closeCursor()
	?>
</body>
</html>


