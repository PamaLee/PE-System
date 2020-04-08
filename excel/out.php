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
 * 創建時間：下午1:58
 * 所屬項目名稱：PE-System
 */

include_once "../db.php";
?>



<table border="0">
    <tr>
        <td>班级</td>
        <td>学号</td>
        <td>姓名</td>
        <td>性别</td>
        <td>初始密码</td>
    </tr>

        <?php

        $sql=link_admin()->query("select * from student where class='10' ORDER BY `study_hao` ASC");
        foreach ($sql as $user){
            $class=10;
            $name=$user['name'];
                $study_hao=$user['study_hao'];
            $sex=$user['sex'];
            $pwd=$user['pwds'];
            if ($sex==1){
                $sex="男";
            }else{
                $sex="女";
            }
            echo " <tr>";
            echo "<th>$class</th>";
            echo "<th>$study_hao</th>";
            echo "<th>$name</th>";
            echo "<th>$sex</th>";
            echo "<th>$pwd</th>";
            echo "</tr>";
        }
        ?>

</table>