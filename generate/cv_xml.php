<?php 

if (session_status() == PHP_SESSION_NONE) {
	session_start();
 }
 
$xml = new DOMDocument();
$xml->load('./cv/cv.xml');

$xml->preserveWhiteSpace = false;
$xml->formatOutput = true;

 $typeContrat=$_POST['typeContrat'];
 $poste=$_POST['poste'];
 $dureeContrat=$_POST['dureeContrat']; 
 $nom=$_POST['nom'];
 $prenom=$_POST['prenom'];
 $date_naiss=$_POST['date_naiss'];
 $rue=$_POST['rue'];
 $ville=$_POST['ville'];
 $codePostal=$_POST['codePostal'];
 $email=$_POST['email'];
 $telephone=$_POST['telephone'];
 $portfolio=$_POST['portfolio'];
 $diplome=$_POST['diplome'];
 $periode=$_POST['periode'];
 $mention=$_POST['mention'];
 $etablissement=$_POST['etablissement'];
 $villeForma=$_POST['villeForma'];
 $typeCompet=$_POST['typeCompet'];
 $niveau=$_POST['niveau'];
 $competence=$_POST['competence'];
 $titre=$_POST['titre'];
 $localisation=$_POST['localisation'];
 $entreprise=$_POST['entreprise'];
 $mission=$_POST['mission'];
 $niveau_langue=$_POST['niveau_langue'];
 $langue=$_POST['langue'];
 $activite=$_POST['activite'];

 $etudiant = $_SESSION['id_etu'];

//check if exist attr cv associé a id 

 $root=$xml->createElement('cv');
 $root->appendChild($xml);

 $root->setAttribute("etudiant",$etudiant);

 $nodes = $xml->xpath(sprintf('/cv/etudiant[@etudiant="%s"]', $etudiant));
 
 if (!empty($nodes)){
	$d = $xml.getElementsByTagName("cv");
	$xml.removeChild($d);
	 
 }
 

//ajouter attr à cv pour id mec
 $posteElt = $xml->createElement("poste",$poste);
 $posteElt->setAttribute("typeContrat", $typeContrat);
 $posteElt ->setAttribute("dureeContrat",$dureeContrat);

 $nomElt = $xml->createElement("nom", $nom);
 $prenomElt = $xml->createElement("prenom", $prenom);
 $dateNaissElt = $xml->createElement("date_naiss", $date_naiss);
 $emailElt = $xml->createElement("email", $email);
 $telElt = $xml->createElement("telephone", $telephone);
 $portfolioElt = $xml->createElement("portfolio", $portfolio);

 $adresse = $xml->createElement("adresse");
 $rueElt = $xml->createElement("rue", $rue);
 $villeElt = $xml->createElement("ville", $ville);
 $villeElt->setAttribute("codePostal", $codePostal);

 $adresse -> appendChild($rueElt);
 $adresse -> appendChild($villeElt);

 $infoPerso = $xml->createElement("informations_personnelles");
 $infoPerso ->appendChild($nomElt);
 $infoPerso ->appendChild($prenomElt);
 $infoPerso ->appendChild($dateNaissElt);
 $infoPerso ->appendChild($adresse);
 $infoPerso ->appendChild($emailElt);
 $infoPerso ->appendChild($telElt);
 $infoPerso ->appendChild($portfolioElt);

 $formations = $xml->createElement("formations");

 for($i=0;$i<count($_POST["diplome"]);$i++)
{
	$formation = $xml->createElement("formation");
	$diplomeElt=$xml->createElement('diplome',$diplome[$i]);
	$diplomeElt->setAttribute("periode",$periode[$i]);
	$diplomeElt->setAttribute('mention',$mention[$i]);
	$etablissementElt=$xml->createElement('etablissement',$etablissement[$i]);
	$villeFormaElt=$xml->createElement('ville',$villeForma[$i]);

}


$formation ->appendChild($diplomeElt);
$formation ->appendChild($etablissementElt);
$formation ->appendChild($villeFormaElt);

$competences = $xml->createElement("competences");

for($i=0;$i<count($_POST["competence"]);$i++)
{
   $competenceElt = $xml->createElement("competence",$competence[$i]);
   $competenceElt->setAttribute("typeCompet", $typeCompet[$i]);
   $competenceElt->setAttribute("niveau", $niveau[$i]);


}

$experiences = $xml->createElement("experiences");

for($i=0;$i<count($_POST["titre"]);$i++)
{
   $experience = $xml->createElement("experience");
   $titreElt = $xml->createElement("titre", $titre[$i]);
   $entrepriseElt= $xml->createElement("entreprise", $entreprise[$i]);
   $entrepriseElt->setAttribute("localisation", $localisation[$i]);
   $missionElt= $xml->createElement("mission", $mission[$i]);


}

$experience ->appendChild($titreElt);
$experience ->appendChild($entrepriseElt);
$experience ->appendChild($missionElt);


$langues = $xml->createElement("langues");

for($i=0;$i<count($_POST["langue"]);$i++)
{
   $langueElt = $xml->createElement("langue",$langue[$i]);
   $langueElt->setAttribute("niveau",$niveau_langue[$i]);
}

$centreInteret = $xml->createElement("centre_interet");

for($i=0;$i<count($_POST["activite"]);$i++)
{
   $activiteElt = $xml->createElement("activite",$activite[$i]);
   $centreInteret-> appendChild($activiteElt);
}


 $root-> appendChild($infoPerso);
 $root-> appendChild($formations);
 $root-> appendChild($competences);
 $root-> appendChild($experiences);
 $root-> appendChild($langues);
 $root-> appendChild($centreInteret);
 $infoPerso -> appendChild($adresse);
 $formations-> appendChild($formation);
 $experiences-> appendChild($experience);
 $competences-> appendChild($competenceElt);
 $langues-> appendChild($langueElt);



 $xml-> appendChild($root);
 $xml->saveXML();
 //save ds indexation