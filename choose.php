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
 * 創建時間：下午4:02
 * 所屬項目名稱：PE-System
 */

$location="./";
$title="完善新测试的选项";
session_start();
include_once "hearder.php";
include_once "functions.php";
include_once "functions_layout.php";
$test_choose_no=1;
include_once "verb.php";
top_menu("完善信息",$location);


if (isset($_GET['c']) and $_GET['c']=='l'){
    $test=$_SESSION['test_choose'];
    $choose=$_GET['choose'];
    $school=$_SESSION['info']['school'];
    $uid=$_SESSION['info']['uid'];
    $sql=link_admin()->query("update test_res set choose_what='$choose'  where school='$school' and test_num='$test' and uid='$uid'");
    if ($sql){
        echo "true";
        return true;
    }else{
        echo "false";
        return false;
    }

}

?>

<div class="mdui-container" style="padding-top: 75px">
    <div class="mdui-text-center">
       <h1>完善新测试信息</h1>
        <h2>新测试就要到来了!请尽快完善您新测试的选项</h2>
        <br>
        <div class="mdui-row">
            考试选项：<select class="mdui-select" name="choose" id="choose" mdui-select="{position: 'bottom'}">
                <?php
                if ($_SESSION['info']['sex'] == 0) {
                    echo "<option value=\"1\">实心球</option>
                <option value=\"2\">立定跳远</option>
                <option value=\"3\">仰卧起坐</option>
                <option value=\"4\">跳绳</option>";
                }
                if ($_SESSION['info']['sex'] == 1) {
                    echo "<option value=\"1\">实心球</option>
                <option value=\"2\">立定跳远</option>
                <option value=\"4\">跳绳</option>
                <option value=\"5\">引体向上</option>";
                }

                ?>
            </select>
        </div>

        <button class="mdui-btn  mdui-color-theme-accent mdui-ripple" id="submit" onclick="que();">完成</button>
    </div>
</div>

<script>

    function que() {
        var choose = $("#choose").val();
        $("#submit").attr("disabled", "true");
        document.getElementById("submit").innerHTML = "完善中...";
        $.ajax({
            type: "GET",
            url: "choose.php",
            data: "c=l&choose="+choose,
            success: function (data) {
                if (data.indexOf("服务端出现错误") != -1) {
                    document.write("<h1>" + data + "</h1>");
                }
                if (data) {
                    mdui.snackbar({
                        closeOnOutsideClick: false,
                        timeout: "2000",
                        message: '完善成功!正在跳转...',
                        position: 'top'
                    });
                    document.getElementById("submit").innerHTML = "完善成功!正在跳转";
                    setTimeout("window.location.href='index.php'", 2000);
                }
            }
        })

    }
</script>