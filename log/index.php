<?php
/**
 * 作者: Cookie
 * 所有者: https://www.lfdevs.com
 * 日期: 2019/8/10
 * 创建时间: 下午9:53
 */
//登录页面的主页

$title="用户登录";
$location="../";
include_once "../hearder.php";
include_once "../db.php";

if (isset($_POST['submit'])){
    if (!isset(""))

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
