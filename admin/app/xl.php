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
 * 創建時間：下午12:31
 * 所屬項目名稱：PE-System
 */

session_start();
$location='../../';
include_once "../../functions.php";
if (isset($_POST['submit'])){
    $school=$_SESSION['info']['school'];
    $grade=$_SESSION['info']['grade'];
    $class=$_SESSION['info']['class'];
    $student=link_admin()->query("select * from student where school='$school' and grade='$grade' and class='$class'");
    $test_num=$_SESSION['test_num'];
    foreach ($student as $row){
        $uid=$row['uid'];
        $study_hao=$row['study_hao'];
        $sex=$row['sex'];
        $test_if=link_admin()->query("select * from test_res where school='$school' and grade='$grade' and uid='$uid' and test_num='$test_num'")->num_rows;
        if ($test_if==0){
            $sql=link_admin()->query("insert into test_res(school, grade, class, uid, study_hao, test_num)values ('$school','$grade','$class','$uid','$study_hao','$test_num')");
            if (!$sql){
                exit("失败!请重试!!");
            }
        }

        if (!empty($_POST[$uid."-short"])){
            $res=$_POST[$uid."-short"];
            $ss=get_res_short_run($sex,$_POST[$uid."-short"]);
            link_admin()->query("update test_res set short_run_res='$res',short_run_sc='$ss' where school='$school' and test_num='$test_num' and grade='$grade' and class='$class' and uid='$uid'");
        }
        if(!empty($_POST[$uid."-long"])){
            $res=$_POST[$uid."-long"];
            $ss=get_res_long_run($sex,$_POST[$uid."-long"]);
            link_admin()->query("update test_res set long_run_res='$res',long_run_sc='$ss' where school='$school' and test_num='$test_num' and grade='$grade' and class='$class' and uid='$uid'");
        }
        if (!empty($_POST[$uid."-choose"])){
            $res=$_POST[$uid."-choose"];
            $choose_what=$res['choose_what'];
            $ss=get_res_choose($sex,$choose_what,$_POST[$uid."-choose"]);
            link_admin()->query("update test_res set choose_res='$res',choose_sc='$ss' where school='$school' and test_num='$test_num' and grade='$grade' and class='$class' and uid='$uid'");
        }
    }
        t("成功!","../index.php?t=test");
}



?>

<div class="mdui-text-center">
    <h1><? echo colors($_GET['test'])?></h1>
</div>


<div class="mdui-row-xs-5 mdui-color-theme">
    <div class="mdui-col">
       <h3 class="mdui-text-center">姓名</h3>
    </div>
    <div class="mdui-col">
        <h3 class="mdui-text-center">50米成绩(秒)</h3>
    </div>
    <div class="mdui-col">
        <h3 class="mdui-text-center">长跑成绩(分.秒)</h3>
    </div>
    <div class="mdui-col">
        <h3 class="mdui-text-center">选项成绩</h3>
    </div>
    <div class="mdui-col">
        <h3 class="mdui-text-center">选项类别</h3>
    </div>

</div>
<form action="xl.php" method="post">
<?php
$school=$_SESSION['info']['school'];
$grade=$_SESSION['info']['grade'];
$class=$_GET['class'];
$test_name=$_GET['test'];
$test_num=$_SESSION['test_num']=link_admin()->query("select * from test_name where school='$school' and grade='$grade' and name='$test_name'")->fetch_array()['num'];
$man=link_admin()->query("select * from student where school='$school' and grade='$grade' and class='$class' and sex='1' order by study_hao ASC ");
$woman=link_admin()->query("select * from student where school='$school' and grade='$grade' and class='$class' and sex='0' order by study_hao ASC ");
?>
    <div class="mdui-color-theme mdui-text-center"><h2>男生</h2></div>
    <?php
foreach ($man as $row){
    $uid=$row['uid'];
    $test_choose=link_admin()->query("select * from test_res where uid='$uid' and test_num='$test_num' and school='$school' and grade='$grade'")->fetch_array()['choose_what'];
    $choose=$test_choose;
    $inss=0;
    if ($choose==0) {
        $inss=1;
        $choose_name = "该同学尚未选择";
    }else{
        $choose_name=get_choose_name($choose);
    }
    $test_res=link_admin()->query("select * from test_res where school='$school' and grade='$grade' and class='$class' and test_num='$test_num' and uid='$uid'");
    $num=$test_res->num_rows;
    if ($num>0){
        $test_res=$test_res->fetch_array();
        echo "
<div class=\"mdui-row-xs-5\">
    <div class=\"mdui-col\">
       <h3 class=\"mdui-text-center\">".$row['name']."</h3>
    </div>
    <div class=\"mdui-col\">
        <div class=\"mdui-textfield\">
            <input class=\"mdui-textfield-input\" type=\"text\" value='".$test_res['short_run_res']."' placeholder=\"50米\" name='$uid-short'/>
        </div>
    </div>
    <div class=\"mdui-col\">
        <div class=\"mdui-textfield\">
            <input class=\"mdui-textfield-input\" type=\"text\" value='".$test_res['long_run_res']."' placeholder=\"长跑\" name='$uid-long'/>
        </div>
    </div>
    <div class=\"mdui-col\">
        <div class=\"mdui-textfield\">
            <input class=\"mdui-textfield-input\" type=\"text\" value='".$test_res['choose_res']."'";
        if ($inss==1){
            echo "placeholder=\"暂时不能填写\" disabled ";
        }else{
            echo "placeholder=\"选项\"";
        }
        unset($inss);
        echo "name='$uid-choose'/>
        </div>
    </div>
    <div class=\"mdui-col\">
        <h3 class='mdui-text-center'>".$choose_name."</h3>
    </div>
</div>
    ";
    }else{
        echo "
<div class=\"mdui-row-xs-5\">
    <div class=\"mdui-col\">
       <h3 class=\"mdui-text-center\">".$row['name']."</h3>
    </div>
    <div class=\"mdui-col\">
        <div class=\"mdui-textfield\">
            <input class=\"mdui-textfield-input\" type=\"text\" placeholder=\"50米\" name='$uid-short'/>
        </div>
    </div>
    <div class=\"mdui-col\">
        <div class=\"mdui-textfield\">
            <input class=\"mdui-textfield-input\" type=\"text\"  placeholder=\"长跑\" name='$uid-long'/>
        </div>
    </div>
    <div class=\"mdui-col\">
        <div class=\"mdui-textfield\">
            <input class=\"mdui-textfield-input\" type=\"text\" placeholder=\"选项\" name='$uid-choose'/>
        </div>
    </div>
    <div class=\"mdui-col\">
        <h3 class='mdui-text-center'>".$choose_name."</h3>
    </div>
</div>
    ";
    }


}
?>
    <div class="mdui-color-red mdui-text-center"><h2>女生</h2></div>
    <?php
    foreach ($woman as $row){
        $uid=$row['uid'];
        $test_choose=link_admin()->query("select * from test_res where uid='$uid' and test_num='$test_num' and school='$school' and grade='$grade'")->fetch_array()['choose_what'];
        $choose=$test_choose;
        $ins=0;
        if ($choose==0) {
            $ins=1;
            $choose_name = "该同学尚未选择";
        }else{
            $choose_name=get_choose_name($choose);
        }
        $test_res=link_admin()->query("select * from test_res where school='$school' and grade='$grade' and class='$class' and test_num='$test_num' and uid='$uid'");
        $num=$test_res->num_rows;
        if ($num>0){
            $test_res=$test_res->fetch_array();
            echo "
<div class=\"mdui-row-xs-5\">
    <div class=\"mdui-col\">
       <h3 class=\"mdui-text-center\">".$row['name']."</h3>
    </div>
    <div class=\"mdui-col\">
        <div class=\"mdui-textfield\">
            <input class=\"mdui-textfield-input\" type=\"text\" value='".$test_res['short_run_res']."' placeholder=\"50米\" name='$uid-short'/>
        </div>
    </div>
    <div class=\"mdui-col\">
        <div class=\"mdui-textfield\">
            <input class=\"mdui-textfield-input\" type=\"text\" value='".$test_res['long_run_res']."' placeholder=\"长跑\" name='$uid-long'/>
        </div>
    </div>
    <div class=\"mdui-col\">
        <div class=\"mdui-textfield\">
            <input class=\"mdui-textfield-input\" type=\"text\" value='".$test_res['choose_res']."'";
            if ($choose_name=="该同学尚未选择"){
                echo "placeholder=\"暂时不能填写\" disabled ";
            }else{
                echo "placeholder=\"选项\"";
            }
            unset($ins);
            echo "name='$uid-choose'/>
        </div>
    </div>
    <div class=\"mdui-col\">
        <h3 class='mdui-text-center'>".$choose_name."</h3>
    </div>
</div>
    ";
        }else{
            echo "
<div class=\"mdui-row-xs-5\">
    <div class=\"mdui-col\">
       <h3 class=\"mdui-text-center\">".$row['name']."</h3>
    </div>
    <div class=\"mdui-col\">
        <div class=\"mdui-textfield\">
            <input class=\"mdui-textfield-input\" type=\"text\" placeholder=\"50米\" name='$uid-short'/>
        </div>
    </div>
    <div class=\"mdui-col\">
        <div class=\"mdui-textfield\">
            <input class=\"mdui-textfield-input\" type=\"text\"  placeholder=\"长跑\" name='$uid-long'/>
        </div>
    </div>
    <div class=\"mdui-col\">
        <div class=\"mdui-textfield\">
            <input class=\"mdui-textfield-input\" type=\"text\" placeholder=\"选项\" name='$uid-choose'/>
        </div>
    </div>
    <div class=\"mdui-col\">
        <h3 class='mdui-text-center'>".$choose_name."</h3>
    </div>
</div>
    ";
        }


    }
    ?>
    <input class="mdui-btn mdui-btn-block mdui-color-theme-accent mdui-ripple" type="submit" name="submit" value="保存">
</form>




























































