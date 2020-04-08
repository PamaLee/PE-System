<!DOCTYPE html>
<html lang="cn">
<!--
 *  ___                      ___  _      _                   _
 * | _ \ __ _  _ __   __ _  | _ \(_) __ | |_   __ _  _ _  __| |
 * |  _// _` || '  \ / _` | |   /| |/ _|| ' \ / _` || '_|/ _` |
 * |_|  \__,_||_|_|_|\__,_| |_|_\|_|\__||_||_|\__,_||_|  \__,_|
 * 作者：Pama Richard - 李嘉珂
 * QQ：1249072779
 * 郵箱：pama@lfdevs.com
 * 如果遇到問題，請使用郵箱聯繫
 *
 * 感谢以下开源项目对我们的支持:
    MDUI
 * //======關於這個文件=======
 * 創建時間：上午8:23
 * 所屬項目名稱：PE-System
 */
-->
<head>
    <meta charset="UTF-8">
    <meta name="baidu-site-verification" content="i84EPDsByV" />
    <link rel="stylesheet" href="<? echo $location ?>/public/css/mdui.css">
    <script src="<? echo $location ?>/public/js/mdui.js"></script>
    <script src="https://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
    <link rel="shortcut icon" href="<? echo $location ?>/photos/ico.ico" type="image/x-icon">
    <link rel="stylesheet" href="<? echo $location ?>/public/css/jquery.msgBox.min.css">
    <script src="<? echo $location ?>/public/js/jquery.msgBox.min.js"></script>
    <style>
        @font-face {
            font-family: 'Number';   /*字体名称*/
            src: url('public/fonts/blipper.ttf');       /*字体源文件*/
        }
        @font-face {
            font-family: "Chinese";
            src: url("public/fonts/Chinese.ttf");
        }
        .number {
            font-family: "Number";
        }
        .chinese {
            font-family: "Chinese";
        }
    </style>
    <script>
        (function(){
            var bp = document.createElement('script');
            var curProtocol = window.location.protocol.split(':')[0];
            if (curProtocol === 'https') {
                bp.src = 'https://zz.bdstatic.com/linksubmit/push.js';
            }
            else {
                bp.src = 'http://push.zhanzhang.baidu.com/push.js';
            }
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(bp, s);
        })();
    </script>

    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no">
    <title>体育系统——<?php echo $title ?></title>
</head>
<body class="mdui-theme-primary-indigo mdui-theme-accent-pink mdui-theme-layout-light mdui-bottom-nav-fixed
<?
session_start();
if (isset($_SESSION['info']) and $_SESSION['who']=="admin"){
    echo " mdui-drawer-body-left ";
}elseif (isset($_SESSION['info']) and $_SESSION['who']=="teacher"){
    echo " mdui-drawer-body-left ";
}
?>">