<?php


require_once $_SERVER['DOCUMENT_ROOT']. '/application/inc/connexion.php';


/// Récupération des variables issues du formulaire par la méthode post
$nom_entr = filter_input(INPUT_POST, 'nom_entr');
$mdp_entr = filter_input(INPUT_POST, 'mdp_entr');
$passwordconf = filter_input(INPUT_POST, 'passwordconf');
$email_entr = filter_input(INPUT_POST, 'email_entr');
$telephone_entr = filter_input(INPUT_POST, 'telephone_entr');

//test si le mail est pris ou non
function testEmailValidity2 ($email_entr) {
    $db = connectBd ();
    $req = $db->query("SELECT * FROM entreprise WHERE email_entr = '$email_entr';");
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
    if (isset($mdp_entr,$email_entr))  
    {         
	   $mailValidity2 = testEmailValidity2($email_entr); 

       if ($mailValidity2) {
            echo ("Mail déjà utilisé");
        } 


        //Association des éléments que l'user a entré à la BD
		else
		{
            
            if ($mdp_entr == $passwordconf)
            {
                
                // Password du form
                $hash = hash("sha256",$mdp_entr);
                $req = connectBd()->prepare('INSERT INTO entreprise(nom_entr, email_entr, telephone_entr, mdp_entr) VALUES (?,?,?,?)');
                $req->bindParam(1, $nom_entr);
                $req->bindParam(2, $email_entr);
                $req->bindParam(3, $telephone_entr);
				$req->bindParam(4, $hash);
                $req->execute();

                if($req)
                {
                    if (!session_id())
                    {
                        //Cookie
                        session_start();
                        setcookie('email_entr', $_POST['email_entr'], time() + 365*24*3600, null, null, false, true);
                        header( 'Location: ../home_entr.php?action=success');
                
                    } 
                        
        
                }                
            }
            else
            
            header( 'Location: ../home_entr.php?action=wrongMDP');
            }
            
        }
    }


catch (PDOException $e)
{
    echo ('Erreur : '.$e->getMessage().'<br />');
}
?>