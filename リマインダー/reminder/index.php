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

?>

<html> 

  <head> 

    <title>一覧画面 | リマインダー</title> 

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 

  </head> 

  <body> 

    <h1>一覧画面</h1> 
    
<!-- 右寄せにしてる -->
      <div style="width:100%;text-align:right;"> 

        <a href="edit.php">新規登録</a> 

      </div> 

      <table width="100%" border="1"> 

        <tr> 

          <th>タイトル</th><th>期日</th><th></th> 

        </tr> 

        <?php 

          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 

          echo "<tr>"; 
          
          // $row['xxxxx']という書き方でデータベースの値を取り出しています。
          // このxxxの部分はデータベーステーブルのカラム名（項目名）です。
          echo "<td>".$row['title']."</td>"; 

          echo "<td>".$row['remind_date']."</td>"; 

          // この、[変更]リンクが押されると、「edit.php」が呼ばれます。
          // その時、パラメーターとして「id ="$row['id']"」が渡されます。
          echo "<td><a href=\"edit.php?id=".$row['id']."\">[変更]</a>&nbsp;<a href=\"delete.php?id=".$row['id']."\" onclick=\"return confirm('削除しても宜しいですか ?')\"> [削除]</a></td>"; 

          echo "</tr>"; 

          } 

          unset($pdo); 

        ?>

      </table> 

  </body> 

</html>