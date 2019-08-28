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
 * 創建時間：下午10:36
 * 所屬項目名稱：PE-System
 */

$location="../../";
include_once "../../functions.php";
session_start();
include_once "../verb.php";
if (isset($_GET['title'],$_GET['body'])){
    $school=$_SESSION['info']['school'];
    $grade=$_SESSION['info']['grade'];
    $id=$_SESSION['info']['id'];
    $title=$_GET['title'];
    $body=$_GET['body'];
    $sql=link_admin()->query("INSERT INTO `board` (`uid`, `school`, `grade`, `admin`, `body`, `title`, `time`) VALUES (NULL, '$school', '$grade', '$id', '$body', '$title', CURRENT_TIMESTAMP);");
    if ($sql){
        echo "true";
        return true;
    }else{
        echo "false";
        return false;
    }
}else{
    echo "false";
    return false;
}