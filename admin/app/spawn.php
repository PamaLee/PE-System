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

/*
for ($i=1;$i<10;$i++){
    test_insert(10,1,$i,1);
}
*/

$location = "../../";
$title = "管理员主页";
include_once "../../functions.php";

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
            <h3>学生总登录次数:<?php echo get_student_login_time($_SESSION['info']['school'], $_SESSION['info']['grade']) ?>
                次</h3>
            <h3>教师总登录次数:<?php echo get_teacher_login_time($_SESSION['info']['school'], $_SESSION['info']['grade']) ?>
                次</h3>
            <h3>管理员总登录次数:<?php echo get_admin_login_time($_SESSION['info']['school'], $_SESSION['info']['grade']) ?>
                次</h3>
        </div>
    </div>
    <div class="mdui-col-xs-6">
        <div class="mdui-card mdui-text-center">
            <h2 class="mdui-color-theme">发布年级公告</h2>
            <div class="mdui-container">
                <button class="mdui-btn mdui-btn-block mdui-color-theme-accent mdui-ripple" onclick="re()">发布新公告</button>
            </div>
            <h2 class="mdui-color-theme">往次年级公告</h2>

            <?php
            $school = $_SESSION['info']['school'];
            $grade = $_SESSION['info']['grade'];
            $board = link_admin()->query("select * from board where school='$school' and grade='$grade'");
            $num = $board->num_rows;
            if ($num > 0) {
                echo "<div class=\"mdui-table-fluid\">
                           <table class=\"mdui-table mdui-table-hoverable\">
                              <thead>
                            <tr>
                            <th>UID</th>
                            <th>标题</th>
                            <th>内容</th>
                            <th>发布时间</th>
                        </tr>
                    </thead>
                    <tbody>";

                foreach ($board as $row) {
                    echo "<tr>";
                    echo "<td>" . $row['uid'] . "</td>";
                    echo "<td>" . $row['title'] . "</td>";
                    echo "<td>" . $row['body'] . "</td>";
                    echo "<td>" . $row['time'] . "</td>";
                    echo "</tr>";
                }

                echo "</tbody>
                </table>
            </div>";

            }elseif ($num == 0){
                echo "<div class='mdui-color-red mdui-text-center'>没有发布任何公告</div>";
            }

            ?>

        </div>

    </div>
</div>
    <div class="mdui-dialog mdui-color-theme" id="new">
        <div class="mdui-container mdui-color-white mdui-dialog-content">
            <div class="mdui-textfield mdui-textfield-floating-label">
                <i class="mdui-icon material-icons">title</i>
                <label class="mdui-textfield-label">标题</label>
                <input class="mdui-textfield-input" type="text" required
                       name="title" id="title"/>
            </div><div class="mdui-textfield mdui-textfield-floating-label">
                <i class="mdui-icon material-icons">textsms</i>
                <textarea class="mdui-textfield-input" rows="4" placeholder="正文" id="body" name="id"></textarea>
            </div>
            <button class="mdui-btn mdui-color-theme-accent mdui-ripple" id="submit" onclick="que()">确定</button>
            <button class="mdui-btn mdui-color-theme-accent mdui-ripple" onclick="inst.close();history.go(-2);">取消</button>

        </div>
    </div>
<script>
    function re() {
        mdui.confirm('您确定发布新公告吗?', function () {
            mdui.alert(window.location.href);
            var urls = window.location.href.replace("#mdui-dialog", "");
            window.location.href = urls + "?&c=new";
        });
    }
    function que() {
        var title = $("#title").val();
        var body = $("#body").val();
        $("#submit").attr("disabled", "true");
        document.getElementById("submit").innerHTML = "提交中...";
        $.ajax({
            type: "GET",
            url: "app/spawn_check.php",
            data: "title=" + title + "&body=" + body,
            success: function (data) {
                if (data.indexOf("服务端出现错误") != -1) {
                    document.write("<h1>" + data + "</h1>");
                }
                if (data) {
                    mdui.snackbar({
                        closeOnOutsideClick: false,
                        timeout: "2000",
                        message: '发布成功!',
                        position: 'top'
                    });
                    document.getElementById("submit").innerHTML = "发布成功!";
                    setTimeout("inst.close()", 2000);
                    setTimeout("history.go(-2)", 3000);
                }
            }
        })

    }
</script>

<?php
if (isset($_GET['c']) and $_GET['c'] == "new") {
    echo "<script>
var inst = new mdui.Dialog('#new',{
    history:false,
    modal:true
});
  inst.open();
</script>
";
}
?>