<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>名前登録</title>
</head>
<body>
<form action = "mission_2-6_2.php" method = "post">
名前：<br />
<input type ="text" name= "message" size="30" value="" /><br />
パスワード：<br />
<input type ="text" name= "pass1" size="30" value="" /><br />
コメント：<br />
<textarea name="comment" cols="30" rows="5"></textarea><br />
<input type = "submit" value="登録する" /><br />
</form>
<form action="mission_2-6_2.php" method="post" >
パスワード：<br />
<input type ="text" name= "pass2" size="30" value="" /><br />
削除する番号：<br />
<input type ="text" name= "delete" size="5" value="" /><br />
<input type='submit'value='削除' /><br />
</form>

</body>
</html>





<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<form action="mission_2-6_1.php" method="post" >
パスワード：<br />
<input type ="text" name= "pass3" size="30" value="" /><br />
編集する番号：<br />
<input type ="text" name= "edit" size="5" value="" /><br />
<input type='submit'value='編集' /><br />
</form>

<?php
//$lines = 'kadai2-4.txt';
$lines = file('kadai2-4.txt');
//whileで行末までループ処理
foreach($lines as $ab) {
// fgetsでファイルを読み込み、変数に格納
//$abc = fgets($aaa);
//$linesの中身を分割
$stu = explode("<>",$ab);

// ファイルを読み込んだ変数を出力
echo $stu[0].'<br>';
  echo $stu[1].'<br>';
  echo $stu[2].'<br>';
  echo $stu[3].'<br>';
};

?>
<?php
$edit = $_POST["edit"];
//$_POST["pass3"]を変数に格納
$pass3 = $_POST["pass3"];
//echo $pass3;
//echo "check_if3|" .$pass3. "|<hr>" ;
//$filenote = file('kadai2-4.txt');//1行ずつの配列
/*foreach($filenote as $lines){//配列から1つずつ取り出す
	$datas = explode('<>',$lines);//<>で切って配列に
$datas[4] = rtrim("$datas[4]");*/
//}
//echo $pass3;
//echo $datas[4];
//if ($pass3 == $datas[4] and $edit == $datas[0]){
//if (isset($_POST['edit'])){
//echo $pass3;
//echo $datas[4];
//echo "check_if1|" .$pass3. "|<hr>" ;
$filedata = file('kadai2-4.txt');//1行ずつの配列
//$fp = fopen('kadai2-4.txt','r');//内容を消して開く
//echo $pass3;
//echo $datas[4];
	foreach($filedata as $line){//配列から1つずつ取り出す
	$data = explode('<>',$line);//<>で切って配列に
//echo "check_if2A|" .$data[0]. "|<hr>" ;
//echo "check_if2B|" .$data[1]. "|<hr>" ;
//echo "check_if2C|" .$data[2]. "|<hr>" ;
//echo "check_if2D|" .$data[3]. "|<hr>" ;
//echo "check_if2E|" .$data[4]. "|<hr>" ;
$sign = rtrim("$data[4]");
//echo "check_if2F|" .$sign. "|<hr>" ;

		if($data[0] ==$edit and $sign ==$pass3){//一致するものを変数に格納
		$edit_num = $data[0];
		$user = $data[1];
		$text = $data[2];
		$password = $sign;
		//}
	//}
//echo "check_ifA|" .$edit_num. "|<hr>" ;
//echo "check_ifB|" .$user. "|<hr>" ;
//echo "check_ifC|" .$text. "|<hr>" ;
//echo "check_ifD|" .$password. "|<hr>" ;
//echo $edit_num;
//echo $user;
//echo $text;

echo "<form action = 'mission_2-6_2.php' method = 'post'>";
echo "<input type ='hidden' name= 'edit_num' size='30' value= $edit_num /><br />";
echo "<input type ='hidden' name= 'password' size='30' value= $password /><br />";
echo "編集用フォーム：<br />";
echo "名前：<br />";
echo "<input type ='text' name= 'user' size='30' value= $user /><br />";
echo "コメント：<br />";
echo "<input type ='text' name= 'text' size='30' value= $text /><br />";
echo "<button type='submit'>送信</button></form>";

}
}
//fclose($fp);
?>
</body>
</html>

