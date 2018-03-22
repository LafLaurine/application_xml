<?php
class App{

  static $db = null;

  // Load la bd
  static function getDatabase(){
    if(!self::$db){
      self::$db = new Database('root','','cvtek_bdd');
    }
    return self::$db;
  }


}


?>
