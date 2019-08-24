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


?>
<div class="mdui-table-fluid">
    <table class="mdui-table mdui-table-hoverable">
        <?php
        echo " <thead>
        <tr>
            <th>UID</th>
            <th>名称</th>
            <th>序号</th>
            <th>日期</th>
            <th>拥有成绩的同学</th>
            <th>操作</th>
        </tr>
        </thead>";
        echo "<tbody>";
        $test = link_admin()->query("select * from test_name where school='$school' and grade='$grade'");
        foreach ($test as $row) {
            if ($row['first_time_login'] == 0) {
                $first = "否";
            } else {
                $first = "是";
            }
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['num'] . "</td>";
            echo "<td>" . $row['date'] . "</td>";
            echo "<td>" . $first . "</td>";
            $name = $row['name'];
            echo "<td><button class='mdui-btn mdui-color-theme-accent mdui-ripple' onclick=\"re('$name')\">修改</button><button class='mdui-btn mdui-color-theme mdui-ripple' onclick=\"";
            ?>funs('<? echo $name; ?>');
            <?php echo "\">删除</button> </td>";
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
            <label class="mdui-textfield-label">姓名</label>
            <input class="mdui-textfield-input" type="text" value="<?php echo $infoes['name']; ?>" required
                   name="username" id="username"/>
        </div>
        <div class="mdui-textfield mdui-textfield-floating-label">
            <i class="mdui-icon material-icons">class</i>
            <label class="mdui-textfield-label">班级</label>
            <input class="mdui-textfield-input" type="text" value="<?php echo $infoes['class']; ?>" required
                   name="classes" id="classes"/>
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
        mdui.confirm('您确定修改这个测试的信息吗?', function () {
            mdui.alert(window.location.href);
            var urls = window.location.href.replace("#mdui-dialog", "");
            window.location.href = urls + "&c=re&test=" + test;
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
            data: "rename=<?echo $_GET['test']?>&reclass=<? echo $_GET['class']?>&name=" + username + "&class=" + classes,
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


</script>

<?php
if (isset($_GET['c']) and $_GET['c'] == "re") {
    echo "<script>
var inst = new mdui.Dialog('#re',{
    history:false,
    modal:true
});
  inst.open();
</script>
";
}
?>




