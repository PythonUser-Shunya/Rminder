<?php 

$host = "HOST"; 

$user = "USER"; 

$pass = "PASS"; 

$db = "DATABASE"; 



$param = "mysql:dbname=".$db.";host=".$host; 

// よりセキュリティが強固なプログラミング方法
// データベースとのコネクションが生成されます。
$pdo = new PDO($param, $user, $pass); 


// データベースアクセスに使う文字コードを「UTF-8」に設定します。
$pdo->query('SET NAMES utf8;'); 


// このとき、登録するデータは画面で入力されたデータですが、INSERT文の中には直接書かず、「:title」「:remind_date」のように書いておきます。
// 新規登録処理（INSERT文）
// 実行したいSQL文をセットする
// $stmt = $pdo->prepare("INSERT INTO reminder (title, remind_date) VALUES (:title, :remind_date)"); 

// SQLに対してパラメータをセットする
// $stmt->bindValue(':title', $_POST["title"]); 

// $stmt->bindValue(':remind_date', $_POST["remind_date"]); 
 

if ($_POST['id']) { 

    $stmt = $pdo->prepare("UPDATE reminder SET title = :title, remind_date = :remind_date WHERE id = :id"); 
    
    $stmt->bindValue(':id', $_POST["id"]); 
    
    $stmt->bindValue(':title', $_POST["title"]); 
    
    $stmt->bindValue(':remind_date', $_POST["remind_date"]); 
    
    } else { 
    
    $stmt = $pdo->prepare("INSERT INTO reminder (title, remind_date) VALUES (:title, :remind_date)"); 
    
    $stmt->bindValue(':title', $_POST["title"]); 
    
    $stmt->bindValue(':remind_date', $_POST["remind_date"]); 
    
    }

    // 実際にSQLを実行する
$flag = $stmt->execute();

// データベース接続を解放します。
unset($pdo); 


// 画面遷移
header("Location: index.php"); 

exit; 

?>
