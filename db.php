<?php
/**
 * Created by PhpStorm.
 * User: cookie
 * Date: 2018/9/24
 * Time: 下午2:20
 */
//商店数据库
function link_admin(){
    $user = 'root';
    $password = 'root';
    $db = 'pe';
    $host = '127.0.0.1';
    $port = 3306;

    $link = new mysqli($host,$user,$password,$db,$port);
    return $link;
}

function link_cloud(){
    //云黑
    $user_cloud = 'root';
    $password_cloud = 'root';
    $db_cloud = 'cloud';
    $host_cloud = '127.0.0.1';
    $port_cloud = 3306;

    $link_cloud = new mysqli($host_cloud,$user_cloud,$password_cloud,$db_cloud,$port_cloud);
    return $link_cloud;
}

