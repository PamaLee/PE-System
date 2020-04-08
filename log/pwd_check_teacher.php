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
 * 創建時間：下午3:31
 * 所屬項目名稱：PE-System
 */

session_start();
$location = "../";
include_once "../functions.php";
include_once "verb.php";
if (!isset($_GET['pwd'], $_GET['repwd'])) {
    echo 'false';
    return false;
}else{
    $pwd = $_GET['pwd'];
    $repwd = $_GET['repwd'];
    if ($pwd != $repwd) {
        echo "false";
        return false;
    }else{
        $repwd=md5($repwd);
        $name = $_SESSION['username_check'];
        $school = $_SESSION['school_check'];
        $sql = link_admin()->query("UPDATE teacher set pwd='$repwd' where name='$name' and school='$school'");
        $first_login = link_admin()->query("UPDATE teacher set first_time_login='1' where name='$name' and school='$school'");
        if ($sql and $first_login) {
            session_unset();
            session_destroy();

            session_start();
            $_SESSION['username'] = $name;
            $_SESSION['school'] = $school;
            $info=link_admin()->query("select * from teacher where school='$school' and name='$name'")->fetch_array();
            $_SESSION['info'] = $info;
            $_SESSION['who'] = "teacher";
            echo "true";
            return true;
        } else {
            echo "false";
            return false;
        }
    }
}

