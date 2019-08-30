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
 * 創建時間：下午9:36
 * 所屬項目名稱：PE-System
 */

session_start();
$location = "../../";
$title = "测试管理";
include_once "../../functions.php";
$school = $_SESSION['info']['school'];
$grade = $_SESSION['info']['grade'];


?>

<?php

if (isset($_GET['c']) and $_GET['c'] == 'xl') {
    include_once "xl.php";
    return false;
}

if (isset($_GET['c']) and $_GET['c']=="daochu"){
    header("Location:app/dc.php?&test=".$_GET['test']);
    return false;
}
?>


<div class="mdui-table-fluid">
    <table class="mdui-table mdui-table-hoverable">
        <?php
        echo " <thead>
        <tr>
            <th>名称</th>
            <th>序号</th>
            <th>日期</th>
            <th>本班拥有成绩的同学</th>
            <th>操作</th>
        </tr>
        </thead>";
        echo "<tbody>";
        $test = link_admin()->query("select * from test_name where school='$school' and grade='$grade'");

        $class = $_SESSION['info']['class'];

        foreach ($test as $row) {
            if ($row['first_time_login'] == 0) {
                $first = "否";
            } else {
                $first = "是";
            }
            $nums = $row['num'];
            $numnum=get_isset_class_chengji_student($school,$grade,$nums,$class);
            echo "<tr>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['num'] . "</td>";
            echo "<td>" . $row['date'] . "</td>";
            echo "<td>" . $numnum . "</td>";
            $name = $row['name'];
            $num = $row['num'];
            echo "<td><button class='mdui-btn mdui-color-theme-accent mdui-ripple' onclick=\"re('$name')\">修改/录入</button>  <button class='mdui-btn mdui-color-theme-accent mdui-ripple' onclick=\"daochu('$num')\">导出</button></td>";
        }

        echo "</tbody>";

        ?>

    </table>
</div>
<?php
if (isset($_GET['test'])) {
    $name = $_GET['test'];
    $infoes = link_admin()->query("select * from test_name where school='$school' and grade='$grade' and name='$name'")->fetch_array();
}


?>
<div class="mdui-dialog mdui-color-theme" id="re">
    <div class="mdui-container mdui-color-white mdui-dialog-content">
        <div class="mdui-textfield mdui-textfield-floating-label">
            <i class="mdui-icon material-icons">account_box</i>
            <label class="mdui-textfield-label">名称</label>
            <input class="mdui-textfield-input" type="text" value="<?php echo $infoes['name']; ?>" required
                   name="username" id="username"/>
        </div>
        <button class="mdui-btn mdui-color-theme-accent mdui-ripple" id="submit" onclick="que()">确定</button>
        <button class="mdui-btn mdui-color-theme-accent mdui-ripple" onclick="inst.close();history.go(-2);">取消</button>

    </div>
</div>

<script>
    function check() {
        var clases = document.getElementById("class").value;
        window.location.href = "./index.php?t=test&class=" + clases;
    }

    function funs(test) {
        mdui.confirm('您确定删除这个测试吗?', function () {
            mdui.alert(window.location.href);
            var urls = window.location.href.replace("#mdui-dialog", "");
            window.location.href = urls + "&c=del&test=" + test;
        });
    }

    function re(test) {
        mdui.confirm('您确定进入修改/录入测试的成绩吗?', function () {
            mdui.alert(window.location.href);
            var urls = window.location.href.replace("#mdui-dialog", "");
            window.location.href = urls + "&c=xl&test=" + test;
        });
    }

    function que() {
        var username = $("#username").val();
        var classes = $("#classes").val();
        $("#submit").attr("disabled", "true");
        document.getElementById("submit").innerHTML = "修改中...";
        $.ajax({
            type: "GET",
            url: "app/test_check.php",
            data: "rename=<?echo $_GET['test']?>&name=" + username,
            success: function (data) {
                if (data.indexOf("服务端出现错误") != -1) {
                    document.write("<h1>" + data + "</h1>");
                }
                if (data) {
                    mdui.snackbar({
                        closeOnOutsideClick: false,
                        timeout: "2000",
                        message: '修改成功!',
                        position: 'top'
                    });
                    document.getElementById("submit").innerHTML = "修改成功!";
                    setTimeout("inst.close()", 2000);
                    setTimeout("history.go(-2)", 3000);
                }
            }
        })

    }

    function daochu(test_name) {
        mdui.confirm('您确定导出测试的成绩吗?', function () {
            mdui.alert(window.location.href);
            var urls = window.location.href.replace("#mdui-dialog", "");
            window.location.href = urls + "&c=daochu&test=" + test_name;
        });
    }

</script>




