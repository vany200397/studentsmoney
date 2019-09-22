<?
    $change_list = $_POST['checked'];
    $operation = $_POST['operation'];
    $summa = $_POST['summa'];
    $length = count($change_list);
    $list_str = '';
    $op = $operation;
    for ($i=0; $i<$length; $i++)
    {
        $item = ($change_list[$i]);
        if ($i!=$length-1) 
        {
            $list_str = $list_str.'id='.$item.' OR ';
        } else{
            $list_str = $list_str.'id='.$item;
        } 
    }
    if ($operation == "Снять")
    {
        $operation = "-";
    }
    if ($operation == "Пополнить")
    {
        $operation = "+";
    }
    $con = mysqli_connect('localhost','root','','mydb');
    $query = mysqli_query($con, 'UPDATE `students` SET `money`=`money`'.$operation.$summa.' WHERE '.$list_str);
    $query = mysqli_query($con, 'SELECT `money` FROM `students`');
    $count = mysqli_num_rows($query);
    for ($i=0; $i<$count; $i++)
    {
        $row = mysqli_fetch_row($query);
        $newmoney[$i] = $row[0];
    }
    $op = intval($operation.$summa);
    for ($i=0; $i<$length; $i++)
    {
        $query = mysqli_query($con,'INSERT INTO `statistic` (`operation`,`student`) VALUES('.$op.','.$change_list[$i].')');
    }
    echo (json_encode($newmoney));
?>