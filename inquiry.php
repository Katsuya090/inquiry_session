<?php
  // var_dump($_POST);
require_once('functions.php');
error_reporting(E_ALL & ~E_NOTICE);
session_start();


if (empty($_SESSION['id']))
{
  header('Location: login.php');
  exit;
}

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


  if ($name =='')
  {
    $err1 = 'お名前が入力されていません。';
  }


  if ($mailaddress == ''){
    $err2 = 'メールアドレスが入力されていません。';
  }

  if (!isset($sort["$sorts"])){
    $err3 = '種類が入力されていません。';
  }


  if ($question == '') {
    $err4 = 'お問い合わせが入力されていません。';
  }

  if ($err1 == '' && $err2 == '' && $err3 == '' && $err4 == '')
  {
      $_SESSION['name']=$name;
      $_SESSION['mailaddress']=$mailaddress;
      $_SESSION['sorts']=$sorts;
      $_SESSION['question']=$question;
      header('Location: inquiry_check.php');
      exit;
  }
}
?>





<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>お問い合わせ</title>
<link rel="stylesheet" href="style.css">
</head>
<body>




<p>お問い合わせ</p>
<form action="" method="post" id="myform">
<table>
<tr>
<th><label for="user">名前<span class="need">&nbsp;&nbsp;(必須)</span></label></th>
<td><input type="text" id="user" name="name" value="<?php echo h($_SESSION['name']) ?>">
<p class="err"><?php echo $err1; ?></p>
</td>
</tr>
<tr>
<th><label for="mail">メールアドレス<span class="need">&nbsp;&nbsp;(必須)</span></label></th>
<td><input type="text" id="mail" name="mailaddress" value="<?php echo h($_SESSION['mailaddress']) ?>">
<p class="err"><?php echo $err2; ?></p>
</td>
</tr>
<tr>
<th><label for="sort">種類<span class="need">&nbsp;&nbsp;(必須)</span></label></th>
<td><select name="sort">
          <option value="">選択してください</option>
          <?php
            foreach($sort as $sortkey => $sort) {
          if ($_SESSION['sorts'] == $sortkey){
        echo '<option value="' . $sortkey . '" selected="selected">' . $sort . '</option>';
      }
      else{
      echo ('<option value="' . $sortkey .'">' . $sort .'</option>');
    }
    }
    ?>

</select>
<p class="err"><?php echo $err3; ?></p>
</td>
</tr>
<tr>
<th><label for="com">お問い合わせ内容<span class="need">&nbsp;&nbsp;(必須)</span></label></th>
<td><textarea id="com" name="question" cols="40" rows="8"><?php echo h($_SESSION['question'])?></textarea>
<p class="err"><?php echo $err4; ?></p>
</td>
</tr>
</table>
<p><input class="botton2" type="submit" value="確認画面へ" id="submit"></p>
</form>
<a href="logout.php">ログアウト</a>
</body>
</html>