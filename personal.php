<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="bootstrap.css">
        <?
        $id = $_GET['id'];
        $con = mysqli_connect('localhost','root','','mydb');
        $query = mysqli_query($con, 'SELECT * FROM `students` WHERE `id`='.$id);
        $student = mysqli_fetch_row($query);
        $statquery = mysqli_query($con, 'SELECT * FROM `statistic` WHERE `student`='.$id);
        $statcount = mysqli_num_rows($statquery);
        ?>
        <title>Баланс школьника <?echo $student[1]?></title>
    </head>
    <body style="background-color: palegoldenrod">
    <div class="row">
    <div class="col" style="height: 100px;">
    <h6>Баланс школьника <?echo $student[1]?></h6>
    </div>
    <div class="col">
        <a href="index.php"><h5>Все школьники</h5></a>
    </div>
    </div>
    <div class="container-fluid">
        <div class="row" style="background-color: mediumspringgreen">
            <div class="col">
                <label>id</label>
            </div>
            <div class="col-7">
                <label>Фамилия и имя</label>
            </div>
            <div class="col">
                <label>Баланс</label>
            </div>
        </div>
    </div>
        <div class="row" style="height:20px; background-color: mediumspringgreen"></div>
        <div class="container-fluid">
        <?
                        
                    
            if ($student[2]<50)
            {
                $warning='style="color: red"';
            }
            echo('<div class="row" style="background-color: lightgreen"><div class="col"><label>'.$student[0].'</label></div><div class="col-7">'.$student[1].'</div><div class="col" '.$warning.'>'.$student[2].'</div></div>');
                      
        ?>
        </div>
        <h6 style="margin-top: 100px">Статистика: </h6>
        <div class="container-fluid" style="margin-top: 20px">
            <div class="row justify-content-start" style="background-color: mediumspringgreen">
                <div class="col">
                    <label>№ операции</label>
                </div>
                <div class="col">
                    <label>Операция</label>
                </div>
            </div>
            <?  
                for ($i=0; $i<$statcount; $i++)
                {
                    if (($i % 2) == 0)
                                {
                                    $color_line = "lightgreen";
                                } else
                                {
                                    $color_line = "mediumspringgreen";
                                }
                    $row = mysqli_fetch_row($statquery);
                    echo('<div class="row justify-content-start" style="background-color: '.$color_line.'"><div class="col">'.($i+1).'</div><div class="col">'.$row[1].'</div></div>');
                }
            ?>
        </div>
    </body>
</html>