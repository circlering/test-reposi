<?php
    session_start();
    if(!empty($_POST))
    {
        $username = trim($_POST['username']);
        $password = md5(trim($_POST['password']));

        $mysqli = new mysqli('localhost', 'root', 'root', 'user-tmp');

        $sql = 'SELECT `username`, `id` FROM `user` WHERE `username` = "'
              . $username
              . '" AND `password` = "'
              . $password
              .'" LIMIT 1';

        $result = $mysqli->query($sql, MYSQLI_USE_RESULT);

        $user = $result->fetch_all(MYSQLI_ASSOC);
        if($user)
        {
            $_SESSION['user'] = $user[0];
            echo '<p style="color: green;">您已经登录成功，<span id="countdown">5</span>秒后跳转至首页</p>';
            header('Refresh:5;index.php');
        } else {
            echo '<p style="red;">您输入的用户名和密码不匹配</p>';
        }
    }
?>
<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>网站培训--登录</title>
    <script>
        function countdownFunction(){
            var span = document.getElementById('countdown');
            var currentValue = parseInt(span.innerText);
            if (currentValue > 1)
            {
                span.innerText = currentValue - 1;
            } else {
                window.clearInterval('countdownProcedure');
            }
        }
        window.countdownProcedure = window.setInterval(countdownFunction, 1000);
    </script>
</head>
<body>

<form action="login.php" method="post">
    <div>
        <lebel>用户名：</lebel>
        <input type="text" name="username"></div>
    <div>
        <lebel>密码：</lebel>
        <input type="password" name="password"></div>
    <input type="submit" value="登录">
</form>

</body>
</html>