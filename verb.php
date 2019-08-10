<?php
/**
 * 作者: Cookie
 * 所有者: https://www.lfdevs.com
 * 日期: 2019/8/10
 * 创建时间: 下午9:50
 */
//验证文件
session_start();
$username=$_SESSION['username'];
//验证登录
if (!isset($username)){
    header("Location:".$lo."log/");//跳转到登录界面
    exit();
}

check_IP(GetIP());
check_user($_SESSION['username']);
//验证是否存在黑名单
//验证是否存在注入行为
if (!empty($_POST)){
    foreach ($_POST as $item){
        if(inject_check($item)==true){
            print "服务端出现错误！正在重启-错误方式:POST传输";
            print "<br>您的IP地址(GET):".IP();
            print "<br>您的IP地址(TCP):".GetIP();
            if (!isset($_SESSION['username'])){
                print "<br>您还没有登录/注册";
                $user=0;
            }else{
                print "<br>您的用户名:".$_SESSION['username'];
                $user=$_SESSION['username'];
            }
            $lo=$loto;
            $do=into_database($loto,GetIP(),$user,"POST",$_POST);
            if ($do==true){
                print "<br>您的IP已经被加入云端黑名单库";
            }else{
                exit("发生错误!您的操作已经被取消!");
            }
            exit();
        }
    }
}elseif(!empty($_GET)){
    foreach ($_GET as $item){
        if(inject_check($item)==true){
            print "服务端出现错误！正在重启-错误方式:GET传输";
            print "<br>您的IP地址(GET):".IP();
            print "<br>您的IP地址(TCP):".GetIP();
            exit();
        }
    }
}
//防止注入
function inject_check($sql_str)
{
    return preg_match('/^select|insert|and|or|create|update|delete|alter|count|\'|\"|\/\*|\*|\.\.\/|\.\/|union|into|load_file|outfile/i', $sql_str); // 进行过滤
}

//获取IP地址
function GetIP(){
    if(!empty($_SERVER["HTTP_CLIENT_IP"])){
        $cip = $_SERVER["HTTP_CLIENT_IP"];
    }
    elseif(!empty($_SERVER["HTTP_X_FORWARDED_FOR"])){
        $cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
    }
    elseif(!empty($_SERVER["REMOTE_ADDR"])){
        $cip = $_SERVER["REMOTE_ADDR"];
    }
    else{
        $cip = "无法获取！";
    }
    return $cip;
}

function IP(){
    if(!empty($_SERVER["HTTP_CLIENT_IP"])){
        $cip = $_SERVER["HTTP_CLIENT_IP"];
    }
    elseif(!empty($_SERVER["HTTP_X_FORWARDED_FOR"])){
        $cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
    }
    elseif(!empty($_SERVER["REMOTE_ADDR"])){
        $cip = $_SERVER["REMOTE_ADDR"];
    }
    else{
        $cip = "无法获取！";
    }
    return $cip;
}

function into_database($lo,$IP, $user, $into_way, $body){
//添加黑名单数据库
    $to=cloud()->query("INSERT INTO `black_list` (`uid`, `IP`, `user`, `into_way`, `body`, `time`) VALUES (NULL, '$IP', '$user', '$into_way', '$body', CURRENT_TIMESTAMP);");
    if ($to){
        return true;
    }else{
        return false;
    }
}

function cloud(){
    $user_cloud = 'root';
    $password_cloud = 'root';
    $db_cloud = 'cloud';
    $host_cloud = '127.0.0.1';
    $port_cloud = 3306;

    $link_cloud = new mysqli($host_cloud,$user_cloud,$password_cloud,$db_cloud,$port_cloud);
    $link_cloud->set_charset("UTF-8");
    return $link_cloud;
}

function check_IP($IP){
    $ip_to=cloud()->query("SELECT * FROM black_list WHERE IP='$IP'");
    $num=$ip_to->num_rows;
    $time=$ip_to->fetch_array()['time'];
    if ($num>0){
        exit("对不起,您在我们的云端黑名单中!加入时间:$time,如有异议,请联系QQ:1249072779");
    }
}

function check_user($username){
    $user_to=cloud()->query("SELECT * FROM black_list WHERE user='$username'");
    $num=$user_to->num_rows;
    $time=$user_to->fetch_array()['time'];
    if ($num>0){
        exit("对不起,您在我们的云端黑名单中!加入时间:$time,如有异议,请联系QQ:1249072779");
    }
}