<?php


require_once $_SERVER['DOCUMENT_ROOT']. '/application/inc/connexion.php';

if (session_status() == PHP_SESSION_NONE) {
   session_start();
}


		if(isset($_POST['submit'])){
		ob_start();
		echo '<?xml version="1.0"?'.'>'."\n";
		echo "<appel_offre>
			<poste>
				<titre>{$_POST['poste']}</titre>
				<type>{$_POST['typeContrat']}</type>
			</poste>
			
			<info_entreprise>
				<nom>{$_POST['nom']}</nom>
				<adresse>
					<ville>{$_POST['ville']}</ville>
					<code_postal>{$_POST['codePostal']}</code_postal>
				</adresse>
				<description>{$_POST['description']}</description>
			</info_entreprise>
			  
			<profil_recherche>";
			echo "<niveau_etude>{$_POST['niveau']}</niveau_etude>";
		
			for($i=0;$i<count($_POST["competence"]);$i++)
			{
				
				echo "<competence>";
				echo"{$_POST["competence"][$i]}";
				echo "</competence>";
				
			}
				
			echo "</profil_recherche>

			<remuneration>{$_POST['remun']}</remuneration>";
			  
			for($i=0;$i<count($_POST["mission"]);$i++)
			{
				
				echo "<mission>";
				echo"{$_POST["mission"][$i]}";
				echo "</mission>";
				
			}
						  
			echo "<contact>
				<nom>{$_POST['nomContact']}</nom>
				<email>{$_POST['email']}</email>
				<telephone>{$_POST['telephone']}</telephone>
			</contact>
  
		</appel_offre>";


	?>