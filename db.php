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
 * 創建時間：上午8:23
 * 所屬項目名稱：PE-System
 */
//商店数据库
function link_admin()
{
    $user = 'root';
    $password = 'root';
    $db = 'pe';
    $host = '127.0.0.1';
    $port = 3306;

    $link = new mysqli($host, $user, $password, $db, $port);
    return $link;
}

function link_cloud()
{
    //云黑
    $user_cloud = 'root';
    $password_cloud = 'root';
    $db_cloud = 'cloud';
    $host_cloud = '127.0.0.1';
    $port_cloud = 3306;

    $link_cloud = new mysqli($host_cloud, $user_cloud, $password_cloud, $db_cloud, $port_cloud);
    return $link_cloud;
}

