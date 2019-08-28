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
