<?php

if (session_status() == PHP_SESSION_NONE) {
	session_start();
  }

if (!isset($_SESSION['email_etu'])) {
   
   echo "<script type=\"text/javascript\">
   alert(\"Utilisateur non connecté\");
   location=\"./home_etu.php\";
   </script>";
   
}?>

<!DOCTYPE html>
<html lang="fr">
<head>
<title>Formulaire appel offre</title>
<meta charset="UTF-8">
<title>CVTEC</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
<link rel="stylesheet" href="css/cv.css">
<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="script/app.js"></script>
<script>
$(document).ready(function() {

	var max_fields      = 10;
    var wrapper         = $(".input_fields_wrap"); 
    var add_button      = $(".add_field_button"); 
	var wrapLangue         = 	$(".langues"); 
    var addLangue      = $(".addLangue"); 
	var wrapExp         = 	$(".experiences"); 
    var addExp      = $(".addExp"); 
	var wrapCompet         = $(".competences"); 
    var addCompt      = $(".addCompt"); 
	var wrapFormation         = $(".formations"); 
    var addFormation      = $(".addFormation"); 
   
    var x = 1; 
    $(add_button).click(function(e){ 
        e.preventDefault();
        if(x < max_fields){ 
            x++; 
            $(wrapper).append('<div><input type="text" name="activite[]"/><a href="#" class="remove_field">Supprimer</a></div>'); //add input box
        }
    });
   	
	$(addLangue).click(function(e){ 
        e.preventDefault();
        if(x < max_fields){ 
            x++; 
            $(wrapLangue).append('<div><input type="text" name="langue[]"/><a href="#" class="remove_field">Supprimer</a></div>');
			$(wrapLangue).append('<input type="text" name="niveau_langue[]" placeholder="niveau"/><a href="#" class="remove_field">Supprimer</a></div>');
        }
    });
	
	$(addExp).click(function(e){ 
        e.preventDefault();
        if(x < max_fields){ 
            x++; 
            $(wrapExp).append('<div> <input type="text" name="titre[]" placeholder="Titre de l\'expérience"><br>');
			$(wrapExp).append('<input type="text" name="entreprise[]" placeholder="Nom de l\'entreprise"><br>');
			$(wrapExp).append('<input type="text" name="localisation[]" placeholder="Localisation de l\'entreprise"/><br>'); 	
			$(wrapExp).append('<label for="missions">Missions</label><br>');
			$(wrapExp).append('<textarea name="mission[]"></textarea><a href="#" class="remove_field">Supprimer</a></div>'); 		
        }
    });
							
	$(addCompt).click(function(e){ 
        e.preventDefault();
        if(x < max_fields){ 
            x++; 
            $(wrapCompet).append('<div> <input type="text" name="competence[]" placeholder="Compétence"><br>');
			$(wrapCompet).append('<input type="text" name="typeCompet[]" placeholder="Type de compétence"><br>');
			$(wrapCompet).append('<input type="text" name="niveau[]" placeholder="Niveau compétence"><br><a href="#" class="remove_field">Supprimer</a></div>'); 	
        }
    });
	
		$(addFormation).click(function(e){ 
        e.preventDefault();
        if(x < max_fields){ 
            x++; 
            $(wrapFormation).append('<div> <input type="text" name="diplome[]" placeholder="diplome"><br>');
			$(wrapFormation).append('<input type="text" name="periode[]" placeholder="periode"><br>');
			$(wrapFormation).append('<input type="text" name="mention[]" placeholder="mention"><br>'); 	
			$(wrapFormation).append('<input type="text" name="etablissement[]" placeholder="etablissement"><br>'); 	
			$(wrapFormation).append('<input type="text" name="villeForma[]" placeholder="ville"><br><a href="#" class="remove_field">Supprimer</a></div>'); 	
        }
    });
  
    $(wrapper).on("click",".remove_field", function(e){ 
        e.preventDefault(); $(this).parent('div').remove(); x--;
    });

	$(wrapLangue).on("click",".remove_field", function(e){ 
        e.preventDefault(); $(this).parent('div').remove(); x--;
    });

	$(wrapExp).on("click",".remove_field", function(e){ 
        e.preventDefault(); $(this).parent('div').remove(); x--;
    });

	$(wrapCompet).on("click",".remove_field", function(e){ 
        e.preventDefault(); $(this).parent('div').remove(); x--;
    });

	$(wrapFormation).on("click",".remove_field", function(e){ 
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
			<input type="text" name="poste" placeholder="poste"></br></br>
			
			<label for="typeContrat">Type contrat</label></br> 
				<input type="radio" name="typeContrat" value="CDD">CDD
				<input type="radio" name="typeContrat" value="CDI">CDI
				<input type="radio" name="typeContrat" value="stage">Stage</br></br>
				<input type="text" name="dureeContrat" placeholder="Durée du stage">
			</div></br>

			<div class="block">
				<h2>Informations personnelles</h2>
				<input name="nom" type='text' placeholder="nom">
				<input name="prenom" type='text' placeholder="prenom"></br></br>
				<label for="date_naiss">Date de naissance</label></br> 
				<input type="date" id="age" min="1940-01-01" name="date_naiss"></br></br>
				<label for="adresse">Adresse</label></br> </br>
				<input name="rue" type='text' placeholder="rue"></br>
				<input name="ville" type='text' placeholder="ville"></br>
				<input name="codePostal" type='text' placeholder="Code postal"></br>
				<input name="email" type='email' placeholder="email"></br>
				<input name="telephone" type='tel' placeholder="Numéro de téléphone"></br></br>
				<input name="portfolio" type='url' placeholder="URL portfolio"></br>
			</div></br>

			<div class="multiple block">
			<label for="formation">Formation</label></br>
			<div class="formations">
			<button class="addFormation">Ajouter une formation</button>
			<div class="formation">
			<input type="text" name="diplome[]" placeholder="diplome"></br>
			<input type="text" name="periode[]" placeholder="periode"></br>
			<input type="text" name="mention[]" placeholder="mention"></br>
			<input type="text" name="etablissement[]" placeholder="etablissement"></br>
			<input type="text" name="villeForma[]" placeholder="ville"></br>
			</div>
			</div>
			</div>
			
			<div class="multiple block">
			<label for="competences">Compétences</label><br>
			<div class="competences">
			<button class="addCompt">Ajouter une compétence</button>
			<div class="competence">
			<input type="text" name="competence[]" placeholder="Compétence"><br>
			<input type="text" name="typeCompet[]" placeholder="Type de compétence"><br>
			<input type="text" name="niveau[]" placeholder="Niveau compétence"><br>
			</div>
			</div>
			</div>
			
			<div class="multiple block">
			<label for="experiences">Expériences</label><br>
			<div class="experiences">
			<button class="addExp">Ajouter une expérience</button>
			<div class="experience">
			<div><input type="text" name="titre[]" placeholder="Titre de l'expérience"><br>
			<input type="text" name="entreprise[]" placeholder="Nom de l'entreprise"><br>
			<input type="text" name="localisation[]" placeholder="Localisation de l'entreprise"><br></br>
			<label for="missions">Missions</label><br>
			<textarea name=mission[] placeholder="Description des missions"></textarea></div>
			</div>
			</div>
			</div>
			
			<div class="multiple block">
			<label for="langues">Langues</label><br>
			<div class="langues">
			<button class="addLangue">Ajouter une langue</button>
			<div class="langue">
			<div><input type="text" name="langue[]" placeholder="langue">
			<input type="text" name="niveau_langue[]" placeholder="niveau"></div>
			</div>
			</div>
			</div>
			
			<div class="multiple block">
			<label for="activites">Centre d'intérêt</label><br>
			<div class="input_fields_wrap">
			<div class="activite">
			<button class="add_field_button">Ajouter un centre d'intérêt</button>
			<div><input type="text" name="activite[]" placeholder="Activité, sport, .."></div>
			</div>
			</div>

			<div class="block" style="width:0%!important;">
			<input type="submit" name="submit" value="Envoyer">
			</div>
			
		</form>
	</div>
	
	    <?php
		if(isset($_POST['submit'])){
			include('./generate/cv_xml.php');
			echo '<h2>Votre CV a bien été enregistré</h2>';
			echo '<a href="./generate/cv.xml">Voir mon CV</a>';
		}	
    ?>
</body>
</html>