<?php

error_reporting(-1);
ini_set('display_errors', 1);
include_once "../db.php";

require_once 'PHPExcel.php';
require_once 'PHPExcel/IOFactory.php';
require_once 'PHPExcel/Reader/Excel5.php';
//以上三步加载phpExcel的类
$objReader = PHPExcel_IOFactory::createReader('Excel5');//use excel2007 for 2007 format
$filename="./1710.xls";//指定excel文件从上传中取出
$objPHPExcel = $objReader->load($filename); //$filename可以是上传的文件，或者是指定的文件
$sheet = $objPHPExcel->getSheet(0); 
$highestRow = $sheet->getHighestRow(); // 取得总行数 
$highestColumn = $sheet->getHighestColumn(); // 取得总列数
$k = 0;
//循环读取excel文件,读取一条,插入一条
//j表示从哪一行开始读取
//$a表示列号

for($j=2;$j<=$highestRow;$j++)
{
    $study_hao = $objPHPExcel->getActiveSheet()->getCell("A".$j)->getValue();//获取A列的值
    $name= $objPHPExcel->getActiveSheet()->getCell("B".$j)->getValue();//获取B列的值
    $sex = $objPHPExcel->getActiveSheet()->getCell("C".$j)->getValue();//获取C列的值
    $pwd=rand(100000000,9999999999);
    $pwds=md5($pwd);
    $uid=rand(10000000,99999999);
    if (link_admin()->query("select * from student where uid='$uid'")->num_rows>0){
        $uid=rand(1000000,9999999);
    }
    if ($sex=="男"){
        $sex=1;
    }else{
        $sex=0;
    }
	$sql = "INSERT INTO student (uid,study_hao, name, grade, class, pwd, school, sex,pwds)
	VALUES ('$uid','$study_hao','$name','9','10','$pwds','1','$sex','$pwd')";
	$result=link_admin()->query($sql);
	if($result){
		echo "OK<br>";
	}
	else{
	    echo "失败<br>";
	}
}


?>