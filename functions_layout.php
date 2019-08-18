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
 * 創建時間：2019-08-12-14:51
 * 所屬項目名稱：PE-System
 */


/**
 * @param $title
 */
function top_menu($title){
    echo "
<div class=\"mdui-appbar mdui-appbar-fixed\">
    <div class=\"mdui-toolbar mdui-color-theme\">
       
        <a href=\"javascript:;\" class=\"mdui-typo-headline\">体育分析系统</a>
        <a href=\"javascript:;\" class=\"mdui-typo-title\">$title</a>
        <div class=\"mdui-toolbar-spacer\"></div>
        <a href=\"javascript:;\" class=\"mdui-btn mdui-btn-icon\"><i class=\"mdui-icon material-icons\" onclick='window.location.reload()' '>refresh</i></a>
        <a href=\"javascript:;\" class=\"mdui-btn mdui-btn-icon\"><i class=\"mdui-icon material-icons\">more_vert</i></a>
    </div>
</div>";
}

function fen_table($name,$school){
echo "<div class=\"mdui-table-fluid\">";
echo "<thead>
        <tr>
            <th>50米成绩</th>
            <th>长跑成绩</th>
            <th>".get_choose_name($_SESSION['info']['choose_what'])."</th>
            <th>总成绩</th>
        </tr>
        </thead>
        <tbody>";
$test_num=get_newest_test($school);
$info=get_test_res($school,$name,$test_num);
$short_res=$info['short_run_res'];
$long_res=$info['long_run_res'];
$choose_res=$info['choose_res'];
$short_sc=$info['short_run_sc'];
$long_sc=$info['long_run_sc'];
$choose=$info['choose_sc'];
echo "<tr>
<td>$short_res</td>
<td>$long_res</td>
<td>$choose_res</td>
</tr>
</tbody>
";



}