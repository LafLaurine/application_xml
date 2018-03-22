<?php 
		echo '<?xml version="1.0"?'.'>'."\n";
		echo "<cv>
		<poste typeContrat='{$_POST['typeContrat']}'>{$_POST['poste']}</poste>
		<informations_personnelles>
		<nom>{$_POST['nom']}</nom>
		<prenom>{$_POST['prenom']}</prenom>
		<date_naiss>{$_POST['date_naiss']}</date_naiss>
		<adresse_postale>
		<rue>{$_POST['rue']}</rue>
		<ville>{$_POST['ville']}</ville>
		<codePostal>{$_POST['codePostal']}</codePostal>
		</adresse_postale>
		<email>{$_POST['email']}</email>
		<telephone>{$_POST['telephone']}</telephone>
		<portfolio>{$_POST['portfolio']}</portfolio>
		</informations_personnelles>
		
		<formations>";
		
	for($i=0;$i<count($_POST["diplome"]);$i++)
	{
		echo "<formation>";
		echo"<diplome>{$_POST["diplome"][$i]}</diplome>";
		echo"<periode>{$_POST["periode"][$i]}</periode>";
		echo"<mention>{$_POST["mention"][$i]}</mention>";
		echo"<etablissement>{$_POST["etablissement"][$i]}</etablissement>";
		echo"<ville>{$_POST["villeForma"][$i]}</ville>";
		echo "</formation>";
	}
		echo "</formations>";

		
	echo "<competences>";
		
		for($i=0;$i<count($_POST["competence"]);$i++)
		{
			echo "<competence typeCompet='{$_POST["diplome"][$i]}' niveau='{$_POST["niveau"][$i]}'>";
			echo"{$_POST["competence"][$i]}";
			echo "</competence>";
		}
			echo "</competences>";

	echo "<experiences>";
		
	for($i=0;$i<count($_POST["experience"]);$i++)
	{
		echo "<experience>";
		echo"<titre>{$_POST["titre"][$i]}</titre>";
		echo"<entreprise localisation='{$_POST["localisation"][$i]}'>{$_POST["entreprise"][$i]}</entreprise>";
		echo"<mission>{$_POST["mission"][$i]}</mission>";
		echo "</experience>";
	}
	echo "</experiences>";

	echo "<langues>";
		
	for($i=0;$i<count($_POST["langue"]);$i++)
	{
		echo "<langue niveau='{$_POST["niveau"][$i]}'>";
		echo "</langue>";
	}
	echo "</langues>";

	echo "<centre_interet>";
		
	for($i=0;$i<count($_POST["activite"]);$i++)
	{
		echo "<activite>{$_POST["activite"][$i]}</activite>";
	}
	echo "</centre_inter>";?>