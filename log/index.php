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
 * 創建時間：上午8:23
 * 所屬項目名稱：PE-System
 */
//登录页面的主页

$title="用户登录";
$location="../";
include_once "../hearder.php";
include_once "../db.php";
include "../functions.php";


if (isset($_GET['c'])){
    if ($_GET['c']=="loginout"){
        session_unset();
        session_destroy();
        t("成功安全退出您的账户！","./");
        exit();
    }
}
include "../functions_layout.php";
top_menu($title);
?>

<div class="mdui-container">
    <h1 style="text-align: center">请您登录</h1>
    <h4 style="text-align: center">当前日期:<?php echo date("Y-m-d")?></h4>
    <div id="login">
        <div class="mdui-container mdui-valign" onclick="schools()">
            <font size="4dp">所在学校:</font><select class="mdui-select" mdui-select name="leibie" id="leibie">
                <?php
                $arr = array("一中", "二中", "三中", "四中","五中","六中");
                foreach($arr as $v){
                    ?>
                    <option value="<?php echo $v; ?>"><?php echo $v; ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <label class="mdui-radio">
            <input type="radio" name="who" value="teacher"/>
            <i class="mdui-radio-icon"></i>
            教师登陆
        </label>

        <label class="mdui-radio">
            <input type="radio" name="who" value="student" checked/>
            <i class="mdui-radio-icon"></i>
            学生登陆
        </label>
        <div class="mdui-textfield mdui-textfield-floating-label" onclick="username()">
            <label class="mdui-textfield-label">用户名</label>
            <input class="mdui-textfield-input" type="text" name="username" id="username" />
        </div>
        <div class="mdui-textfield mdui-textfield-floating-label"  onclick="pwd()">
            <label class="mdui-textfield-label">密码</label>
            <input class="mdui-textfield-input" type="password" name="pwd" id="pwd"/>
        </div>
        <button class="mdui-btn mdui-color-theme-accent mdui-ripple" id="submit" onclick="login()">登入</button>
    </div>
</div>


<script>
    window.onload = todo;
    function todo(){
        mdui.snackbar({
            timeout: 2000,
            message: '如果您没有账号,请向您的班主任获取!',
            position: 'right-top'
        });
    }
    function schools(){
        mdui.snackbar({
            timeout: 10000,
            message: '目前仅支持以上桂林市学校',
            position: 'right-top'
        });
    } function username(){
        mdui.snackbar({
            timeout: 4000,
            message: '请使用完整的用户名填写',
            position: 'right-top'
        });
    } function pwd(){
        mdui.snackbar({
            timeout: 4000,
            message: '如果您是第一次登陆,请使用提供的默认密码',
            position: 'right-top'
        });
    }function pwd_error(){
        mdui.snackbar({
            closeOnOutsideClick: false,
            timeout: 15000,
            message: '用户名或密码错误,请重试!',
            position: 'top'
        });
    }

    function get_radio(name) {
        var item = null;
        var obj = document.getElementsByName(name);
        for (var i = 0; i < obj.length; i++) { //遍历Radio
            if (obj[i].checked) {
                item = obj[i].value;
            }
        }
        return item;
    }


    var $$=mdui.JQ;
    function login() {
        var username = document.getElementById("username").value;
        var pwd = document.getElementById("pwd").value;
        var vals = document.getElementById("leibie").value;
        var who = document.getElementsByName("who").value;
        if (username == ""){
            mdui.snackbar({
                closeOnOutsideClick: false,
                timeout: 1000,
                message: '请填写完整!',
                position: 'top'
            });
            return;
        }
        if (pwd == ""){
            mdui.snackbar({
                closeOnOutsideClick: false,
                timeout: 1000,
                message: '请填写完整!',
                position: 'top'
            });
            return;
        }

        document.getElementById("submit").innerHTML = "登陆中....请稍后...";
        $("#submit").attr("disabled","true");
        $$.ajax({
            type: "POST",
            url: "log_check.php",
            data: "username="+username+"&pwd="+pwd+"&school="+vals+"&who="+get_radio("who"),
            success: function (data) {
                if (data){
                    $$("#submit").text("登陆成功！欢迎回来："+username+"，正在为您跳转，请稍后...");
                    setTimeout("window.location.href = \"../\"",2000);
                } else
                {
                    pwd_error();
                    $("#submit").attr("disabled",false);
                    $$("#submit").text("登陆");
                }
            }
        })
    }

</script>



