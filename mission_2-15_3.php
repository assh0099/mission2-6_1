<?php
//データベースへの接続
$dsn = 'データベース名'
$pdo = new PDO($dsn,'ユーザー名','パスワード');
//SQLコマンド「CREATE TABLE」で新規テーブルを作成する。
$sql='CREATE TABLE IF NOT EXIST Second
(
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(30) NOT NULL,
comment VARCHAR(30) NOT NULL,
password VARCHAR(50) NOT NULL,
reg_date VARCHAR(30)
);';
$result=$pdo->query($sql);

?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>名前登録</title>
</head>
<body>
<form action = "mission_2-15_3.php" method = "post">
名前：<br />
<input type ="text" name= "message" size="30" value="" /><br />
パスワード：<br />
<input type ="text" name= "pass1" size="30" value="" /><br />
コメント：<br />
<textarea name="comment" cols="30" rows="5"></textarea><br />
<input type = "submit" value="登録する" /><br />
</form>
<form action="mission_2-15_3.php" method="post" >
パスワード：<br />
<input type ="text" name= "pass2" size="30" value="" /><br />
削除する番号：<br />
<input type ="text" name= "delete" size="5" value="" /><br />
<input type='submit'value='削除' /><br />
</form>
</body>
</html>

<?php
	if (isset($_POST['message'])) {//$_POST['message']に中身があるかで分岐


//$_POST["message"]を変数に格納
	$message = $_POST["message"];
//$_POST["pass1"]を変数に格納
	$pass1 = $_POST["pass1"];
//$_POST["comment"]を変数に格納
	$comment = $_POST["comment"];
//時間を取得
  $time = date("Y年n月j日　Ah:i");

$stmt = $pdo -> prepare("INSERT INTO Second (name,comment,password,reg_date) VALUES (:name, :comment, :password, :reg_date)");
$id=1;
//$lastname = '森田';
$stmt->bindParam(':name', $message, PDO::PARAM_STR);
$stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
$stmt->bindParam(':password', $pass1, PDO::PARAM_STR);
$stmt->bindParam(':reg_date', $time, PDO::PARAM_STR);
$stmt->execute();


}
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<form action="mission_2-15_3.php" method="post" >
パスワード：<br />
<input type ="text" name= "pass3" size="30" value="" /><br />
編集する番号：<br />
<input type ="text" name= "edit" size="5" value="" /><br />
<input type='submit'value='編集' /><br />
</form>



<?php
$del = $_POST["delete"];
//$_POST["pass2"]を変数に格納
$pass2 = $_POST["pass2"];
//echo "check_if1|" .$pass2. "|<hr>" ;
//echo "check_if2|" .$del. "|<hr>" ;
$sql ="delete from Second where id=$del AND password='$pass2'";

$result = $pdo->query($sql);

?>

<?php
//テーブルのidカラムを削除
$sqm='ALTER TABLE Second drop column id';
$result=$pdo->query($sqm);
//AUTO_INCREMENTは主キーであり、かつNullでないことが必要なのでそれらを明記します。
$sqm='ALTER table Second add id int(6) primary key not null auto_increment first;';
//idカラムにAUTO_INCREMENTを1から設定する
$result=$pdo->query($sqm);
$sqm='ALTER TABLE Second AUTO_INCREMENT =1';
$result=$pdo->query($sqm);
?>

<?php

$sql = 'SELECT * FROM Second';//クエリ

$result = $pdo->query($sql);//実行・結果取得
//出力
foreach ($result as $row){

echo $row['id'].',';

echo $row['name'].'<br>';

echo $row['comment'].'<br>';

echo $row['password'].'<br>';

echo $row['reg_date'].'<br>';

echo '<br>';
}

?>
<?php
$edit_num = $_POST["edit"];
//$_POST["pass3"]を変数に格納
$pass3 = $_POST["pass3"];
$sql = 'SELECT * FROM Second';//クエリ

$result = $pdo->query($sql);//実行・結果取得
//出力
foreach ($result as $row){

if($row['id']==$edit_num and $row['password']==$pass3){
$user = $row['name'];
$text = $row['comment'];
$id = $row['id'];
echo "<form action = 'mission_2-15_3.php' method = 'post'>";
echo "<input type ='hidden' name= 'edit_num' size='30' value= $edit_num /><br />";
//echo "<input type ='hidden' name= 'password' size='30' value= $password /><br />";
echo "編集用フォーム：<br />";
echo "名前：<br />";
echo "<input type ='text' name= 'user' size='30' value= $user /><br />";
echo "コメント：<br />";
echo "<input type ='text' name= 'text' size='30' value= $text /><br />";
echo "<button type='submit'>送信</button></form>";


}
}

?>
</body>
</html>

<?php
if (isset($_POST['edit_num'])){
$id = $_POST['edit_num'];
$times = date("Y年n月j日　Ah:i");
$users = $_POST["user"];
$texts = $_POST["text"];
//echo "check_if3|" .$users. "|<hr>" ;
//echo "check_if4|" .$texts. "|<hr>" ;
//echo "check_if5|" .$times. "|<hr>" ;
//echo "check_if6|" .$id. "|<hr>" ;
$sqm = "update Second set name='$users',comment='$texts',reg_date='$times' where id=$id";

$result = $pdo->query($sqm);

if (!$result) {
    var_dump($pdo->errorInfo());
    exit;
}
}
?>