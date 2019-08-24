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
 * 創建時間：下午12:33
 * 所屬項目名稱：PE-System
 */

session_start();
$location = "../";

$title = "修改密码";
include_once "../hearder.php";
include_once "../functions.php";
include_once "verb.php";
include_once "../functions_layout.php";
top_menu("修改密码");
if (isset($_SESSION['username']) and isset($_SESSION['school'])) {
    $username = $_SESSION['username'];
    $school = $_SESSION['school'];
} elseif (isset($_SESSION['username_check']) and isset($_SESSION['school_check'])) {
    $username = $_SESSION['username_check'];
    $school = $_SESSION['school_check'];
} else {
    session_unset();
    session_destroy();
    header("Location: ./index.php");
}
$info = link_admin()->query("select * from student where school='$school' and name='$username'")->fetch_array();
$pwd_check = $info['pwd_check'];
if ($pwd_check == 1) {
    header("Location: ../");
    exit();
}

if (!isset($_SESSION['username_check']) and !isset($_SESSION['school_check'])) {
    header("Location:index.php");
    exit();
}
?>
<div class="mdui-container ">
    <div class="mdui-col-md-6 mdui-col-offset-md-3">
        <h1 class="mdui-text-center">修改密码</h1>
        <h2 class="mdui-text-center">这是您第一次登陆,请您修改密码.</h2>

        <div class="mdui-textfield mdui-textfield-floating-label">
            <i class="mdui-icon material-icons">https</i>
            <label class="mdui-textfield-label">新密码</label>
            <input class="mdui-textfield-input" type="password" name="pwd" id="pwd" onblur="pwd_check()"/>
        </div>
        <div class="mdui-textfield mdui-textfield-floating-label">
            <i class="mdui-icon material-icons">input</i>
            <label class="mdui-textfield-label">再输入一遍</label>
            <input class="mdui-textfield-input" type="password" name="repwd" id="repwd" onblur="pwd_check()"/>
        </div>
        <div class="mdui-text-center" id="check" style="display: none; color: red">两次输入的密码不同!</div>
        <button class="mdui-btn  mdui-color-theme-accent mdui-ripple" id="submit" onclick="pwds()" disabled="true">修改
        </button>
        <div class="mdui-text-center" id="error" style="display: none; color: red">发生错误，请稍后重试！</div>
    </div>
</div>
<script>
    function pwd_check() {
        var pwd = $("#pwd").val();
        var repwd = $("#repwd").val();
        if (pwd != repwd) {
            document.getElementById("check").style.display = "";
        } else {
            document.getElementById("check").style.display = "none";
            $("#submit").attr("disabled", false);
        }
    }

    function pwds() {
        var pwd = $("#pwd").val();
        var repwd = $("#repwd").val();
        $.ajax({
            type: "GET",
            url: "pwd_check.php",
            data: "username=<?php
                echo $_SESSION['username_check'];
                ?>&pwd=" + pwd + "&school=<?php
                echo $_SESSION['school_check'];
                ?>&repwd=" + repwd,
            success: function (data) {
                if (data) {
                    $("#submit").text("修改成功，正在为您跳转，请稍后...");
                    setTimeout("window.location.href = \"./info.php\"", 1000);
                } else {
                    document.getElementById("error").style.display = "";//显
                }
            }
        })
    }

</script>