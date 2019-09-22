<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="bootstrap.css">
        <link rel="stylesheet" href="style.css">
        <title>Баланс школьников</title>
        <?
            $con = mysqli_connect('localhost','root','','mydb');
            if ($con)
            {
                echo('<script>console.log("Подключение к базе данных успешно")</script>');
            } else
            {
                echo('<script>alert("Ошибка подключения к базе данных")</script>');
            }
            $students = mysqli_query($con, 'SELECT * FROM `students`');
            $students_count = mysqli_num_rows($students);
            echo('<script>console.log("Список студентов успешно загружен. Всего: "+'.$students_count.')</script>');
            for ($i=0; $i<$students_count; $i++)
            {
                $student = mysqli_fetch_row($students);
                $student_list[$i][0] = $student[0];
                $student_list[$i][1] = $student[1];
                $student_list[$i][2] = $student[2];
            }
        ?>
    </head>
    <body>
    <div class="conteiner-fluid">
        <div class="row">
            <div class="col">
                <label>Балансы всех школьников</label>
            </div>
            <div class="col" id="guestlabel">
                Гость
            </div>
            <div class="col" id="namelabel" style="display: none">
                Имя
            </div>
            <div class="col">
                <input type="button" value="Выйти" id="exitbutton" style="display: none">
            </div>
        </div>
    </div>
    <form method="GET" action="personal.php" id="personalform"></form>
    <form action="operation.php" method="post" id="sendform">
        <div class="container-fluid" style="margin-top: 30px">
            <div class="row" style="background-color: lightgreen">
                <div class="col">
                    <input type="checkbox" id="allcheck" style="margin-top: 7px">
                </div>
                <div class="col">
                    <label>id</label>
                </div>
                <div class="col">
                    <label>Фамилия и имя</label>
                </div>
                <div class="col">
                    <label>Баланс</label>
                </div>
            </div>
            <div class="row" style="height:20px; background-color: lightgreen"></div>
                    <?
                        for ($i=0; $i<$students_count; $i++)
                        {
                            if ($student_list[$i][2]<50)
                            {
                                if (($i % 2) == 0)
                                {
                                    $color_line = "lightgreen";
                                } else
                                {
                                    $color_line = "mediumspringgreen";
                                }
                                $warning='style="color: red"';
                            }
                            echo('<div class="row" style="background-color: '.$color_line.'"><div class="col"><input name="checked[]" value="'.$student_list[$i][0].'" style="margin-top: 7px" type="checkbox" class="studentcheckbox"></div><div class="col"><label style="color: blue" class="studentid" for="personalform" data-id="'.$student_list[$i][0].'">'.$student_list[$i][0].'</label></div><div class="col">'.$student_list[$i][1].'</div><div class="col" '.$warning.' id="money'.$i.'">'.$student_list[$i][2].'</div></div>');
                        }
                    ?>
        </div>
        <div style="position: absolute; bottom: 0; width:100%">
            <div class="row">
                <div class="col" style="text-align: center;">
                    <input type="text" name="summa" id="moneyval" style="margin-bottom: 50px; width:100%; text-align:center; display: none">
                </div>
            </div>
            <div class="row no-gutters">
                <div class="col">
                    <input type="button" class="sendbutton" style="width: 100%; display: none" name="operation" value="Снять" id="minus">
                    <input type="button" class="regbutton" style="width: 100%" name="reg" value="Зарегистрироваться" id="regbutton">
                </div>
                <div class="col">
                    <input type="button" class="sendbutton" style="width: 100%; display: none" name="operation" value="Пополнить" id="plus">
                    <input type="button" class="regbutton" style="width: 100%" name="enter" value="Войти" id="enterbutton">
                </div>
            </div>
        </div>
    </form>
    <div id="regblock"  class="modal">
        <form id="registrationform">
            <h5 style="text-align: center">Регистрация</h5>
            <div class="row regrow">
                <div class="col reglabel">
                    <label>Логин: </label>
                </div>
                <div class="col reginput">
                    <input type="text" name="login" id="login">
                </div>
            </div>
            <div class="row regrow">
                <div class="col reglabel">
                    <label>Пароль: </label>
                </div>
                <div class="col reginput">
                    <input type="text" name="pass" id="pass">
                </div>
            </div>
            <div class="row regrow">
                <div class="col reglabel">
                    <label>Ещё раз пароль: </label>
                </div>
                <div class="col reginput">
                    <input type="text" id="passrepeat">
                </div>
            </div>
            <div style="text-align: center; margin-top: 20px;"><input type="button" id="regbutton2" value="Зарегистрироваться"></div>
            <div style="text-align: center; margin-top: 20px;"><input type="button" id="closebutton" value="Отмена"></div>
        </form>
    </div>
    <div  id="enterblock" class="modal">
        <form id="autorizationform">
            <h5 style="text-align: center">Авторизация</h5>
            <div class="row regrow">
                <div class="col reglabel">
                    <label>Логин: </label>
                </div>
                <div class="col reginput">
                    <input type="text" name="login2" id="login2">
                </div>
            </div>
            <div class="row regrow">
                <div class="col reglabel">
                    <label>Пароль: </label>
                </div>
                <div class="col reginput">
                    <input type="text" name="pass2" id="pass2">
                </div>
            </div>
            <div style="text-align: center; margin-top: 20px;"><input type="button" id="enterbutton2" value="Войти"></div>
            <div style="text-align: center; margin-top: 20px;"><input type="button" id="closebutton2" value="Отмена"></div>
        </form>  
    </div>
        <script src="jquery.js"></script>
        <script src="bootstrap.js"></script>
        <script src="cookie.js"></script>
        <script src="script.js"></script>
    </body>
</html>