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
 * 創建時間：上午7:02
 * 所屬項目名稱：PE-System
 */

$location = '../';
$title = '管理员控制台';
include_once "../functions.php";
include_once "verb.php";
include_once "../hearder.php";
include_once "../functions_layout.php";
?>
<div class="mdui-appbar">
    <div class="mdui-toolbar mdui-color-theme">
        <a href="javascript:var inst = new mdui.Drawer('#menu', 'swipe=true'); inst.open();"
           class="mdui-btn mdui-btn-icon"><i class="mdui-icon material-icons">menu</i></a>
        <a href="javascript:;" class="mdui-typo-headline">ADMIN</a>
        <a href="javascript:;" class="mdui-typo-title">控制台</a>
        <div class="mdui-toolbar-spacer"></div>
        <a href="javascript:;" class="mdui-btn mdui-btn-icon"><i class="mdui-icon material-icons">refresh</i></a>
        <a href="javascript:;" class="mdui-btn mdui-btn-icon"><i class="mdui-icon material-icons">more_vert</i></a>
    </div>

    <div class="mdui-drawer" id="menu">
        <ul class="mdui-list">
            <li class="mdui-subheader">菜单</li>
            <li class="mdui-list-item mdui-ripple" onclick="window.location.href='./index.php'">
                <i class="mdui-list-item-icon mdui-icon material-icons">desktop_mac</i>
                <div class="mdui-list-item-content">控制台主页</div>
            </li>
            <li class="mdui-list-item mdui-ripple" onclick="window.location.href='./index.php?t=student'">
                <i class="mdui-list-item-icon mdui-icon material-icons">account_circle</i>
                <div class="mdui-list-item-content">学生管理</div>
            </li>
            <li class="mdui-list-item mdui-ripple" onclick="window.location.href='./index.php?t=teacher'">
                <i class="mdui-list-item-icon mdui-icon material-icons">account_box</i>
                <div class="mdui-list-item-content">教师管理</div>
            </li>
            <li class="mdui-list-item mdui-ripple" onclick="window.location.href='./index.php?t=test'">
                <i class="mdui-list-item-icon mdui-icon material-icons">assignment</i>
                <div class="mdui-list-item-content">测试管理</div>
            </li>
            <li class="mdui-list-item mdui-ripple" onclick="window.location.href='./index.php?t=re_test'">
                <i class="mdui-list-item-icon mdui-icon material-icons">border_color</i>
                <div class="mdui-list-item-content">更改测试成绩</div>
            </li>
            <li class="mdui-list-item mdui-ripple" onclick="window.location.href='./index.php?t=board'">
                <i class="mdui-list-item-icon mdui-icon material-icons">email</i>
                <div class="mdui-list-item-content">发布年级公告</div>
            </li>

        </ul>
    </div>
</div>

<div class="mdui-container" style="padding-top: 20px">
    <?php
    if (!isset($_GET['t'])) {
        include_once "app/spawn.php";
    } elseif (isset($_GET['t']) and $_GET['t'] == "student") {
        include_once "app/student.php";
    } elseif (isset($_GET['t']) and $_GET['t'] == "teacher") {
        include_once "app/teacher.php";
    } elseif (isset($_GET['t']) and $_GET['t'] == "test") {
        include_once "app/test.php";
    }
    ?>
</div>





