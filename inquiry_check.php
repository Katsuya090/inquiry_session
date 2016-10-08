<?php
require_once('functions.php');
error_reporting(E_ALL & ~E_NOTICE);
session_start();



$sort = array(
  1  => "商品について",
  2  => "お支払いについて",
  3 => "当サイトについて",
  4 => "その他",
);

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  $name = $_POST['name'];
  $mailaddress = $_POST['mailaddress'];
  $sorts = $_POST["sort"];
  $question = $_POST['question'];



  $dbh = connectDb();

  $sql = "insert into inquiry (name, mailaddress, kind, question, createdAt) values
          (:name, :mailaddress, :kind, :question, now())";

  $stmt = $dbh->prepare($sql);
  $stmt->bindParam(":name", $name);
  $stmt->bindParam(":mailaddress", $mailaddress);
  $stmt->bindParam(":kind", $sorts);
  $stmt->bindParam(":question", $question);

  $stmt->execute();


  unset($_SESSION['mailaddress']);
  unset($_SESSION['sorts']);
  unset($_SESSION['question']);


  header('Location: thanks.php');
  exit;
}




?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>お問い合わせ</title>
<link rel="stylesheet" href="style.css">
</head>
<body>



<p>お問い合わせ</p>
<form action="thanks.php" method="post" id="myform">
<table>
<tr>
<th><label for="user">名前</label></th>
<td><?php echo h($_SESSION['name']) ?></td>
</tr>
<tr>
<th><label for="mail">メールアドレス</label></th>
<td><?php echo h($_SESSION['mailaddress']) ?></td>
</tr>
<tr>
<th><label for="sort">種類</label></th>
<td><?php echo $sort[$_SESSION['sorts']] ?></td>
</tr>
<tr>
<th><label for="com">お問い合わせ内容</label></th>
<td><?php echo h($_SESSION['question']) ?></td>
</tr>
</table>
</form>
<form method="post" action="">
    <input name="name" type="hidden" value="<?php echo $_SESSION['name'] ?>">
    <input name="mailaddress" type="hidden" value="<?php echo $_SESSION['mailaddress'] ?>">
    <input name="sort" type="hidden" value="<?php echo $sort[$_SESSION['sorts']] ?>">
    <input name="question" type="hidden" value="<?php echo $_SESSION['question'] ?>">
<p>
  <input class="botton1" type="submit" onclick="history.back()" value="戻る">
  <input class="botton2" type="submit" value="送信する">
</p>
</form>

</body>
</html>