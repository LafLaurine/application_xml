<?php

if (session_status() == PHP_SESSION_NONE) {
	session_start();
  }

if (!isset($_SESSION['email_entr'])) {
   
   echo "<script type=\"text/javascript\">
   alert(\"Utilisateur non connecté\");
   location=\"./home_entr.php\";
   </script>";
   
}?>

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
    var wrapper         = $(".profil"); 
    var add_button      = $(".add_field_button");
    var wrapperMission  = $(".mission"); 
    var addMission      = $(".addMission");	
   
    var x = 1; 
    $(add_button).click(function(e){ 
        e.preventDefault();
        if(x < max_fields){ 
            x++; 
			$(wrapper).append('<div><input type="text" name="niveau[]" placeholder="niveau"/><a href="#" class="remove_field">Supprimer</a></div>')
            $(wrapper).append('<div><input type="text" name="competence[]" placeholder="compétences"/><a href="#" class="remove_field">Supprimer</a></div>');
			$(wrapper).append('<div><input type="text" name="type_competence[]" placeholder="typeCompet"/><a href="#" class="remove_field">Supprimer</a></div>') //add input box
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
				<input name="nom_entreprise" type='text' placeholder="nom"><br>
				<label for="adresse">Adresse</label></br>
				<input name="ville_entreprise" type='text' placeholder="ville"><br>
				<input name="cp_entreprise" type='text' placeholder="Code postal"><br>
				<label for="adresse">Description de l'entreprise</label></br>
				<label type="text" placeholder="Description de l'entreprise">
				<textarea name="description_entreprise"></textarea>
			</div></br>

			<div class="multiple block">
			<label for="profil">Profil recherché</label><br>
			<input type="text" name="niveau[]" placeholder="Niveau d'études requis"><br></br>
			<label for="profil">Compétences requises</label><br>
			<div class="profil">
			<button class="add_field_button">Ajouter une compétence requise</button>
			<div><input type="text" name="competence[]"></div></br>
			<div><input type="text" name="type_competence[]" placeholder="Type de compétences"></div>
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
				
			}
			
    ?>
	
</body>
</html>