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
        <div class="mdui-row">
            <div class="mdui-col-xs-9 chinese" style="font-size: 10px">
                <div style="font-size: 20px;padding-top: 10px">姓名：<? echo $_SESSION['username']?>   性别：<?php
                    $name=$_SESSION['username'];
                    $n=link_admin()->query("select * from student where name='$name'")->fetch_array();
                    $school=$n['school'];
                    $school=link_admin()->query("select * from school where uid='$school'")->fetch_array()['name'];
                    $sex=$n['sex'];
                    echo $sex;
                    ?> 学校：<?echo $school?></div>
                <div class="mdui-row">
                    <div class="mdui-col-xs-5 ">

                    </div>
                    <div class="mdui-col-xs-7 mdui-col-offset-xs-9" style="padding-top: 20px">
                        <div class="mdui-card">

                            <div class="number" style="text-align: center;font-size: 300px;color:
                            <?php
                            $num=60;

                            if($num>20 and $num<30){
                                echo "red";
                            }elseif($num>30 and $num<40){
                                echo "pink";
                            }elseif($num>40 and $num<50){
                                echo "blue";
                            }elseif($num>50 and $num<60)
                            {
                                echo "yellow";
                            }
                            elseif ($num=="60"){
                                echo "green";
                            }

                            ?>

                                    ">
                                <?echo $num?>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
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
