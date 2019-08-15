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
$location="./";
include_once "functions.php";
include_once "./verb.php";
include_once "db.php";
$title="主页";
include "./hearder.php";
include "./functions_layout.php";
?>
<?php
top_menu($title);
?>
<div class="mdui-container">
    <div id="tab1">
                <?php
                include_once "app/spawn.php";
                ?>
            </div>
    <div id="tab2">

    </div>



</div>

<div class=" mdui-bottom-nav mdui-bottom-nav-text-auto mdui-color-indigo mdui-tab" mdui-tab>
    <a href="#tab1" class="mdui-ripple mdui-ripple-white">
        <i class="mdui-icon material-icons">account_circle</i>
        <label>主页</label>
    </a>
    <a href="#tab2" class="mdui-ripple mdui-ripple-white">
        <i class="mdui-icon material-icons">contact_phone</i>
        <label>班级</label>
    </a>
    <a href="#tab3" class="mdui-ripple mdui-ripple-white">
        <i class="mdui-icon material-icons">shop</i>
        <label>帮助</label>
    </a>
    <a href="#tab4" class="mdui-ripple mdui-ripple-white">
        <i class="mdui-icon material-icons">backup</i>
        <label>库存</label>
    </a>
    <a href="#tab5" class="mdui-ripple mdui-ripple-white">
        <i class="mdui-icon material-icons">backup</i>
        <label>库存</label>
    </a>
</div>

</body>
</html>
