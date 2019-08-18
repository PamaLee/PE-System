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
 * 創建時間：下午1:31
 * 所屬項目名稱：PE-System
 */
session_start();
$location="../";

$title="完善您的信息";
include_once "../functions.php";
include_once "verb.php";
include_once "../functions_layout.php";
include_once "../hearder.php";


top_menu("完善您的信息")
?>

<div class="mdui-container">
    <div class="mdui-col-md-6 mdui-col-offset-md-3">
        <h1 class="mdui-text-center">完善信息</h1>
        <h2 class="mdui-text-center">请以实际填写，完善信息后才能使用哦！</h2>
        <h3 class="mdui-text-center mdui-color-pink">注意:不用填写单位!</h3>
        <div class="mdui-textfield mdui-textfield-floating-label">
            <i class="mdui-icon material-icons">accessibility</i>
            <label class="mdui-textfield-label">您的身高（厘米）</label>
            <input class="mdui-textfield-input" type="number" name="high" id="high" value="<?php
            $name=$_SESSION['username'];
            $school=$_SESSION['school'];
            $info=link_admin()->query("select * from student where name='$name' and school='$school'")->fetch_array();
            $high=$info['high'];
            $weight=$info['weight'];
            echo $high;
?>
"/>
        </div>
        <div class="mdui-textfield mdui-textfield-floating-label">
            <i class="mdui-icon material-icons">airline_seat_recline_extra</i>
            <label class="mdui-textfield-label">您的体重（千克）</label>
            <input class="mdui-textfield-input" type="number" name="weight" id="weight" value="<?php echo $weight?>"/>
        </div>
        <div class="mdui-row">
            考试选项：<select class="mdui-select" name="choose" id="choose" mdui-select="{position: 'bottom'}">
                <?php
                if ($_SESSION['info']['sex']==0){
                    echo "<option value=\"1\">实心球</option>
                <option value=\"2\">立定跳远</option>
                <option value=\"3\">仰卧起坐</option>
                <option value=\"4\">跳绳</option>";
                }
                if($_SESSION['info']['sex']==1){
                    echo "<option value=\"1\">实心球</option>
                <option value=\"2\">立定跳远</option>
                <option value=\"4\">跳绳</option>
                <option value=\"5\">引体向上</option>";
                }

                ?>
            </select>
        </div>

        <button class="mdui-btn  mdui-color-theme-accent mdui-ripple" id="submit" onclick="check();info();">完成</button>
    </div>
</div>

<script>
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

    function check() {
        var high = document.getElementById("high").value;
        var weight = document.getElementById("weight").value;
        if (high=="") {
            mdui.snackbar({
                closeOnOutsideClick: false,
                timeout: 1000,
                message: '请填写完整!',
                position: 'bottom'
            });
            return;
        }
        if (weight==""){
            mdui.snackbar({
                closeOnOutsideClick: false,
                timeout: 1000,
                message: '请填写完整!',
                position: 'top'
            });
            return;
        }
    }



    function info() {
        var vals = document.getElementById("choose").value;
        var high=$('#high').val();
        var weight=$('#weight').val();
        $.ajax({
            type: "GET",
            url: "info_check.php",
            data: "username=<?php
                echo $_SESSION['username'];
                ?>&high="+high+"&school=<?php
                echo $_SESSION['school'];
                ?>&weight="+weight+"&choose="+vals,
            success: function (data) {
                if (data){
                    $("#submit").text("完善成功，正在为您跳转，请稍后...");
                    setTimeout("window.location.href = \"../\"",1500);
                }
            }
        })
    }

</script>