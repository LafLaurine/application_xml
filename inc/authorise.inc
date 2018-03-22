<?php
session_start();
if (!isset($_SESSION['Joueur'])){
         header('Location: index.php');
         exite();
}
?>