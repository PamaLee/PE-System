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
 * 創建時間：上午9:01
 * 所屬項目名稱：PE-System
 */

sleep(2);
session_start();
if (!isset($_GET['username'])){
    return false;
}else{
    $username=$_GET['username'];
    $pwd=$_GET['pwd'];
    $who=$_GET['who'];
    $school=$_GET['school'];
    include "../db.php";
    if($who=='student'){
        $schools=link_admin()->query("select * from school where name='$school'")->fetch_assoc()['uid'];
        $num=link_admin()->query("select * from student where school='$schools' and  name='$username' and pwd='$pwd'")->num_rows;
        if ($num>0){
            echo "true";
            $_SESSION['username']=$username;
            $_SESSION['who']="student";
            return true;
        }else{
            return false;
        }
    }elseif($who=="teacher"){
        $schools=link_admin()->query("select * from school where name='$school'")->fetch_assoc()['uid'];
        $num=link_admin()->query("select * from teacher where school='$schools' and  name='$username' and pwd='$pwd'")->num_rows;
        if ($num>0){
            echo "true";
            $_SESSION['username']=$username;
            $_SESSION['who']="teacher";
            return true;
        }else{
            return false;
        }
        }
    }

