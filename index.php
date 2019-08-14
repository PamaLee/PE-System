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
                <div class="mdui-row">
                    <div style="padding-top: 30px">
                        <div class="mdui-container">
                            <div class="mdui-card">

                                <!-- 卡片头部，包含头像、标题、副标题 -->
                                <div class="mdui-card-header">
                                    <img class="mdui-card-header-avatar" src="https://mdui-aliyun.cdn.w3cbus.com/docs/assets/docs/img/avatar1.jpg"/>
                                    <div class="mdui-card-header-title"><? echo $_SESSION['username']?></div>
                                    <div class="mdui-card-header-subtitle"><?php echo get_info($_SESSION['username'])['grade']."年级".get_info($_SESSION['username'])['class']."班"?></div>
                                </div>

                                <div class="mdui-card-media">

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

                                    ?>">
                                        60
                                    </div>
                                    <?php
                                    
                                    ?>
                                    <div class="mdui-card-menu">
                                        <button class="mdui-btn mdui-btn-icon mdui-text-color-white"><i class="mdui-icon material-icons">share</i></button>
                                    </div>
                                </div>

                                <div class="mdui-card-primary">
                                    <div class="mdui-card-primary-title">Title</div><!-- 当前测试成绩的名称 -->
                                    <div class="mdui-card-primary-subtitle">Subtitle</div> <!--  当前测试的时间 -->
                                </div>

                                <!-- 卡片的内容 -->
                                <div class="mdui-card-content">子曰：「学而时习之，不亦说乎？有朋自远方来，不亦乐乎？人不知，而不愠，不亦君子乎？」</div>

                                <!-- 卡片的按钮 -->
                                <div class="mdui-card-actions">
                                    <button class="mdui-btn mdui-ripple">action 1</button>
                                    <button class="mdui-btn mdui-ripple">action 2</button>
                                    <button class="mdui-btn mdui-btn-icon mdui-float-right"><i class="mdui-icon material-icons">expand_more</i></button>
                                </div>

                            </div>

                        </div>

                        <!-- <div class="mdui-card">
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

                        </div> -->
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
