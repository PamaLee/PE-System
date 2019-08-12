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
include $localtion."/db.php";

function t($message="未指定",$localtion="./"){
    echo "<script language='JavaScript'>alert('$message');location.href='$localtion'</script>;";
}

function things($things){
    $c=$_GET['c'];
    if ($c==$things){
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
    }else{
        $page=1;
    }
    $thing="things_".$things;
    $username=$_SESSION['username'];
    $dns = "mysql:host=127.0.0.1;port=3306;dbname=shop";
    $db = new PDO($dns,'root','LJK1249072779@qq',array(PDO::ATTR_PERSISTENT));
    $db->query("set names utf8");
    header('Content-Type:text/html; charset=UTF-8');
    $count = $db -> query("SELECT COUNT(*) FROM ".$thing) -> fetchColumn();
    $size =10;
    $last = ceil($count/$size);
    $prev_page = $page - 1 < 1 ? 1 : $page - 1;
    $next_page = $page + 1 > $last ? $last : $page + 1;
    $offset = ($page - 1) * $size;
    //print_r($rows=$mysql->doSql("select * from shop where status=0"));
    //print_r($rows[0]=$mysql->doSql("select * from shop where status=0"));
    foreach($db->query("select * from ".$thing." limit $offset,$size") as $rows[0]){
        $id=$rows[0]['id'];
        $huohao=$rows[0]['huohao'];
        $color=$rows[0]['color'];
        $bianhao=$rows[0]['bianhao'];
        $size=$rows[0]['size'];
        $num=$rows[0]['num'];
        $jinjia=$rows[0]['jj'];
        echo " <tr>
                <td>$id</td>
                <td>$things-$bianhao</td>
                <td>$huohao</td>
                <td>$color</td>
                <td>$size</td>
                <td>$num</td>
                ";
        if ($_SESSION['qx']==1){
            echo "<td>$jinjia</td> ";
        }
    }
    echo "</tr> </tbody>
            </table>";
    echo " <div>
        <button class=\"mdui-btn mdui-btn-raised mdui-btn-dense mdui-color-theme-accent mdui-ripple\" onclick=\"location.href='kc.php?c=$things&page=1#$things'\">首页</button>

        <button type=\"button\" class=\"mdui-btn mdui-btn-active\" onclick=\"location.href='kc.php?c=$things&page=$prev_page #$things'\"><i class=\"mdui-icon material-icons\" >arrow_back</i></button>

        <button style=\"width: 20px\" type=\"button\" class=\"mdui-btn\" onclick=\"location.href='kc.php?c=$things&page=$next_page#$things'\"><i class=\"mdui-icon material-icons\" >arrow_forward</i></button>

        <button class=\"mdui-btn mdui-btn-raised mdui-btn-dense mdui-color-theme-accent mdui-ripple\" onclick=\"location.href='kc.php?c=$things&page=$last#$things'\">尾页</button>
    </div>";
}

function things_ifs($things,$color,$type,$hao,$sizes)
{
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    header("content-type:text/html;charset=utf8");
    $dns = "mysql:host=127.0.0.1;port=3306;dbname=shop";
    $db = new PDO($dns, 'root', 'LJK1249072779@qq', array(PDO::ATTR_PERSISTENT));
    $db->query("set names ’utf8’");
    $thing = "things_" . $things;
    if ($type == "bianhao") {//編號
        $num=$db->query("select * from $thing where bianhao='$hao' and size='$sizes' and color='$color'")->rowCount();
        if ($num > 0) {
            $count = $db->query("SELECT COUNT(*) FROM " . $thing." where bianhao='$hao' and size='$sizes' and color='$color'")->fetchColumn();
            $size = 6;
            $last = ceil($count / $size);
            $prev_page = $page - 1 < 1 ? 1 : $page - 1;
            $next_page = $page + 1 > $last ? $last : $page + 1;
            $offset = ($page - 1) * $size;
            //print_r($rows=$mysql->doSql("select * from shop where status=0"));
            //print_r($rows[0]=$mysql->doSql("select * from shop where status=0"));
            foreach ($db->query("select * from " . $thing . " where bianhao='$hao' and size='$sizes' and color='$color' limit $offset,$size") as $rows[0]) {
                $id = $rows[0]['id'];
                $huohao = $rows[0]['huohao'];
                $color=$rows[0]['color'];
                $bianhao = $rows[0]['bianhao'];
                $size = $rows[0]['size'];
                $num = $rows[0]['num'];
                $jinjia = $rows[0]['jj'];
                echo " <tr>
                <td>$id</td>
                <td>$things-$bianhao</td>
                <td>$huohao</td>
                <td>$color</td>
                <td>$size</td>
                <td>$num</td>
                ";
                if ($_SESSION['qx'] == 1) {
                    echo "<td>$jinjia</td> ";
                }
            }
            echo "</tr> </tbody>
            </table>";
        }else{
            t("不存在這個貨物!","./kc.php");
            exit();
        }
    } elseif ($type == "huohao") {//貨號
        $num = $db->query("select * from $thing where huohao='$hao' and size='$sizes' color='$color'")->rowCount();
        if ($num > 0) {
            $count = $db->query("SELECT COUNT(*) FROM " . $thing." where huohao='$hao' and size='$sizes' and color='$color'")->fetchColumn();
            $size = 2;
            $last = ceil($count / $size);
            $prev_page = $page - 1 < 1 ? 1 : $page - 1;
            $next_page = $page + 1 > $last ? $last : $page + 1;
            $offset = ($page - 1) * $size;
            //print_r($rows=$mysql->doSql("select * from shop where status=0"));
            //print_r($rows[0]=$mysql->doSql("select * from shop where status=0"));
            foreach ($db->query("select * from " . $thing . " where huohao='$hao' and size='$sizes' and color='$color' limit $offset,$size") as $rows[0]) {
                $id = $rows[0]['id'];
                $huohao = $rows[0]['huohao'];
                $bianhao = $rows[0]['bianhao'];
                $color=$rows[0]['color'];
                $size = $rows[0]['size'];
                $num = $rows[0]['num'];
                $jinjia = $rows[0]['jj'];
                echo " <tr>
                <td>$id</td>
                <td>$things-$bianhao</td>
                <td>$huohao</td>
                <td>$color</td>
                <td>$size</td>
                <td>$num</td>
                ";
                if ($_SESSION['qx'] == 1) {
                    echo "<td>$jinjia</td> ";
                }
            }
            echo "</tr> </tbody>
            </table>";
        }else{
            t("不存在這個貨物!",'./kc.php');
            exit();
        }
    }
}

function book_list($date){
    echo "<h3>账单日期:".$date."</h3>
<div class=\"mdui-table-fluid\">
  <table class=\"mdui-table mdui-table-hoverable\">
    <thead>
      <tr>
        <th>#</th>
        <th>编号/货号</th>
        <th>尺码</th>
        <th>颜色</th>
        <th>支付方式</th>
        <th>出售价格</th>
        <th>数量</th>
      </tr>
    </thead>
    <tbody>
   
";
    $money_add=0;
    foreach (link_admin()->query("SELECT * FROM `book` WHERE `time` BETWEEN '".$date." 00:00:00' AND '".$date." 23:59:59'") as $row ){
        $money_add=$money_add+$row['money'];
        echo "<tr>";
        echo "<td>".$row['uid']."</td>";
        echo "<td>".$row['things']."-".$row['name']."</td>";
        echo "<td>".$row['size']."</td>";
        echo "<td>".$row['color']."</td>";
        switch ($row['method']){
            case 0:
                echo "<td>现金支付</td>";
                break;
            case 1:
                echo "<td>微信支付</td>";
                break;
            case 2:
                echo "<td>支付宝支付</td>";
                break;
            case 3:
                echo "<td>银行卡支付</td>";
                break;
            case 4:
                echo "<td>未知</td>";
                break;
            default:
                echo "<td>未知</td>";
                break;
        }
        echo "<td>".$row['money']."</td>";
        echo "<td>".$row['num']."</td>";
        echo "</tr>";
    }
    echo "
    </tbody>
  </table>
  <h2>总金额:".$money_add."</h2>
</div>";
}


