<?php


require_once $_SERVER['DOCUMENT_ROOT']. '/application/inc/connexion.php';

/// Récupération des variables issues du formulaire par la méthode post
$nom_etu =  filter_input(INPUT_POST, 'nom_etu');
$prenom_etu = filter_input(INPUT_POST, 'prenom_etu');
$mdp_etu = filter_input(INPUT_POST, 'mdp_etu');
$passwordconf = filter_input(INPUT_POST, 'passwordconf');
$email_etu = filter_input(INPUT_POST, 'email_etu');
$telephone_etu = filter_input(INPUT_POST, 'telephone_etu');

//test si le mail est pris ou non
function testEmailValidity ($email_etu) {
    $db = connectBd ();
    $req = $db->query("SELECT * FROM etudiant WHERE email_etu = '$email_etu';");
    $result = $req->fetch();
    if ($result)
        return true;
    else 
        return false;
}

try
{ 
    $db = connectBd ();
    // Si le formulaire est envoyé
    if (isset($mdp_etu,$email_etu))  
    {         
	   $mailValidity = testEmailValidity($email_etu); 

       if ($mailValidity) {
            echo ("Mail déjà utilisé");
        } 


        //Association des éléments que l'user a entré à la BD
		else
		{
            
            if ($mdp_etu == $passwordconf)
            {
                
                // Password du form
                $hash = hash("sha256",$mdp_etu);
                $req = connectBd()->prepare('INSERT INTO etudiant(nom_etu, prenom_etu, email_etu, telephone_etu, mdp_etu) VALUES (?,?,?,?,?)');
                $req->bindParam(1, $nom_etu);
                $req->bindParam(2, $prenom_etu);
                $req->bindParam(3, $email_etu);
				$req->bindParam(4, $telephone_etu);
				$req->bindParam(5, $hash);
                $req->execute();

                if($req)
                {
                    if (!session_id())
                    {
                        //Cookie
                        session_start();
                        $_SESSION['email_etu'] = $email_etu;
                        $_SESSION['id_etu']= $result['id_etu'];
                        setcookie('email_etu', $_POST['email_etu'], time() + 365*24*3600, null, null, false, true);
                        header( 'Location: ../home_etu.php?action=success');
                      
                    } 
                        
        
                }                
            }
            else
            {
                header( 'Location: ../home_etu.php?action=wrongMDP');
            }
            
        }
    }

}
catch (PDOException $e)
{
    echo 'Erreur : '.$e->getMessage().'<br />';
}
?>