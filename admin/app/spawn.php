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
 * 創建時間：上午7:50
 * 所屬項目名稱：PE-System
 */

?>

<div class="mdui-row">
    <div class="mdui-col-md-6 mdui-col-offset-md-3 mdui-text-center" style="padding-bottom: 20px">
        <div class="mdui-card">
            <h2><?php echo get_school_name_by_school_num($_SESSION['info']['school']) ?></h2>
            <h3><?php echo $_SESSION['info']['grade'] ?>年级</h3>
        </div>

    </div>
    <div class="mdui-col-xs-6">
        <div class="mdui-card mdui-text-center">
            <h2 class="mdui-color-pink">数据统计</h2>
            <h3>总学生数:<?php echo get_student_num($_SESSION['info']['school'], $_SESSION['info']['grade']) ?>人</h3>
            <h3>总教师数:<?php echo get_teacher_num($_SESSION['info']['school'], $_SESSION['info']['grade']) ?>人</h3>
            <h3>总测试次数:<?php echo get_test_num($_SESSION['info']['school'], $_SESSION['info']['grade']) ?>次</h3>
            <h3>学生总登录次数:<?php echo get_test_num($_SESSION['info']['school'], $_SESSION['info']['grade']) ?>次</h3>
            <h3>教师总登录次数:<?php echo get_teacher_login_time($_SESSION['info']['school'], $_SESSION['info']['grade']) ?>
                次</h3>
            <h3>管理员总登录次数:<?php echo get_test_num($_SESSION['info']['school'], $_SESSION['info']['grade']) ?>次</h3>
        </div>
    </div>
    <div class="mdui-col-xs-6">
        <div class="mdui-card">
            123
        </div>

    </div>
</div>
