<?php

if (session_status() == PHP_SESSION_NONE) {
   session_start();
}

$xml=new DomDocument('1.0', 'UTF-8');
//to have indented output, not just a line
$xml->preserveWhiteSpace = false;
$xml->formatOutput = true;

$xslt = $xml->createProcessingInstruction('xml-stylesheet', 'type="text/xsl" href="./appelOffre.xsl"');

//adding it to the xml
$xml->appendChild($xslt);


$typeContrat=$_POST['typeContrat'];
$poste=$_POST['poste'];
$nom=$_POST['nom'];
$ville=$_POST['ville'];
$codePostal=$_POST['codePostal'];
$description=$_POST['description'];
$competence=$_POST['competence'];
$type_compet=$_POST['type_competence'];
$remun=$_POST['remun'];
$mission=$_POST['mission'];
$nomContact=$_POST['nomContact'];
$email=$_POST['email'];
$telephone=$_POST['telephone'];

$root=$xml->createElement('appel_offre');

$posteElt = $xml->createElement("poste",$poste);
$posteElt ->setAttribute("typeContrat",$typeContrat);

$nomElt = $xml->createElement("nom", $nom);
$descElt = $xml->createElement("description", $description);

$adresse = $xml->createElement("adresse");
$villeElt = $xml->createElement("ville", $ville);
$villeElt ->setAttribute("codePostal", $codePostal);

$adresse -> appendChild($rueElt);
$adresse -> appendChild($villeElt);
$adresse -> appendChild($codePostalElt);

$infoEntr = $xml->createElement("info_entreprise");
$infoEntr ->appendChild($nomElt);
$infoEntr ->appendChild($adresse);
$infoEntr ->appendChild($descElt);

$profil = $xml->createElement("profil_recherche");

$competences = $xml->createElement("competences");

for($i=0;$i<count($_POST["competence"]);$i++)
{
   $competenceElt = $xml->createElement("competence",$competence[$i]);
   $competenceElt->setAttribute("typeCompet", $type_compet[$i]);
}

$missions = $xml->createElement("mission");

for($i=0;$i<count($_POST["mission"]);$i++)
{
   $missionElt = $xml->createElement("mission",$mission[$i]);
}

$nomContactElt = $xml->createElement("nomContact", $nomContact);
$emailElt = $xml->createElement("email", $email);
$telElt = $xml->createElement("telephone", $telephone);

$contact = $xml->createElement("contact");
$contact ->appendChild($nomContactElt);
$contact ->appendChild($emailElt);
$contact ->appendChild($telElt);

$root-> appendChild($infoEntr);
$root-> appendChild($profil);
$profil-> appendChild($competences);
$profil-> appendChild($missions);
$missions->appendChild($missionElt);
$competences-> appendChild($competenceElt);
$root-> appendChild($contact);

$xml-> appendChild($root);
$xml->save('./generate/appelOffre/appelOffre_'.$_SESSION['id_entr'].'.xml'); 
?>