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
 * 創建時間：下午9:22
 * 所屬項目名稱：PE-System
 */

session_start();
$location = "../../";
include_once "../verb.php";
include_once "../../functions.php";

if (!isset($_GET['rename'], $_GET['name'], $_GET['class'], $_GET['reclass'])) {
    echo "false";
    return false;
} else {
    $name = $_GET['name'];
    $rename = $_GET['rename'];
    $class = $_GET['class'];
    $reclass = $_GET['reclass'];
    $school = $_SESSION['info']['school'];
    $grade = $_SESSION['info']['grade'];
    $pwd=md5($_GET['pwd']);
    if (!is_numeric($class) or !is_numeric($reclass)) {
        echo "false";
        return false;
    }
    $sql = link_admin()->query("update teacher set name='$name',class='$class',pwd='$pwd' where name='$rename' and grade='$grade' and school='$school' and class='$reclass'");
    if ($sql) {
        echo "true";
        return true;
    } else {
        echo "false";
        return false;
    }

}