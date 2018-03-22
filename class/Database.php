<!-- GESTION DE LA DB -->
<?php
  class Database{

    private $pdo;

    // CONSTRUCTEUR
    // Se connecte
    // Return les erreurs
    // Met sous forme d'objet
    public function __construct($login, $password, $database_name, $host = 'localhost'){
      $this->pdo = new PDO("mysql:dbname=$database_name;host=$host", $login, $password);
      $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    }

    // Requete
    public function query($query, $params = false){
      try{
      // S'il y a des param, prepare et exec la requette;
      if($params){
        $req = $this->pdo->prepare($query);
        $req->execute($params);
      }else{
        // Exec directement la requete
        $req = $this->pdo->query($query);
      }
    }catch(PDOException $e){
        echo $e->getMessage();
        echo $e->getFile();
        echo $e->getLine();
        die();

      }
      return $req;
    }

    // Recupere le dernier id inserer en BD
    public function lastInsertId(){
      return $this->pdo->lastInsertId();
    }
  }

 ?>
