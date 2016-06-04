<?php
session_start();
?>
<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>网站培训--首页</title>
</head>
<body>
    <p>首页内容</p>
     <?php
        if(!empty($_SESSION['user']))
        {
            echo '<p style="color: green;">您已经成功登录，您的登录账号为：'
                 . $_SESSION['user']['username'] . '</p>';
            echo '<p style="color: red"><a href="logout.php" ' . 'onclick="return confirm('. '\'确定?\'' .');"' . '>退出</a></p>';
        } else {
            echo '<p><a href="login.php">登录</a></p>';
            echo '<p><a href="register.php.php">注册</a></p>';
        }
     ?>
</body>
</html>