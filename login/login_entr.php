<!-- Traitement de la connexion -->

<?php 
header('Content-type: text/html; charset=UTF-8');
session_start();
require_once $_SERVER['DOCUMENT_ROOT']. '/application/inc/connexion.php';

//Teste si l'utilisateur existe
function userExists() 
{
    $db = connectBd();
    $email_entr = $_POST['email_entr'];
    $query = $db->query("SELECT * FROM entreprise WHERE email_entr ='$email_entr';");
    $result = $query->fetch();
    return $result;
   
}

//Récupération des variables
$email_entr = filter_input(INPUT_POST, 'email_entr');
$mdp_entr = filter_input(INPUT_POST, 'mdp_entr');

if (isset($email_entr,$mdp_entr))
{

    if(userExists($email_entr))
    {
        try
        {
            $db = connectBd();
            $options = [
                'cost' => 11,
                'salt' => 111111111111111111111111111
            ];
    
            //On crypte à nouveau le mot de passe afin de vérif avec le bon
            $hash = hash("sha256",$mdp_entr);
           
            // Vérification des identifiants
            $query = "SELECT * FROM entreprise WHERE (email_entr = :email_entr AND mdp_entr = :hash);";   
            $req = $db->prepare($query);
            $req->bindParam('email_entr', $email_entr, PDO::PARAM_STR,255);
            $req->bindParam('hash', $hash , PDO::PARAM_STR, 255);
            $req->execute();
            $result = $req->fetch(PDO::FETCH_ASSOC);

            if ($result)
            {
                
                if (!session_id()) 
                session_start();
                $_SESSION['email_entr'] = $email_entr;
                $_SESSION['id_entr']= $result['id_entr'];
                header('Location:../form_appelOffre.php');
                    
            } else 
            {
                echo("Fail");
            }
            
        } 
        
        
        catch (PDOException $e)
        {
            echo 'Erreur : '.$e->getMessage().'<br />';
        }
    
    }

    else
    {
        echo("L'utilisateur n'existe pas");
    }

        
       
        
       
}

else
{
    echo("Champs vides");
        
}
?>
    
    


