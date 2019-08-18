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
 * 創建時間：上午9:04
 * 所屬項目名稱：PE-System
 */

$location="../";
include "../functions.php";
include_once "../verb.php";
session_start();

?>
<div class="mdui-row">
    <div style="padding-top: 75px">
        <div class="mdui-container">
<div class="mdui-table-fluid">
        <?php
        $school=$_SESSION['school'];
        $test_num=get_newest_test($school);
        if ($test_num==false){
            echo "<div class='mdui-text-center'><h2 class='mdui-text-color-pink'>对不起,暂无测试数据!</h2></div>";
        }else{
            echo "<table class=\"mdui-table mdui-table-hoverable\">
        <thead>
        <tr>
            <th>学号</th>
            <th>姓名</th>
            <th>性别</th>
            <th>50米成绩</th>
            <th>长跑成绩</th>
            <th>选项类型</th>
            <th>选项成绩</th>
            <th>总成绩</th>
        </tr>
        </thead>
        <tbody>";
        }
            $rs=link_admin()->query("select * from test_res where school='$school' and test_num='$test_num' ORDER BY `study_hao` ASC");

        foreach ($rs as $res) {
            $name = $res['name'];
            $sex = $res['sex'];
            if ($sex == 0) {
                $sex = "女";
            } else {
                $sex = "男";
            }
            $study_hao = get_info($school, $name)['study_hao'];
            $shortrun = $res['short_run_sc'];
            $longrun = $res['long_run_sc'];
            $choose_what = $res['choose_what'];
            $choose_sc = $res['choose_sc'];
            $zong = $res['zong_res'];
            $choose_name = get_choose_name($choose_what);
            echo "<tr>
            <td>" . $study_hao . "</td>
            <td>" . $name . "</td>
            <td>$sex</td>
            <td>$shortrun</td>
            <td>$longrun</td>
            <td>$choose_name</td>
            <td>$choose_sc</td>
            <td>$zong</td>
        </tr>";
        }
        ?>
        </tbody>
    </table>
</div>
        </div>
    </div>
</div>