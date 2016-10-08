<?php
error_reporting(E_ALL & ~E_NOTICE);


require_once('functions.php');

session_start();

if ($_SERVER['REQUEST_METHOD']  == 'POST')
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

    $sql = "insert into users (name, password, created_at) values
            (:name, :password, now())";

    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":password", $password);
    $stmt->execute();
    // var_dump($_POST);

    // var_dump($errors);

    header('Location: login.php');
    exit;
  }

}
?>

<!DOCTYPE html>
<html lang='ja'>
<head>
  <meta charset="UTF-8">
  <title>新規登録画面</title>
</head>
<body>
  <h1>新規登録画面です</h1>
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
    <input type="submit" value="登録する">
  </form>
  <a href="login.php">ログインはこちら</a>
</body>
</html>