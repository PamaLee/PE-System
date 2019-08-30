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

$location = "../";
include_once "../functions.php";
include_once "../verb.php";
session_start();
//导出表格
//header("Content-type:application/vnd.ms-excel");
//header("Content-Disposition:attachment;filename=test.xls");
?>
<div class="mdui-row">
    <div style="padding-top: 75px">
        <div class="mdui-container">
            <?php
            $grade = $_SESSION['info']['grade'];
            $class = $_SESSION['info']['class'];
            $school = $_SESSION['info']['school'];
            $test_num = get_newest_test($school,$grade);
            $test = link_admin()->query("select * from test_name where school='$school' and grade='$grade'");
            echo "测试:<select class=\"mdui-select\" mdui-select=\"{position: 'bottom'}\" name=\"grade\" id=\"grade\">";
            if ($test->num_rows == 1) {
                $testes = link_admin()->query("select * from test_name where school='$school' and grade='$grade'");
                $test_infos = $testes->fetch_array();
                $test_name=$test_infos['name'];
                $test_u=$test_infos['num'];
                ?>
                <option value="<? echo $test_u;?>"><? echo $test_name; ?></option>
            <?php

            }
            if ($test->num_rows > 1) {
                $test_name = $test;
                foreach ($test_name as $v) {
                    ?>
                    <option value="<?php echo $v['num']; ?>"><?php echo $v['name']; ?></option>
                    <?php
                }
            }
            echo "</select>";
            echo "<button class=\"mdui-btn mdui-color-theme-accent mdui-ripple\" onclick='chose()'>查看</button>";
            ?>
            <script>
                function chose() {
                    var datas = document.getElementById("grade").value;
                    window.location.href = "http://localhost/PE-System/index.php?grade=" + datas + "#tab2";
                }
            </script>
            <div class="mdui-table-fluid">
                <?php
                //如果存在grade参数
                if (isset($_GET['grade'])) {
                    $te = $_GET['grade'];
                    $num = link_admin()->query("select * from test_res where school='$school' and grade='$grade' and class='$class' and test_num='$te'")->num_rows;
                    if ($num == 0) {
                        echo "<div class='mdui-text-center'><h2 class='mdui-text-color-pink' id='1'>对不起,暂无测试数据!</h2></div></div></div></div></div>";
                        return false;
                    }
                } else {
                    $num = link_admin()->query("select * from test_res where school='$school' and grade='$grade' and class='$class' and  test_num='$test_num'")->num_rows;
                    if ($num == 0) {
                        echo "<div class='mdui-text-center'><h2 class='mdui-text-color-pink' id='2'>对不起,暂无测试数据!</h2></div></div></div></div></div>";
                        return false;
                    }
                }


                if ($test_num == false) {
                    echo "<div class='mdui-text-center'><h2 class='mdui-text-color-pink' id='3'>对不起,暂无测试数据!";
                    echo "</h2></div></div></div></div></div>";
                } else {
                    if (isset($_GET['grade'])) {
                        $te = $_GET['grade'];
                        $info = link_admin()->query("select * from test_name where school='$school' and num='$te'")->fetch_array()['name'];
                    } else {
                        $info = link_admin()->query("select * from test_name where school='$school' and num='$test_num'")->fetch_array()['name'];
                    }
                    echo "<div class='mdui-text-color-pink mdui-text-center' style='font-size: 25px;padding-top: 20px'>$info</div>";
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
                    $grade=$_SESSION['info']['grade'];
                    $school=$_SESSION['info']['school'];
                    $class=$_SESSION['info']['class'];
                    if (isset($_GET['grade'])) {
                        $te = $_GET['grade'];
                        $rs = link_admin()->query("select * from student where school='$school' and grade='$grade' and class='$class' ORDER BY `study_hao` ASC");
                    } else {
                        $rs = link_admin()->query("select * from student where school='$school' and grade='$grade' and class='$class'  ORDER BY `study_hao` ASC");
                    }
                    foreach ($rs as $to) {
                        $name=$to['name'];
                        $uid=$to['uid'];
                        if (isset($_GET['grade'])) {
                            $te = $_GET['grade'];
                            $res=link_admin()->query("select * from test_res where school='$school' and grade='$grade' and class='$class' and uid='$uid' and test_num='$te' order by study_hao ASC")->fetch_array();
                        } else {
                            $res=link_admin()->query("select * from test_res where school='$school' and grade='$grade' and class='$class' and uid='$uid' and test_num='$test_num' order by study_hao ASC")->fetch_array();
                        }
                        $names = $to['name'];
                        $sex = $to['sex'];
                        if ($sex == 0) {
                            $sex = "女";
                        } else {
                            $sex = "男";
                        }
                        $study_hao = $to['study_hao'];
                        $shortrun = $res['short_run_sc'];
                        $longrun = $res['long_run_sc'];
                        $choose_sc = $res['choose_sc'];
                        $choose_what = $res['choose_what'];
                        if (!empty($choose_what)){
                            $choose_name = get_choose_name($choose_what);
                        }else{
                            $choose_name= "缺失";
                        }

                        if (empty($shortrun)){
                            $shortrun="缺失";
                        }
                        if (empty($longrun)){
                            $longrun="缺失";
                        }
                        if (empty($choose_sc)){
                            $choose_sc="缺失";
                        }



                        if (!empty($shortrun) and !empty($longrun) and !empty($choose_sc)){
                            $zong=$shortrun+$longrun+$choose_sc;
                            if ($shortrun=="缺失" or $longrun=="缺失" or $choose_sc=="缺失"){
                                $zong="正在统计";
                            }
                        }else{
                            $zong="正在统计";
                        }

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
}

                ?>
                </tbody>
                </table>
            </div>
        </div>
    </div>
</div>





