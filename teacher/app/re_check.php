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
 * 創建時間：上午11:33
 * 所屬項目名稱：PE-System
 */

session_start();
$location = "../../";
include_once "../verb.php";
include_once "../../functions.php";

if (!isset($_GET['rename'], $_GET['name'], $_GET['class'], $_GET['reclass'], $_GET['sex'], $_GET['study_hao'])) {
    echo "false3";
    return false;
} else {
    $name = $_GET['name'];
    $rename = $_GET['rename'];
    $class = $_GET['class'];
    $reclass = $_GET['reclass'];
    $sex = $_GET['sex'];
    $study_hao = $_GET['study_hao'];
    $school = $_SESSION['info']['school'];
    $grade = $_SESSION['info']['grade'];
    if ($sex == "男") {
        $sex = 1;
    } else {
        $sex = 0;
    }
    if (!is_numeric($class) or !is_numeric($reclass) or !is_numeric($grade)) {
        echo "false1";
        return false;
    }

    $sql = link_admin()->query("update student set name='$name',sex='$sex', study_hao='$study_hao',class='$class' where name='$rename' and class='$reclass' and grade='$grade' and school='$school'");
    if ($sql) {
        echo "true";
        return true;
    } else {
        echo "false2";
        return false;
    }

}