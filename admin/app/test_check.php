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
**/

session_start();
$location = "../../";
include_once "../verb.php";
include_once "../../functions.php";

if (!isset($_GET['rename'], $_GET['name'])) {
    if (isset($_GET['c']) and $_GET['c']=="new"){
        $grade=$_GET['grade'];
        $test_name=$_GET['test_name'];
        $school=$_SESSION['info']['school'];
        $name_if=link_admin()->query("select * from test_name where school='$school' and grade='$grade' and name='$test_name'")->num_rows;
        if ($name_if>0){
            echo "false";
            return false;
        }else{
            $date=date("Y-m-d");
            $test=link_admin()->query("insert into test_name (name, school, grade,date) values ('$test_name','$school','$grade','$date')");
            if ($test){
                $num=link_admin()->query("select * from test_name where school='$school' and grade='$grade' and name='$test_name'")->fetch_array()['num'];
            }else{
                echo "false";
                return false;
            }
            $student=link_admin()->query("select * from student where school='$school' and grade='$grade'");
            foreach ($student as $row){
                $class=$row['class'];
                $uid=$row['uid'];
                $study_hao=$row['study_hao'];
                link_admin()->query("insert into test_res(school, grade, class, uid, study_hao, test_num) values ('$school','$grade','$class','$uid','$study_hao','$num')");
            }
                echo "true";
                return true;
        }
    }
    echo "false";
    return false;
} else {
    $name = $_GET['name'];
    $rename = $_GET['rename'];
    $school = $_SESSION['info']['school'];
    $grade = $_SESSION['info']['grade'];
    $sql = link_admin()->query("update test_name set name='$name' where name='$rename' and grade='$grade' and school='$school'");
    if ($sql) {
        echo "true";
        return true;
    } else {
        echo "false";
        return false;
    }

}
