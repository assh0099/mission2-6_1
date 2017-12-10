<?php
if (isset($_POST['message'])) {//$_POST['message']に中身があるかで分岐
//テキストファイルを変数に格納
$filename = 'kadai2-4.txt';
//追記モードでファイルを開く
$fp = fopen($filename,'a');
//ファイルを配列で読み込む
 $array = file($filename);
//ファイルの中身を数える
$abc = count($array,COUNT_RECURSIVE);
//変数に1を足す
$abcd = $abc+1;

//$_POST["message"]を変数に格納
$message = $_POST["message"];
//$_POST["pass1"]を変数に格納
$pass1 = $_POST["pass1"];
//$_POST["comment"]を変数に格納
$comment = $_POST["comment"];
//時間を取得
  $time = date("Y年n月j日　Ah:i");

$deta = "$abcd"."<>"."$message"."<>"."$comment"."<>"."$time"."<>"."$pass1"."<>"."\r\n";
//テキストファイルに書き込む
fwrite($fp,$deta);

fclose($fp);
}
?>


<?php
$del = $_POST["delete"];
//$_POST["pass2"]を変数に格納
$pass2 = $_POST["pass2"];
$filenote = file('kadai2-4.txt');//1行ずつの配列
//echo "check_if1|" .$pass2. "|<hr>" ;
//$fp = fopen('kadai2-4.txt','w+');//内容を消して開く
foreach($filenote as $lines){//配列から1つずつ取り出す
	$datas= explode('<>',$lines);//<>で切って配列に
$datas[4] = rtrim("$datas[4]");
//}
//echo $pass2;
//echo "check_if2|" .$datas[4]. "|<hr>" ;
//echo $datas[4];
if ($pass2==$datas[4] and $del == $datas[0]){
//echo $datas[4];
//if (isset($_POST['delete'])){
$filedata = file('kadai2-4.txt');//1行ずつの配列
$fp = fopen('kadai2-4.txt','w+');//内容を消して開く

	foreach($filedata as $line){//配列から1つずつ取り出す
	$data = explode('<>',$line);//<>で切って配列に

		if($data[0]!=$del){//「$delと違う」ときにカッコ内を処理
		fputs($fp,$line);//ファイルに追記
		}//$delと同じの時は何もしない。
	}
//}
//fclose($fp);




//ファイルの中身を数える
//$abc = count($note,COUNT_RECURSIVE);
$note = file('kadai2-4.txt');//1行ずつの配列
$abcd = 0;
$fp = fopen('kadai2-4.txt','w+');//内容を消して開く
	foreach($note as $line){//配列から1つずつ取り出す
	//ファイルの中身を数える
	//$abc = count($note,COUNT_RECURSIVE);
	//変数に1を足す
	//$abcd = 0;
	$abcd++;
	$data = explode('<>',$line);//<>で切って配列に
//数字もすでに$dataに格納されている
	$num = "$abcd"."<>"."$data[1]"."<>"."$data[2]"."<>"."$data[3]"."<>"."$data[4]";

	fwrite($fp,$num);
	}

fclose($fp);
}
}
?>
<?php
//それぞれの変数を受信
$edit_num = $_POST["edit_num"];
$user = $_POST["user"];
$text = $_POST["text"];
$time = date("Y年n月j日　Ah:i");
$password = $_POST["password"];
//echo "check_if7|" .$edit_num. "|<hr>" ;
//echo "check_if7|" .$user. "|<hr>" ;
//echo "check_if7|" .$time. "|<hr>" ;
//echo "check_if7|" .$password. "|<hr>" ;
	if (isset($_POST['edit_num'])){
//echo "check_if8|" .$edit_num. "|<hr>" ;
	$files = file('kadai2-4.txt');//1行ずつの配列
//echo "check_if9|" .$edit_num. "|<hr>" ;
	$fp = fopen('kadai2-4.txt','w+');//内容を消して開く
//echo "check_if10|" .$edit_num. "|<hr>" ;
foreach($files as $lines){//配列から1つずつ取り出す
//echo $lines;

	$datas = explode('<>',$lines);//<>で切って配列に
//echo "check_if5|" .$datas[0]. "|<hr>" ;
//echo "check_if6|" .$edit_num. "|<hr>" ;
		if($datas[0] ==$edit_num){//一致するものを変数に格納
//echo "check_if11|" .$edit_num. "|<hr>" ;
//$fp = fopen('kadai2-4.txt','w+');//内容を消して開く
		$textbook="$edit_num"."<>"."$user"."<>"."$text"."<>"."$time"."<>"."$password";
		fputs($fp,$textbook);//編集した1行をファイルに追記
		}else{//一致しないときは元のデータをそのまま書き込み
		fputs($fp,$lines);//元の1行をファイルに追記
		}
	}
fclose($fp);
//echo $text;
//echo "A";
//echo $edit_num;
}
?>