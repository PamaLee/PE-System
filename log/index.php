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

if (isset($_POST['submit'])){
    if (!isset($_POST["username"],$_POST["pwd"])){

    }

}
?>
<div class="mdui-container">
    <h1 style="text-align: center">体育系统登录</h1>
    <h4 style="text-align: center">当前日期:<?php echo date("Y-m-d")?></h4>

    <form method="post" action="index.php">

        <div class="mdui-container mdui-valign">
            <font size="5dp">学校:</font><select class="mdui-select" mdui-select name="leibie" id="leibie">
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
        <div class="mdui-textfield mdui-textfield-floating-label">
            <label class="mdui-textfield-label">用户名</label>
            <input class="mdui-textfield-input" type="text" name="username" id="username"/>
        </div>
        <div class="mdui-textfield mdui-textfield-floating-label">
            <label class="mdui-textfield-label">密码</label>
            <input class="mdui-textfield-input" type="password" name="pwd" id="pwd"/>
        </div>
        <button class="mdui-btn mdui-color-theme-accent mdui-ripple" type="submit" name="submit">登入</button>
    </form>

</div>
