<?
    $login = $_POST['login2'];
    $pass = $_POST['pass2'];
    $pass = md5($pass.'BondSoft');
    $con = mysqli_connect('localhost','root','','mydb');
    $query = mysqli_query($con, 'SELECT `login`,`pass` FROM `users`');
    $count = mysqli_num_rows($query);
    for ($i=0; $i<$count; $i++)
    {
        $row = mysqli_fetch_row($query);
        if (($login == $row[0]) and ($pass == $row[1]))
        {
            echo('YES');
            return;
        }
    }
    print_r('NO');
?>