<?php 

$host = "HOST"; 

$user = "USER"; 

$pass = "PASS"; 

$db = "DATABASE";  



$param = "mysql:dbname=".$db.";host=".$host; 

$pdo = new PDO($param, $user, $pass); 

$pdo->query('SET NAMES utf8;'); 



$sql = "SELECT * FROM reminder"; 

$stmt = $pdo->query($sql); 



$body = ""; 



while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 

  if ($row['remind_date'] == date("Y-m-d")) { 

    $body .= $row['title'] . "\n"; 

  } 

} 

unset($pdo); 



if (!empty($body)) { 

  mb_language("japanese"); 

  mb_internal_encoding("UTF-8"); 

  mb_send_mail("shunya111666@gmail.com", '【リマインダー】今日の重要タスクがあります！', $body); 

} 

exit; 

?>