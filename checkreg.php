<?
    $login = $_POST['login'];
    $pass = $_POST['pass'];
    $pass = md5($pass.'BondSoft');
    $con = mysqli_connect('localhost','root','','mydb');
    $query = mysqli_query($con,'SELECT `login` FROM `users`');
    $count = mysqli_num_rows($query);
    for ($i; $i<$count; $i++)
    {
        $row = mysqli_fetch_row($query);
        if ($login == $row[0])
        {
            echo ('Регистрация не может быть завершена, так как такой логин уже занят. Пожалуйста, придумайте другой.');
            return;
        }
    }
    $query = mysqli_query($con,  'INSERT INTO `users` (`login`, `pass`) VALUES ("'.$login.'","'.$pass.'")');
    echo('Регистрация прошла успешно');
?>