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
 * 創建時間：上午8:03
 * 所屬項目名稱：PE-System
 */

session_start();
$location = "../../";
$title = "学生管理";
include_once "../../functions.php";
$school = $_SESSION['info']['school'];
$grade = $_SESSION['info']['grade'];


if (isset($_GET["c"]) and $_GET['c'] == "del") {
    $names = $_GET['student'];
    $id = link_admin()->query("delete from student where school='$school' and grade='$grade' and name='$names'");
    if ($id) {
        message("删除成功!", "top", "2000");
        echo "<script>setTimeout('history.go(-2)',1000)</script>";
    } else {
        message("删除失败!", "top", "2000");
        echo "<script>setTimeout('history.go(-2)',1000)</script>";
    }
}

?>

    班级:  <select class="mdui-select" mdui-select="{position: 'bottom'}" id="class" name="class">

    <?php

    $class = link_admin()->query("select * from class where school='$school' and grade='$grade'");
    foreach ($class as $row) {
        $classes = $row['class'];
        echo "<option value=\"$classes\"";
        echo ">$classes 班</option>";
    }
    ?>

</select>
    <button class="mdui-btn mdui-color-theme-accent mdui-ripple" onclick='check()'>查看</button>
<?php


?>
    <div class="mdui-table-fluid">
        <table class="mdui-table mdui-table-hoverable">
            <?php

            if (!isset($_GET['class'])) {
                echo "<div class='mdui-card mdui-text-center'>
                     <h2 class='mdui-color-pink'>请选择班级</h2>
                    </div>";
            } else {
                $class = $_GET['class'];
                echo "<div class='mdui-card mdui-text-center'>
                     <h2 class='mdui-color-theme'>$class 班</h2>
                    </div>";
                echo " <thead>
        <tr>
            <th>学号</th>
            <th>姓名</th>
            <th>性别</th>
            <th>密码</th>
            <th>登录次数</th>
            <th>是否登录过</th>
            <th>操作</th>
        </tr>
        </thead>";
                echo "<tbody>";
                $student = link_admin()->query("select * from student where school='$school' and class='$class' and grade='$grade' order by study_hao ASC ");
                foreach ($student as $row) {
                    if ($row['first_time_login'] == 0) {
                        $first = "否";
                    } else {
                        $first = "是";
                    }
                    if ($row['sex'] == 0) {
                        $sex = "女";
                    } else {
                        $sex = "男";
                    }
                    echo "<tr>";
                    echo "<td>" . $row['study_hao'] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $sex . "</td>";
                    echo "<td>*********</td>";
                    echo "<td>" . $row['login_time'] . "</td>";
                    echo "<td>" . $first . "</td>";
                    $name = $row['name'];
                    echo "<td><button class='mdui-btn mdui-color-theme-accent mdui-ripple' onclick=\"re('$name')\">修改</button><button class='mdui-btn mdui-color-theme mdui-ripple' onclick=\"";
                    ?>funs('<? echo $name; ?>');
                    <?php echo "\">删除</button> </td>";
                }

                echo "</tbody>";


            }

            ?>

        </table>
    </div>
<?php
if (isset($_GET['student'])) {
    $name = $_GET['student'];
    $infoes = link_admin()->query("select * from student where school='$school' and grade='$grade' and class='$class' and name='$name'")->fetch_array();
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
                <i class="mdui-icon material-icons">confirmation_number</i>
                <label class="mdui-textfield-label">学号</label>
                <input class="mdui-textfield-input" type="text" value="<?php echo $infoes['study_hao']; ?>" required
                       name="study_hao" id="study_hao"/>
            </div>
            <div class="mdui-textfield mdui-textfield-floating-label">
                <i class="mdui-icon material-icons">accessibility</i>
                <label class="mdui-textfield-label">性别</label>
                <input class="mdui-textfield-input" type="text" value="<?php
                if ($infoes['sex'] == 0) {
                    echo "女";
                } else {
                    echo "男";
                }
                ?>" required name="sex" id="sex"/>
            </div>
            <div class="mdui-textfield mdui-textfield-floating-label">
                <i class="mdui-icon material-icons">class</i>
                <label class="mdui-textfield-label">班级</label>
                <input class="mdui-textfield-input" type="text" value="<?php echo $infoes['class']; ?>" required
                       name="classes" id="classes"/>
            </div>
            <button class="mdui-btn mdui-color-theme-accent mdui-ripple" id="submit" onclick="que()">确定</button>
            <button class="mdui-btn mdui-color-theme-accent mdui-ripple" onclick="inst.close();history.go(-1)">取消</button>

        </div>
    </div>

    <script>
        function check() {
            var clases = document.getElementById("class").value;
            window.location.href = "./index.php?t=student&class=" + clases;
        }

        function funs(student) {
            mdui.confirm('您确定删除这个学生吗?', function () {
                var urls = window.location.href.replace("#mdui-dialog", "");
                setTimeout(function () {
                    window.location.href = urls + "&c=del&student=" + student;
                },500);
            });
        }

        function re(student) {
            mdui.confirm('您确定修改这个学生的信息吗?', function () {
                var urls = window.location.href.replace("#mdui-dialog","");
                setTimeout(function () {
                    window.location.href = urls+"&c=re&student="+student;
                },500);

            });
        }

        function que() {
            var username = $("#username").val();
            var study_hao = $("#study_hao").val();
            var sex = $("#sex").val();
            var classes = $("#classes").val();
            $("#submit").attr("disabled", "true");
            document.getElementById("submit").innerHTML = "修改中...";
            $.ajax({
                type: "GET",
                url: "app/re_check.php",
                data: "rename=<?echo $_GET['student']?>&reclass=<? echo $_GET['class']?>&name=" + username + "&study_hao=" + study_hao + "&sex=" + sex + "&class=" + classes,
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
                        setTimeout("history.go(-1)", 3000);
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