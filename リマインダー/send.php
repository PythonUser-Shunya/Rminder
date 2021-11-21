<?php



$host = "HOST";

$user = "USER";

$pass = "PASS";

$db = "DATABASE";


// mysqli_connect(サーバーの場所、ID、パスワード)
// or dieは「もし失敗したら"host接続失敗"というメッセージを残してプログラムを終了せよ」という命令
$conn = mysqli_connect($host, $user, $pass) or die("host接続失敗");

// mysqli_select_db(データベースサーバーに接続済みの変数、接続したいデータベース名)
mysqli_select_db($conn, $db) or die("db接続失敗");



mysqli_set_charset($conn, 'utf8');


// データベースに命令するための、SQL（エスキューエル）というプログラミング言語
// contactというデータベースに対して保存
$sql = "INSERT INTO contact (name, kana, mail, address, tel, comment) VALUES ('".$_POST["name"]."','".$_POST["kana"]."','".$_POST["mail"]."','".$_POST["address"]."','".$_POST["tel"]."','".$_POST["comment"]."')";

// 「実際にSQLを実行せよ」という命令
// $connはデータベースから切断する命令
$result_flag = mysqli_query($conn, $sql);



if (!$result_flag) {

    die('INSERT失敗'.mysqli_error($conn));

}



mysqli_close($conn) or die("MySQL切断に失敗しました。");



mb_language("japanese");

mb_internal_encoding("UTF-8");


// PHP_EOLは「改行」という意味
// $body = "氏名：" . $_POST["name"] . PHP_EOL . "お問い合わせ内容：" . $_POST["comment"];

$body = "氏名：" . $_POST["name"] . "\nお問い合わせ内容：" . $_POST["comment"];

// メール送信の命令
mb_send_mail($_POST["mail"], 'お問い合わせありがとうございました', $body);



?>

<html>

<head>

<title>お問い合わせフォーム</title>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

</head>

<body>

<p>メールが送信されました。</p>

</body>

</html>