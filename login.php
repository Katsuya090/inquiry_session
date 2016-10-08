<?php
error_reporting(E_ALL & ~E_NOTICE);

session_start();

if (!empty($_SESSION['id']))
{
  header('Location: inquiry.php');
  exit;
}



require_once('functions.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  $name = $_POST['name'];
  $password = $_POST['password'];
  $errors = array();

  // バリテーション
  if ($name == '')
  {
    $errors['name'] = 'ユーザーネームが未入力です。';
  }

  if ($password == '')
  {
    $errors['password'] = 'パスワードが未入力です。';
  }


 // バリデーション突破後
  if (empty($errors))
  {
    $dbh = connectDb();
    $sql = "select * from users where name = :name and password = :password";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":password", $password);
    $stmt->execute();

    $row = $stmt->fetch();

    // var_dump($row);
    if ($row)
    {
      $_SESSION['id'] = $row['id'];
      $_SESSION['name'] = $row['name'];
      header('Location: inquiry.php');
      exit;
    }
    else
    {
      echo 'ユーザーネームかパスワードが間違っています。';
    }
  }





}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ログイン画面</title>
</head>
<body>
  <h1>ログイン</h1>
    <form action="" method="post">
    ユーザーネーム: <input type="text" name="name">
    <?php if ($errors['name']) : ?>
      <?php echo h($errors['name']) ?>
    <?php endif; ?>
    <br>
    パスワード: <input type="text" name="password">
    <?php if ($errors['password']) : ?>
      <?php echo h($errors['password']) ?>
    <?php endif; ?>
    <br>
    <input type="submit" value="ログイン">
  </form>
  <a href="signup.php">新規登録はこちら!</a>
</body>
</html>