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
 * 創建時間：2019-08-16-17:15
 * 所屬項目名稱：PE-System
 */

$location = "../";
$title = "成绩分析";
include_once "../hearder.php";
include_once "../functions.php";


?>

<div class="mdui-container">
    <div class="mdui-row" style="padding-top: 75px">
        <div class="mdui-text-center" style="padding-bottom: 10px;font-size: 20px"><h2><?php
                echo $_SESSION['username'];
                ?></h2></div>
        <div class="mdui-col-xs-6">
            <div class="mdui-card mdui-text-center">
                <h3>身体状况(<?php
                    if ($_SESSION['info']['sex'] == 1) {
                        echo "男";
                    } else {
                        echo "女";
                    }
                    ?>)</h3>

                <div class="mdui-table-fluid">
                    <table class="mdui-table mdui-table-hoverable">
                        <thead>
                        <tr>
                            <th>身高</th>
                            <th>体重</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><? echo $_SESSION['info']['high'] . "cm" ?></td>
                            <td><? echo $_SESSION['info']['weight'] . "kg" ?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>

            </div>
            <br>
            <div class="mdui-card mdui-text-center">
                <h3>建议标准(<?php
                    if ($_SESSION['info']['sex'] == 1) {
                        echo "男";
                    } else {
                        echo "女";
                    }
                    ?>)</h3>

                <div class="mdui-table-fluid">
                    <table class="mdui-table mdui-table-hoverable">
                        <thead>
                        <tr>
                            <th>身高</th>
                            <th>体重</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><? echo $_SESSION['info']['high'] . "cm" ?></td>
                            <td><? echo math_height_to_weight($_SESSION['info']['sex'], $_SESSION['info']['high']) . "kg" ?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="mdui-col-xs-6">
            <div class="mdui-card mdui-text-center">
                <h3><?php
                    $school = $_SESSION['school'];
                    $grade=$_SESSION['info']['grade'];
                    $test_num = get_newest_test($school,$grade);
                    $name = link_admin()->query("select * from test_name where school='$school' and num='$test_num'")->fetch_array()['name'];
                    echo $name;
                    ?></h3>
                <h4>(上次成绩)->(本次成绩)</h4>
                <?php
                if ($second = get_second_test($_SESSION['school']) != false) {
                    $newest = get_newest_test($school,$grade);
                    $username = $_SESSION['username'];
                    $uid=$_SESSION['info']['uid'];
                    if (link_admin()->query("select * from test_res where school='$school' and test_num='$newest' and uid='$uid'")->num_rows == 0) {
                        if (link_admin()->query("select * from test_res where school='$school' and test_num='$second' and uid='$uid'")->num_rows == 0) {
                            echo "<h3 class='mdui-color-pink'>对不起,暂时没有您的成绩信息</h3>";
                        } else {
                            $info = link_admin()->query("select * from test_res where school='$school' and test_num='$newest' and uid='$uid'")->fetch_array();
                            $choose = get_choose_name($info['choose_what']);
                            echo "<h4>考试选项($choose):</h4>
                <h4 class=\"mdui-text-color-red\">" . fen_to_beautiful($info['choose_what'], 12) . "</h4>
                <h4>短跑:</h4>
                <h4 class=\"mdui-text-color-red\"></h4>
                <h4>长跑:</h4>
                <h4 class=\"mdui-text-color-red\"></h4>";
                        }

                    } else {

                    }
                }
                ?>

            </div>

        </div>
    </div>
</div>
