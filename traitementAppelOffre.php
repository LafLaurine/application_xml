<?php 

require_once $_SERVER['DOCUMENT_ROOT']. '/application/inc/connexion.php';

header('Content-type: text/html; charset=UTF-8');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
 }
 
if (!isset($_SESSION['pseudo'])) {
    header("Location: ./index.php");
}

function testValue($name)
{
    if(isset($_POST[$name]))
    {
        return $_POST[$name];
    }

    return null;
}

$submit = filter_input(INPUT_POST, 'submit');
$poste = filter_input(INPUT_POST, 'poste');
$typeContrat = filter_input(INPUT_POST, 'typeContrat');
$nom_entreprise = filter_input(INPUT_POST, 'nom_entreprise');
$ville_entreprise = filter_input(INPUT_POST, 'ville_entreprise');
$cp_entreprise = filter_input(INPUT_POST, 'cp_entreprise');
$description_entreprise = filter_input(INPUT_POST, 'description_entreprise');
$niveau = testValue("niveau");
$competences = testValue("competence");
$type_competence = testValue("type_competence");
$remun = filter_input(INPUT_POST, 'remun');
$missions = testValue("mission");
$telephone_entreprise = filter_input(INPUT_POST, 'telephone');
$email_entreprise = filter_input(INPUT_POST, 'email_entreprise');

$id_entr = $_SESSION['id_entr'];


//Si le formulaire est envoyé, on enregistre les données dans la BDD
if (isset($envoi))
{
    try
    {
        $db = connectBd();

        //On supprime l'id de l'étudiant s'il est déjà référencé
        $q1 = $db->prepare('DELETE FROM appel_offre WHERE id_entr=?');
        $q1->bindParam(1, $id_entr);
        $q1->execute();

        $q1 = $db->prepare('DELETE FROM info_entreprise WHERE id_entr=?');
        $q1->bindParam(1, $id_entr);
        $q1->execute();




        if($poste!=null && $typeContrat!=null && $remun!=null)
        {
            $q = $db->prepare('INSERT INTO appel_offre(id_entr,titre_offre,typeContrat,remuneration) VALUES (?,?,?,?) ON DUPLICATE KEY UPDATE id_entr=?,titre_offre=?,typeContrat=?,remuneration=?;');
            $q->bindParam(1, $id_entr);
            $q->bindParam(2, $titre_offre);
            $q->bindParam(3, $typeContrat);
            $q->bindParam(3, $remun);
        }

        
        if($nom_entreprise!=null && $ville_entreprise!=null && $cp_entreprise!=null && $description_entreprise!=null && $email_entreprise!=null && $telephone_entreprise!=null)
        {
            $q = $db->prepare('INSERT INTO info_entreprise(id_entr,nom_entreprise,ville_entreprise,cp_entreprise,description_entreprise,email_entreprise,telephone_entrepise) VALUES (?,?,?,?,?,?,?,?) 
            ON DUPLICATE KEY UPDATE id_entr=?,nom_entreprise=?,ville_entreprise=?,cp_entreprise=?,description_entreprise,email_entreprise,telephone_entreprise;');
            $q->bindParam(1, $id_entr);
            $q->bindParam(2, $nom_entreprise);
            $q->bindParam(3, $ville_entreprise);
            $q->bindParam(4, $cp_entreprise);
            $q->bindParam(5, $description_entreprise);
            $q->bindParam(6, $email_entreprise);
            $q->bindParam(7, $telephone_entreprise);
        }

        if($competences!=null)
        {
            foreach($competences as $competence)
            {
                $qw = $db->prepare('INSERT INTO competences_entr(id_entr,niveau,competence,type_competence) VALUES (?,?) ON DUPLICATE KEY UPDATE id_entr=?,niveau=?,competence,type_competence;');
                $qw->bindParam(1, $id_entr);
                $qw->bindParam(2, $niveau);
                $qw->bindParam(3, $competence);
                $qw->bindParam(4, $type_competence);
                $qw->bindParam(5, $id_entr);
                $qw->bindParam(6, $niveau);
                $qw->bindParam(7, $competence);
                $qw->bindParam(8, $type_competence);
                $qw->execute();
            }
        }
    }

    catch (Exception $e)
    {
        $e->getMessage();
        echo $e;        
    }

   
}