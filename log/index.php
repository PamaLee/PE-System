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
session_start();
$title="用户登录";
$location="../";
include_once "../hearder.php";
include "../functions.php";
if (isset($_GET['c'])){
    if ($_GET['c']=="loginout"){
        session_unset();
        session_destroy();
        t("成功安全退出您的账户！","./");
        exit();
    }
}

if (isset($_SESSION['username']) or isset($_SESSION['who'])){
    t("您已经登录了！",'../');
    exit();
}




if (isset($_SESSION['username_check']) or isset($_SESSION['school_check'])){
    header("Location: ./pwd.php");
    exit();
}
include "../functions_layout.php";
top_menu($title);
?>

<div class="mdui-container ">
    <div class="mdui-col-md-6 mdui-col-offset-md-3">

        <h1 style="text-align: center">请您登录</h1>
        <h4 style="text-align: center">当前日期:<?php echo date("Y-m-d")?></h4>
        <div id="login">
            <div class="mdui-valign" onclick="schools()">
                <font size="4dp">所在学校:</font><select class="mdui-select" mdui-select name="leibie" id="leibie">
                    <?php
                    $arr = array("首师大附中","一中", "二中", "三中", "四中","五中","六中");
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
                <i class="mdui-icon material-icons">account_box</i>
                <label class="mdui-textfield-label">用户名</label>
                <input class="mdui-textfield-input" type="text" required name="username" id="username" />
                <div class="mdui-textfield-error">用户名不能为空</div>
            </div>
            <div class="mdui-textfield mdui-textfield-floating-label"  onclick="pwd()">
                <i class="mdui-icon material-icons">https</i>
                <label class="mdui-textfield-label">密码</label>
                <input class="mdui-textfield-input" type="password" required name="pwd" id="pwd"/>
                <div class="mdui-textfield-error">密码不能为空</div>
            </div>
            <button class="mdui-btn mdui-color-theme-accent mdui-ripple" id="submit" onclick="login()">登入</button>
        </div>
    </div>

</div>


<script>
    window.onload = todo;
    function todo(){
        mdui.snackbar({
            timeout: 2000,
            message: '如果您没有账号,请向您的班主任获取!',
            position: 'right-bottom'
        });
    }
    function schools(){
        mdui.snackbar({
            timeout: 10000,
            message: '目前仅支持以上桂林市学校',
            position: 'right-bottom'
        });
    } function username(){
        mdui.snackbar({
            timeout: 4000,
            message: '请使用完整的用户名填写',
            position: 'right-bottom'
        });
    } function pwd(){
        mdui.snackbar({
            timeout: 4000,
            message: '如果您是第一次登陆,请使用提供的默认密码',
            position: 'right-bottom'
        });
    }function pwd_error(){
        mdui.snackbar({
            closeOnOutsideClick: false,
            timeout: 15000,
            message: '用户名或密码错误,请重试!',
            position: 'bottom'
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
                switch (data) {
                    case "tospawn":
                        $$("#submit").text("登陆成功！欢迎回来："+username+"，正在为您跳转，请稍后...");
                        setTimeout("window.location.href = \"../\"",1000);
                        break;
                    case "topwd":
                        $$("#submit").text("登陆成功！欢迎回来："+username+"，正在为您跳转，请稍后...");
                        setTimeout("window.location.href = \"./pwd.php\"",1000);
                        break;
                    default:
                        pwd_error();
                        $("#submit").attr("disabled",false);
                        $$("#submit").text("登陆");
                        break;
                }
            }
        })
    }

</script>



