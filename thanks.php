<?php
session_start();
if (empty($_SESSION['id']))
{
  header('Location: login.php');
  exit;
}

?>


<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>完了</title>
<link rel="stylesheet" href="style.css">
</head>
<body>




<p class="inquiry">お問い合わせ</p>
<p>お問い合わせありがとうございました。</p>
<a href="inquiry.php">お問い合わせに戻る</a>
</body>
</html>