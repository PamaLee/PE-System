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
 * 創建時間：上午9:02
 * 所屬項目名稱：PE-System
 */
ini_set("max_execution_time", "1800");
$location = "../";
include_once "../verb.php";
include_once "../functions.php";


?>
<div class="mdui-row">
    <div style="padding-top: 75px">
        <div class="mdui-container">
            <div class="mdui-card">
                <!-- 卡片头部，包含头像、标题、副标题 -->
                <div class="mdui-card-header">
                    <div class="mdui-card-header-title" style="font-size: 20px"><? echo $_SESSION['username'] ?></div>
                    <div class="mdui-card-header-subtitle"><?php echo $_SESSION['info']['grade'] . "年级" . $_SESSION['info']['class'] . "班" ?></div>
                </div>

                <div class="mdui-card-media">

                    <div class="number" style="text-align: center;font-size: <?php
                    $school = $_SESSION['info']['school'];
                    $test = get_newest_test($school);
                    if ($test == false) {
                        echo "20px";
                    } else {
                        echo "300px";
                    }
                    ?>
                            ;color:
                    <?php

                    if ($test == false) {
                        echo "black";
                    } else {
                        $name = $_SESSION['info']['name'];
                        $res = link_admin()->query("select * from test_res where school='$school' and name='$name' and test_num='$test'")->fetch_array();
                        $zong_res = $res['zong_res'];
                        $num = $zong_res;

                        if ($num > 20 and $num < 30) {
                            echo "red";
                        } elseif ($num > 30 and $num < 40) {
                            echo "pink";
                        } elseif ($num > 40 and $num < 50) {
                            echo "blue";
                        } elseif ($num > 50 and $num < 60) {
                            echo "yellow";
                        } elseif ($num == "60") {
                            echo "green";
                        }
                    }


                    ?>">
                        <?php
                        if ($test == false) {
                            echo "当前暂无任何测试成绩";
                            echo "</div></div></div></div></div></div>";
                            return;
                        } else {
                            echo $zong_res;
                        }
                        ?>
                    </div>
                    <?php
                    ?>

                </div>
                <?php
                $name = $_SESSION['username'];
                $school = $_SESSION['school'];
                $test_num = get_newest_test($school);
                $num = link_admin()->query("select * from test_res where name='$name' and school='$school' and test_num='$test_num'")->num_rows;
                $info = link_admin()->query("select * from test_name where school='$school' and num='$test_num'")->fetch_array()['name'];
                if ($num == 0) {
                    echo "<div class='mdui-text-center mdui-color-theme' style='font-size: 25px'>$info</div>";
                    echo "<div class='mdui-text-center mdui-color-pink' style='font-size: 25px'>暂无您最新的考试信息,请等待成绩公布</div></div></div></div>";
                    return;
                }

                ?>

                <div class="mdui-card-primary">
                    <div class="mdui-card-primary-title"><?php
                        $test = get_newest_test($school);
                        if ($test == false) {
                            echo "无测试";
                        } else {
                            $name = link_admin()->query("select * from test_name where num='$test'")->fetch_array()['name'];
                            echo $name;
                        }
                        ?></div><!-- 当前测试成绩的名称 -->
                    <div class="mdui-card-primary-subtitle">时间:<?
                        if ($test == false) {
                            echo "无";
                        } else {
                            $time = link_admin()->query("select * from test_name where num='$test' and school='$school'")->fetch_array();
                            $time = $time['date'];
                            echo $time;
                        }
                        ?></div> <!--  当前测试的时间 -->
                </div>

                <!-- 卡片的内容 -->
                <div class="mdui-card-content" style="font-size: 16px"><?php

                    echo "学校:" . get_school_name_by_school_num($school);

                    echo "<div class=\"mdui-table-fluid\">";
                    echo "<thead>
<table class=\"mdui-table mdui-table-hoverable\">
        <tr>
            <th>50米成绩</th>
            <th>长跑成绩</th>
            <th>" . get_choose_name($_SESSION['info']['choose_what']) . "</th>
            <th>总成绩</th>
        </tr>
        </thead>
        <tbody>";
                    $test_num = get_newest_test($school);
                    $name = $_SESSION['username'];
                    $info = get_test_res($school, $name, $test_num);
                    $short_res = $info['short_run_res'];
                    $long_res = $info['long_run_res'];
                    $choose_res = $info['choose_res'];
                    $short_sc = $info['short_run_sc'];
                    $long_sc = $info['long_run_sc'];
                    $choose = $info['choose_sc'];
                    $zong_res = $info['zong_res'];
                    echo "<tr>
<td>" . fen_to_beautiful("50米", $short_res) . "</td>
<td>" . fen_to_beautiful("长跑", $long_res) . "</td>
<td>" . fen_to_beautiful(get_choose_name($_SESSION['info']['choose_what']), $choose_res) . "</td>
<td>$zong_res</td>
</tr>
</tbody>
";
                    ?>
                    </table>
                </div>
            </div>


        </div>
    </div>
</div>
