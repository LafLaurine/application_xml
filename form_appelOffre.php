

<!DOCTYPE html>
<html lang="fr">
<head>
<title>XML</title>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/cv.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$(document).ready(function() {

	var max_fields      = 10;
    var wrapper         = $(".input_fields_wrap"); 
    var add_button      = $(".add_field_button");
    var wrapperMission  = $(".mission"); 
    var addMission      = $(".addMission");	
   
    var x = 1; 
    $(add_button).click(function(e){ 
        e.preventDefault();
        if(x < max_fields){ 
            x++; 
            $(wrapper).append('<div><input type="text" name="competence[]"/><a href="#" class="remove_field">Supprimer</a></div>'); //add input box
        }
    });
	
	$(addMission).click(function(e){ 
        e.preventDefault();
        if(x < max_fields){ 
            x++; 
            $(wrapperMission).append('<div><input type="text" name="mission[]"/><a href="#" class="remove_field">Supprimer</a></div>'); //add input box
        }
    });
   
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    });
	
	    $(wrapperMission).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    });
  
  });
</script>
</head>
<body>
<div class="form-cv">
<form action="" class="formu" method="post">
			<div class="block">
			<label for="poste">Poste</label></br>
			<input type="text" name="poste" placeholder="Titre du poste"></br> 
			
			<label for="typeContrat">Type contrat</label></br> 
				<input type="radio" name="typeContrat" value="CDD">CDD
				<input type="radio" name="typeContrat" value="CDI">CDI
				<input type="radio" name="typeContrat" value="stage">Stage
				</br> 
				<input type="text" name="typeContrat" placeholder="Durée du stage">
			</div></br>

			<div class="block">
				<h2>Informations de l'entreprise</h2>
				<input name="nom" type='text' placeholder="nom"><br>
				<label for="adresse">Adresse</label></br>
				<input name="ville" type='text' placeholder="ville"><br>
				<input name="codePostal" type='text' placeholder="Code postal"><br>
				<label for="adresse">Description de l'entreprise</label></br>
				<label type="text" placeholder="Description de l'entreprise">
				<textarea name="description"></textarea>
			</div></br>

			<div class="multiple block">
			<label for="profil">Profil recherché</label><br>
			<input type="text" name="niveau" placeholder="Niveau d'études requis"><br></br>
			<label for="profil">Compétences requises</label><br>
			<div class="profil">
			<button class="add_field_button">Ajouter une compétence requise</button>
			<div><input type="text" name="competence[]"></div></br>
			</div>
			</div>
			
			<div class="block"> 
			<label for="remuneration">Rémunération</label>
			<div class="remuneration">
			<input type="text" name="remun" placeholder="Rémunération"><br></br>
			</div>
			</div>
			
			<div class="block">
			<label for="mission">Missions</label><br>
			<div class="mission">
			<button class="addMission">Ajouter une mission</button>
			<div><input type="text" name="mission[]"></div></br>
			</div>
			</div>
						
			<div class="block">
			<label for="contact">Contact</label><br>
			<div class="contact">
			<input type="text" name="nomContact" placeholder="Nom"><br>
			<input type="email" name="email" placeholder="Email"><br>
			<input type="telephone" name="telephone" placeholder="Téléphone"><br></br>
			</div>
			</div>
			
			<div class="block">
			<input type="submit" name="submit" value="Envoyer">
			</div>
			
		</form>
	</div>
	
	<?php
		if(isset($_POST['submit'])){
			include('./generate/appelOffre_xml.php');

		/// Récupération des variables issues du formulaire par la méthode post
		$poste = filter_input(INPUT_POST, 'poste');
		$typeContrat = filter_input(INPUT_POST, 'typeContrat');
		$nom = filter_input(INPUT_POST, 'nom');
		$ville = filter_input(INPUT_POST, 'ville');
		$codePostal = filter_input(INPUT_POST, 'codePostal');
		$description = filter_input(INPUT_POST, 'description');
		$competence = filter_input(INPUT_POST, 'competence');
		$remun = filter_input(INPUT_POST, 'remun');
		$mission = filter_input(INPUT_POST, 'mission');
		$nomContact = filter_input(INPUT_POST, 'nomContact');
		$email = filter_input(INPUT_POST, 'email');
		$telephone = filter_input(INPUT_POST, 'telephone');

		try
		{ 
					$db = connectBd ();
					$qw = $db->prepare('INSERT INTO appel_offre(titre_poste,type_contrat,renumeration) VALUES (?,?,?)');
					$qw->bindParam(1, $id_etu);
					$qw->bindParam(2, $formation);
					$qw->bindParam(3, $niveau);
					$qw->bindParam(4, $id_etu);
					$qw->bindParam(5, $formation);
					$qw->bindParam(6, $niveau);
					$qw->execute();

				if($langues!=null)
				{
					foreach($langues as $langue)
					{
						$qw = $db->prepare('INSERT INTO langue_pratiquee(id_etu,id_langue) VALUES (?,?) ON DUPLICATE KEY UPDATE id_etu=?,id_langue=?;');
						$qw->bindParam(1, $id_etu);
						$qw->bindParam(2, $langue);
						$qw->bindParam(3, $id_etu);
						$qw->bindParam(4, $langue);
						$qw->execute();
					}
				}

				
				if($jobs!=null)
				{
					foreach($jobs as $job)
					{
						$q2 = $db->prepare('INSERT INTO interet_metier(id_etu,id_metier) VALUES (?,?) ON DUPLICATE KEY UPDATE id_etu=?,id_metier=?;');
						$q2->bindParam(1, $id_etu);
						$q2->bindParam(2, $job);
						$q2->bindParam(3, $id_etu);
						$q2->bindParam(4, $job);
						$q2->execute();
					}
				}

				if($projet!=null)
				{
					$query = $db->prepare('INSERT INTO projet(id_etu,nom_projet,id_formation) VALUES (?,?,?) ON DUPLICATE KEY UPDATE id_etu=?,nom_projet=?,id_formation=?;');
					$query->bindParam(1,$id_etu);
					$query->bindParam(2,$projet);
					$query->bindParam(3,$formation);
					$query->bindParam(4,$id_etu);
					$query->bindParam(5,$projet);
					$query->bindParam(6,$formation);
					$query->execute();
				}

				if($domaines!=null)
				{
					foreach($domaines as $selected)
					{
						$q1 = $db->prepare('INSERT INTO interet_domaine(id_etu,id_domaine) VALUES (?,?) ON DUPLICATE KEY UPDATE id_etu=?,id_domaine=?;');
						$q1->bindParam(1, $id_etu);
						$q1->bindParam(2, $selected);
						$q1->bindParam(3, $id_etu);
						$q1->bindParam(4, $selected);
						$q1->execute();
					}
				}

				if($pays!=null)
				{
					foreach($pays as $pay)
					{
						$q3 = $db->prepare('INSERT INTO interet_pays(id_etu,id_pays) VALUES (?,?) ON DUPLICATE KEY UPDATE id_etu=?,id_pays=?;');
						$q3->bindParam(1, $id_etu);
						$q3->bindParam(2, $pay);
						$q3->bindParam(3, $id_etu);
						$q3->bindParam(4, $pay);
						$q3->execute();
					}
				}
		}

			catch (PDOException $e)
			{
				//exit('Erreur, problème de connexion à la base');
				echo $e->getMessage();
			}

				
				}
			
    ?>
	
</body>
</html>