<?php 

$host = "HOST"; 

$user = "USER"; 

$pass = "PATH"; 

$db = "DATABASE"; 



$param = "mysql:dbname=".$db.";host=".$host; 

$pdo = new PDO($param, $user, $pass); 

$pdo->query('SET NAMES utf8;'); 



if ($_GET['id']) { 

$stmt = $pdo->prepare("DELETE FROM reminder WHERE id = :id"); 

$stmt->bindValue(':id', $_GET["id"]); 

$flag = $stmt->execute(); 

} 

unset($pdo); 



header("Location: index.php"); 

exit; 

?>