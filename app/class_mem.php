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
//导出表格
//header("Content-type:application/vnd.ms-excel");
//header("Content-Disposition:attachment;filename=test.xls");
?>
<div class="mdui-row">
    <div style="padding-top: 75px">
        <div class="mdui-container">
            <?php
            $school=$_SESSION['school'];
            $test_num=get_newest_test($school);
            echo "测试:<select class=\"mdui-select\" mdui-select=\"{position: 'bottom'}\" name=\"grade\" id=\"grade\">";
            $test=link_admin()->query("select * from test_name where school='$school'");
            if ($test->num_rows==1){
                $test_name=$test->fetch_array()['name'];
                $test_uid=$test->fetch_array()['num'];
                echo "<option value='$test_uid'>$test_name</option>";
            }
            if ($test->num_rows>1){
                $test_name=$test->fetch_all();
                foreach($test_name as $v){
                    ?>
                    <option value="<?php echo $v[2]; ?>" onclick="chose(<?php echo $v[2];?>)"><?php echo $v[1]; ?></option>
                    <?php
                }
            }
            echo "</select>";
            echo "<button class=\"mdui-btn mdui-color-theme-accent mdui-ripple\" onclick='chose()'>查看</button>";
            ?>
<div class="mdui-table-fluid">
        <?php
        if (isset($_GET['grade'])) {
            $te = $_GET['grade'];
            $num=link_admin()->query("select * from test_res where school='$school' and test_num='$te'")->num_rows;
            if ($num==0){
                echo "<div class='mdui-text-center'><h2 class='mdui-text-color-pink'>对不起,暂无测试数据!</h2></div></div>";
            }
        }else{
            $num=link_admin()->query("select * from test_res where school='$school' and test_num='$test_num'")->num_rows;
            if ($num==0){
                echo "<div class='mdui-text-center'><h2 class='mdui-text-color-pink'>对不起,暂无测试数据!</h2></div></div>";
            }
        }
        if ($test_num==false){
            echo "<div class='mdui-text-center'><h2 class='mdui-text-color-pink'>对不起,暂无测试数据!</h2></div>";
        }else{
            if (isset($_GET['grade'])){
                $te=$_GET['grade'];
                $info=link_admin()->query("select * from test_name where school='$school' and num='$te'")->fetch_array()['name'];
            }else{
                $info=link_admin()->query("select * from test_name where school='$school' and num='$test_num'")->fetch_array()['name'];
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
        }
        if (isset($_GET['grade'])){
            $te=$_GET['grade'];
            $rs=link_admin()->query("select * from test_res where school='$school' and test_num='$te' ORDER BY `study_hao` ASC");
        }else{
            $rs=link_admin()->query("select * from test_res where school='$school' and test_num='$test_num' ORDER BY `study_hao` ASC");
        }


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


<script>
    function chose(){
        var datas=document.getElementById("grade").value;
        window.location.href="http://localhost/PE-System/index.php?grade="+datas+"#tab2";
    }

</script>
            </div>
        </div>
</div>
