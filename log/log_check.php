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
$location = "../";
session_start();
include "../functions.php";
include_once "verb.php";
sleep(1);
if (!isset($_GET['username'])) {
    return false;
} else {
    $username = $_GET['username'];
    $pwd = $_GET['pwd'];
    $who = $_GET['who'];
    $school = $_GET['school'];
    if ($who == 'student') {
        $schools = link_admin()->query("select * from school where name='$school'")->fetch_assoc()['uid'];
        $num = link_admin()->query("select * from student where school='$schools' and  name='$username' and pwd='$pwd'")->num_rows;
        if ($num > 0) {
            $info = link_admin()->query("select * from student where school='$schools' and name='$username'")->fetch_array();
            $first_login = $info['first_time_login'];
            if ($first_login == 0) {
                $_SESSION['username_check'] = $username;
                $_SESSION['who_check'] = "student";
                $_SESSION['school_check'] = $schools;
                $_SESSION['info'] = get_info($schools, $username);
                $last_login = date("Y-m-d H:i:s");
                link_admin()->query("UPDATE `student` SET last_login='$last_login' where name='$username' and school='$schools'");
                link_admin()->query("UPDATE `student` SET login_time=login_time+1 where name='$username' and school='$schools'");
                echo "topwd";
                return true;
            } else {
                $_SESSION['username'] = $username;
                $_SESSION['who'] = "student";
                $_SESSION['school'] = $schools;
                $_SESSION['info'] = get_info($schools, $username);
                $last_login = date("Y-m-d H:i:s");
                link_admin()->query("UPDATE `student` SET last_login='$last_login' where name='$username' and school='$schools'");
                link_admin()->query("UPDATE `student` SET login_time=login_time+1 where name='$username' and school='$schools'");
                echo "tospawn";
                return true;
            }
        } else {
            echo "false";
            return false;
        }
    } elseif ($who == "teacher") {
        $schools = link_admin()->query("select * from school where name='$school'")->fetch_assoc()['uid'];
        $num = link_admin()->query("select * from teacher where school='$schools' and  name='$username' and pwd='$pwd'")->num_rows;
        if ($num > 0) {
            link_admin()->query("UPDATE `teacher` SET login_time=login_time+1 where name='$username' and school='$schools'");
            $info = link_admin()->query("select * from teacher where school='$schools' and name='$username'")->fetch_array();
            echo "toteacher";
            $_SESSION['username'] = $username;
            $_SESSION['info'] = $info;
            $_SESSION['who'] = "teacher";
            return true;
        } else {
            return false;
        }
    } elseif ($who == "admin") {
        $schools = link_admin()->query("select * from school where name='$school'")->fetch_assoc()['uid'];
        $num = link_admin()->query("select * from admin where school='$schools' and name='$username' and pwd='$pwd'")->num_rows;
        if ($num > 0) {
            $info = link_admin()->query("select * from admin where school='$schools' and name='$username'")->fetch_array();
            link_admin()->query("UPDATE `admin` SET login_time=login_time+1 where name='$username' and school='$schools'");
            echo "toadmin";
            $_SESSION['username'];
            $_SESSION['who'] = "admin";
            $_SESSION['info'] = $info;
            return true;
        }
    }
}

