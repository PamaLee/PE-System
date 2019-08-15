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
 * 創建時間：下午1:12
 * 所屬項目名稱：PE-System
 */

include_once "../db.php";
session_start();
if (!isset($_GET['pwd'],$_GET['repwd'])){
    echo 'false';
    return false;
}else{
    $pwd=$_GET['pwd'];
    $repwd=$_GET['repwd'];
    if ($pwd!=$repwd){
        echo "false";
        return false;
    }else{
        $name=$_SESSION['username_check'];
        $school=$_SESSION['school_check'];
        $sql=link_admin()->query("UPDATE student set pwd='$repwd' where name='$name' and school='$school'");
        $sql_check=link_admin()->query("UPDATE student set pwd_check='1' where name='$name' and school='$school'");
        $first_login=link_admin()->query("UPDATE student set first_time_login='1' where name='$name' and school='$school'");
        if ($sql and $sql_check and $first_login){
            session_unset();
            session_destroy();

            session_start();
            $_SESSION['username']=$name;
            $_SESSION['school']=$school;
            $_SESSION['who']="student";
            echo "true";
            return true;
        }else{
            echo "false";
            return false;
        }
}
    }

