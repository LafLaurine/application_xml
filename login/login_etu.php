<!-- Traitement de la connexion -->

<?php 
header('Content-type: text/html; charset=UTF-8');
session_start();
require_once $_SERVER['DOCUMENT_ROOT']. '/application/inc/connexion.php';

//Teste si l'utilisateur existe
function userExists() 
{
    $db = connectBd();
    $email_etu = $_POST['email_etu'];
    $query = $db->query("SELECT * FROM etudiant WHERE email_etu ='$email_etu';");
    $result = $query->fetch();
    return $result;
   
}

//Récupération des variables
$email_etu = filter_input(INPUT_POST, 'email_etu');
$mdp_etu = filter_input(INPUT_POST, 'mdp_etu');

if (isset($email_etu,$mdp_etu))
{

    if(userExists($email_etu))
    {
        try
        {
            $db = connectBd();
            $options = [
                'cost' => 11,
                'salt' => 111111111111111111111111111
            ];
    
            //On crypte à nouveau le mot de passe afin de vérif avec le bon
            $hash = hash("sha256",$mdp_etu);
           
            // Vérification des identifiants
            $query = "SELECT * FROM etudiant WHERE (email_etu = :email_etu AND mdp_etu = :hash);";   
            $req = $db->prepare($query);
            $req->bindParam('email_etu', $email_etu, PDO::PARAM_STR,255);
            $req->bindParam('hash', $hash , PDO::PARAM_STR, 255);
            $req->execute();
            $result = $req->fetch(PDO::FETCH_ASSOC);
    
            //Teste si le mot de passe est associé avec le mail
            if ($result)
            {
                
                if (!session_id()) 
                session_start();
                
                $_SESSION['email_etu'] = $email_etu;
                $_SESSION['id_etu']= $result['id_etu'];
                header("Location:../form_cv.php");
                    
            } else 
            {
                header( 'Location: ../home_etu.php?action=fail');
            
            }
            
        } 
        
        
        catch (PDOException $e)
        {
           echo 'Erreur, problème de connexion à la base';
        }

    
    }

    else
    {
        header( 'Location: ../home_etu.php?action=empty');
 
    }

        
       
        
       
}

else
{
    echo("Champs vides");
        
}
?>
    
    


