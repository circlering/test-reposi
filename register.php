<?php
    if(!empty($_POST))
    {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        $password_repeat = trim($_POST['password_repeat']);

        if($password === $password_repeat)
        {
            $username_length = strlen($username);
            if($username_length < 8 or $username_length > 16)
            {
                echo '<p style="color: red;">用户名长度限制在8-16位之内</p>';
            } else {
                $mysqli = new mysqli('localhost', 'root', '', 'user-tmp');
                if ($mysqli)
                {
                    $sql = 'INSERT INTO `user` (`username`, `password`) VALUES ("'
                        .$username
                        .'", "'
                        . md5($password) . '")';

                    $result = $mysqli->query($sql);
                    if ($mysqli->insert_id)
                    {
                        echo '<p style="color: green;">注册成功，<span id="countdown">5</span>秒后跳转至首页</p>';
                        header('Refresh:5;index.php');
                    } else {
                        echo '<p style="color: red;">写入数据库错误，请联系管理员</p>';
                    }

                } else {
                    echo '<p style="color: red;">数据库连接错误！</p>';
                }
            }
        } else {
            echo '<p style="color: red;">两次输入密码不一致</p>';
        }

    }
?>

<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>网站培训--注册</title>
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

    <form action="register.php" method="post">
        <div>
            <label for="username">用户名：</label>
            <input type="text" name="username">
        </div>
        <div>
            <label for="password">密码：</label>
            <input type="password" name="password">
        </div>
        <div>
            <label for="password_repeat">重复密码：</label>
            <input type="password" name="password_repeat">
        </div>
        <input type="submit" value="注册">
    </form>

</body>
</html>