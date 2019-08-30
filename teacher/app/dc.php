<?php
/**
 * ___                      ___  _      _                   _
 * | _ \ __ _  _ __   __ _  | _ \(_) __ | |_   __ _  _ _  __| |
 * |  _// _` || '  \ / _` | |   /| |/ _|| ' \ / _` || '_|/ _` |
 * |_|  \__,_||_|_|_|\__,_| |_|_\|_|\__||_||_|\__,_||_|  \__,_|
 * 作者：Pama Richard - 李嘉珂
 * QQ：1249072779
 * 郵箱：pama@lfdevs.com
 * 如果遇到問題，請使用郵箱聯繫
 *
 * //======關於這個文件=======
 * 創建時間：下午2:25
 * 所屬項目名稱：PE-System
 */


session_start();
$location="../../";
include_once "../../functions.php";

$school=$_SESSION['info']['school'];
$grade=$_SESSION['info']['grade'];
$class=$_SESSION['info']['class'];
$school_name=get_school_name_by_school_num($school);

    $time=date("Y-m-d")."-".$school_name;
    header('Content-type: text/html; charset=utf-8');

    header("Content-type:application/vnd.ms-excel");

    header("Content-Disposition:filename=".$class."班-".$time.".xls");


link_admin()->query("SET NAMES utf8mb4");

$sql = "SELECT * FROM test_res where school='$school' and grade='$grade' and class='$class' order by study_hao ASC";

$result = link_admin()->query($sql);

//这里增加表头
$filename = array("学号","名字","短跑","长跑","选项","选项类型","短跑成绩","长跑成绩","选项成绩","总分");
foreach ($filename as $key => $value) {
    $name=$value;
    echo $name."\t";
}
//Excel表格换行
echo "\n";

if ($result->num_rows > 0) {
    while($row = mysqli_fetch_array($result)) {
        $uid=$row['uid'];
        $choose_name=get_choose_name($row['choose_what']);
        $zong=$row['short_run_sc']+$row['long_run_sc']+$row['choose_sc'];
        echo $students['study_hao']."\t".$students['name']."\t".$row['short_run_res']."\t".$row['long_run_res']."\t".$row['choose_res']."\t".$choose_name."\t".$row['short_run_sc']."\t".$row['long_run_sc']."\t".$row['choose_sc']."\t".$zong."\t\n";
    }
}else{
    echo "没有查询数据!";
}

link_admin()->close();