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

/**
 * @param string $message
 * @param string $localtion
 */
function t($message="未指定",$localtion="./"){
    echo "<script language='JavaScript'>alert('$message');location.href='$localtion'</script>;";
}

/**
 * @param $name
 * @return array
 */
function get_info($name){
    $info=link_admin()->query("select * from student where name='$name'")->fetch_array();
    $class=$info['class'];
    $grade=$info['grade'];
    $school=$info['school'];
    $test_num=$info['test_num'];
    $uid=$info['uid'];
    $sex=$info['sex'];
    $high=$info['high'];
    $weight=$info['weight'];
    $res=array("class"=>$class,"grade"=>$grade,"school"=>$school,"test_num"=>$test_num,"uid"=>$uid,"sex"=>$sex,"high"=>$high,"weight"=>$weight);
    return $res;
}

/**
 * @param $school_num
 * @return mixed
 */
function get_school_name_by_school_num($school_num){
    $school_name=link_admin()->query("select * from school where uid='$school_num'")->fetch_array()['name'];
    return $school_name;
}

/**
 * @param $name
 * @return mixed
 */
function get_school_name_by_user_name($name){
    $school_num=get_info($name)['school'];
    $names=get_school_name_by_school_num($school_num);
    return $names;
}

/**
 * @param $school_num
 * @return mixed
 */
function get_newest_test($school_num){
    $time_array=array();
    $num=link_admin()->query("select * from test_name where school='$school_num'")->num_rows;
    if ($num>1){
        $bi=0;
        $test_all=link_admin()->query("select * from test_name where school='$school_num'")->fetch_all();
        foreach ($test_all as $row => $item){
            $time=$test_all[$row][4];
            if ($bi==0){
                $bi=$time;
            }else{
                if ($time>$bi){
                    $bi=$time;
                }
            }
        }
        $id=link_admin()->query("select * from test_name where date='$bi'")->fetch_array()['id'];
        return $id;
    }else{
        $id=link_admin()->query("select * from test_name where school='$school_num'")->fetch_array()['id'];
        return $id;
    }


}

function get_test_info($school,$test){
        $info=link_admin()->query("select * from test_res where school='$school' and test_num='$test'")->fetch_all();
}

/**
 * @param $sex
 * @param $fen
 * @return int
 * 获取短跑成绩
 */
function get_res_short_run($sex,$fen){
    if ($sex=="1"){//男
        if ($fen<=6.9){
            $res=20;
        }elseif ($fen<=7.1 and $fen>6.9){
            $res=19;
        }elseif ($fen<=7.3 and $fen>7.1){
            $res=18;
        }elseif ($fen<=7.5 and $fen>7.3){
            $res=17;
        }elseif ($fen<=7.7 and $fen>7.5){
            $res=16;
        }elseif ($fen<=7.9 and $fen>7.7){
            $res=15;
        }elseif ($fen<=8.1 and $fen>7.9){
            $res=14;
        }elseif ($fen<=8.3 and $fen>8.1){
            $res=13;
        }elseif ($fen<=8.5 and $fen>8.3){
            $res=12;
        }elseif ($fen<=8.7 and $fen>8.5){
            $res=11;
        }elseif ($fen<=8.8 and $fen>8.7){
            $res=10;
        }elseif ($fen==8.9){
            $res=9;
        }elseif ($fen>8.9 and $fen<9.0){
            $res=8;
        }elseif ($fen==9.0){
            $res=7;
        }elseif ($fen>9.0 and $fen<9.1){
            $res=6;
        }elseif ($fen==9.1){
            $res=5;
        }elseif ($fen>9.1){
            $res=4;
        }
        return $res;
    }elseif($sex=="0"){//女
        if ($fen<=7.9){
            $res=20;
        }elseif ($fen<=8.1 and $fen>6.9){
            $res=19;
        }elseif ($fen<=8.3 and $fen>8.1){
            $res=18;
        }elseif ($fen<=8.5 and $fen>8.3){
            $res=17;
        }elseif ($fen<=8.7 and $fen>8.5){
            $res=16;
        }elseif ($fen<=8.9 and $fen>8.7){
            $res=15;
        }elseif ($fen<=9.1 and $fen>8.9){
            $res=14;
        }elseif ($fen<=9.3 and $fen>9.1){
            $res=13;
        }elseif ($fen<=9.5 and $fen>9.3){
            $res=12;
        }elseif ($fen<=9.7 and $fen>9.5){
            $res=11;
        }elseif ($fen<=9.8 and $fen>9.7){
            $res=10;
        }elseif ($fen==9.9){
            $res=9;
        }elseif ($fen>9.9 and $fen<10.0){
            $res=8;
        }elseif ($fen==10.0){
            $res=7;
        }elseif ($fen>10.0 and $fen<10.1){
            $res=6;
        }elseif ($fen==10.1){
            $res=5;
        }elseif ($fen>10.1){
            $res=4;
        }
        return $res;
    }






}

/**
 * @param $sex
 * @param $fen
 * @return int
 * 获取长跑成绩
 */
function get_res_long_run($sex,$fen){
    if ($sex ==1){//男生1000米
        if ($fen<=3.35){
            $res=22;
        }elseif ($fen<=3.40 and $fen>3.35){
            $res=21;
        }elseif ($fen<=3.45 and $fen>3.40){
            $res=20;
        }elseif ($fen<=3.50 and $fen>3.45){
            $res=19;
        }elseif ($fen<=3.55 and $fen>3.50){
            $res=18;
        }elseif ($fen<=4.00 and $fen>3.55){
            $res=17;
        }elseif ($fen<=4.06 and $fen>4.00){
            $res=16;
        }elseif ($fen<=4.12 and $fen>4.06){
            $res=15;
        }elseif ($fen<=4.18 and $fen>4.12){
            $res=14;
        }elseif ($fen<=4.24 and $fen>4.18){
            $res=13;
        }elseif ($fen<=4.29 and $fen>4.24){
            $res=12;
        }elseif ($fen<=4.34 and $fen>4.29){
            $res=11;
        }elseif ($fen<=4.39 and $fen>4.34){
            $res=10;
        }elseif ($fen<=4.44 and $fen>4.39){
            $res=9;
        }elseif ($fen<=4.49 and $fen>4.44){
            $res=8;
        }elseif ($fen<=4.54 and $fen>4.49){
            $res=7;
        }elseif ($fen<=5.06 and $fen>4.54){
            $res=6;
        }elseif ($fen<=4.54 and $fen>5.06){
            $res=5;
        }elseif ($fen>5.06){
            $res=4;
        }
        return $res;
    }//男子1000米
    elseif($sex==0){//女生800米

        if ($fen<=3.22){
            $res=22;
        }elseif ($fen<=3.26 and $fen>3.22){
            $res=21;
        }elseif ($fen<=3.30 and $fen>3.26){
            $res=20;
        }elseif ($fen<=3.34 and $fen>3.30){
            $res=19;
        }elseif ($fen<=3.39 and $fen>3.34){
            $res=18;
        }elseif ($fen<=3.44 and $fen>3.39){
            $res=17;
        }elseif ($fen<=3.49 and $fen>3.44){
            $res=16;
        }elseif ($fen<=3.54 and $fen>3.49){
            $res=15;
        }elseif ($fen<=3.59 and $fen>3.54){
            $res=14;
        }elseif ($fen<=4.04 and $fen>3.59){
            $res=13;
        }elseif ($fen<=4.09 and $fen>4.04){
            $res=12;
        }elseif ($fen<=4.14 and $fen>4.09){
            $res=11;
        }elseif ($fen<=4.19 and $fen>4.14){
            $res=10;
        }elseif ($fen<=4.24 and $fen>4.19){
            $res=9;
        }elseif ($fen<=4.28 and $fen>4.24){
            $res=8;
        }elseif ($fen<=4.32 and $fen>4.28){
            $res=7;
        }elseif ($fen<=4.36 and $fen>4.32){
            $res=6;
        }elseif ($fen<=4.40 and $fen>4.36){
            $res=5;
        }elseif ($fen>4.40){
            $res=4;
        }
        return $res;
    }//女子800米

}

/**
 * @param $sex
 * @param $choose
 * @param $fen
 * @return int
 * $choose -> 1为实心球,2为立定跳远,3为仰卧起坐,4为跳绳,5为引体向上
 */
function get_res_choose($sex,$choose,$fen){
    if ($sex==1){//当性别为男
        if ($choose==1){
            if ($fen>=11.0){//男子实心球
                $res=18;
            }elseif ($fen>=10.4 and $fen<11.0){
                $res=17;
            }elseif ($fen>=9.9 and $fen<10.4){
                $res=16;
            }elseif ($fen>=9.4 and $fen<9.9){
                $res=15;
            }elseif ($fen>=8.9 and $fen<9.4){
                $res=14;
            }elseif ($fen>=8.4 and $fen<8.9){
                $res=13;
            }elseif ($fen>=7.9 and $fen<8.4){
                $res=12;
            }elseif ($fen>=7.4 and $fen<7.9){
                $res=11;
            }elseif ($fen>=6.9 and $fen<7.4){
                $res=10;
            }elseif ($fen>=6.4 and $fen<6.9){
                $res=9;
            }elseif ($fen>=5.9 and $fen<6.4){
                $res=8;
            }elseif ($fen>=5.4 and $fen<5.9){
                $res=7;
            }elseif ($fen>=4.9 and $fen<5.4){
                $res=6;
            }elseif ($fen>=4.4 and $fen<4.9){
                $res=5;
            }elseif ($fen<4.4){
                $res=4;
            }
            return $res;
        }//男子实心球
        if ($choose==2){
            if ($fen>=2.48){
                $res=18;
            }elseif ($fen>=2.43 and $fen<2.48){
                $res=17;
            }elseif ($fen>=2.38 and $fen<2.43){
                $res=16;
            }elseif ($fen>=2.33 and $fen<2.38){
                $res=15;
            }elseif ($fen>=2.28 and $fen<2.33){
                $res=14;
            }elseif ($fen>=2.23 and $fen<2.28){
                $res=13;
            }elseif ($fen>=2.18 and $fen<2.23){
                $res=12;
            }elseif ($fen>=2.13 and $fen<2.18){
                $res=11;
            }elseif ($fen>=2.08 and $fen<2.13){
                $res=10;
            }elseif ($fen>=2.03 and $fen<2.08){
                $res=9;
            }elseif ($fen>=1.98 and $fen<2.03){
                $res=8;
            }elseif ($fen>=1.93 and $fen<1.98){
                $res=7;
            }elseif ($fen>=1.88 and $fen<1.93){
                $res=6;
            }elseif ($fen>=1.83 and $fen<1.88){
                $res=5;
            }elseif ($fen<1.83){
                $res=4;
            }
            return $res;
        }//男子立定跳远
        if ($choose==4){
            if ($fen>=175){
                $res=18;
            }elseif ($fen>=165 and $fen<175){
                $res=17;
            }elseif ($fen>=155 and $fen<175){
                $res=16;
            }elseif ($fen>=145 and $fen<155){
                $res=15;
            }elseif ($fen>=135 and $fen<145){
                $res=14;
            }elseif ($fen>=125 and $fen<135){
                $res=13;
            }elseif ($fen>=115 and $fen<125){
                $res=12;
            }elseif ($fen>=105 and $fen<115){
                $res=11;
            }elseif ($fen>=95 and $fen<105){
                $res=10;
            }elseif ($fen>=85 and $fen<95){
                $res=9;
            }elseif ($fen>=75 and $fen<85){
                $res=8;
            }elseif ($fen>=65 and $fen<75){
                $res=7;
            }elseif ($fen>=55 and $fen<65){
                $res=6;
            }elseif ($fen>=45 and $fen<55){
                $res=5;
            }elseif ($fen<45){
                $res=4;
            }
            return $res;
        }//男子跳绳
        if ($choose==5){
            if ($fen>=12){
                $res=18;
            }elseif ($fen==11){
                $res=17;
            }elseif ($fen==10){
                $res=16;
            }elseif ($fen==9){
                $res=15;
            }elseif ($fen==8){
                $res=14;
            }elseif ($fen==7){
                $res=12;
            }elseif ($fen==6){
                $res=11;
            }elseif ($fen==5){
                $res=10;
            }elseif ($fen==4){
                $res=9;
            }elseif ($fen==3){
                $res=7;
            }elseif ($fen==2){
                $res=6;
            }elseif ($fen==1){
                $res=5;
            }elseif ($fen==0){
                $res=4;
            }
            return $res;
        }//男子引体向上
    }elseif($sex==0){//当性别为女
        if ($choose==1){
            if ($fen>=7.5){//女子实心球
                $res=18;
            }elseif ($fen>=7.1 and $fen<7.5){
                $res=17;
            }elseif ($fen>=6.7 and $fen<7.1){
                $res=16;
            }elseif ($fen>=6.3 and $fen<6.7){
                $res=15;
            }elseif ($fen>=5.9 and $fen<6.3){
                $res=14;
            }elseif ($fen>=5.5 and $fen<5.9){
                $res=13;
            }elseif ($fen>=5.2 and $fen<5.5){
                $res=12;
            }elseif ($fen>=4.9 and $fen<5.2){
                $res=11;
            }elseif ($fen>=4.6 and $fen<4.9){
                $res=10;
            }elseif ($fen>=4.3 and $fen<4.6){
                $res=9;
            }elseif ($fen>=4.0 and $fen<4.3){
                $res=8;
            }elseif ($fen>=3.7 and $fen<4.0){
                $res=7;
            }elseif ($fen>=3.4 and $fen<3.7){
                $res=6;
            }elseif ($fen>=3.1 and $fen<3.4){
                $res=5;
            }elseif ($fen<3.1){
                $res=4;
            }
            return $res;
        }//女子实心球
        if ($choose==2){
            if ($fen>=2.00){
                $res=18;
            }elseif ($fen>=1.96 and $fen<2.00){
                $res=17;
            }elseif ($fen>=1.92 and $fen<1.96){
                $res=16;
            }elseif ($fen>=1.88 and $fen<1.92){
                $res=15;
            }elseif ($fen>=1.84 and $fen<1.88){
                $res=14;
            }elseif ($fen>=1.80 and $fen<1.84){
                $res=13;
            }elseif ($fen>=1.76 and $fen<1.80){
                $res=12;
            }elseif ($fen>=1.72 and $fen<1.76){
                $res=11;
            }elseif ($fen>=1.68 and $fen<1.72){
                $res=10;
            }elseif ($fen>=1.64 and $fen<1.68){
                $res=9;
            }elseif ($fen>=1.60 and $fen<1.64){
                $res=8;
            }elseif ($fen>=1.56 and $fen<1.60){
                $res=7;
            }elseif ($fen>=1.52 and $fen<1.56){
                $res=6;
            }elseif ($fen>=1.48 and $fen<1.52){
                $res=5;
            }elseif ($fen<1.48){
                $res=4;
            }
            return $res;
        }//女子立定跳远
        if ($choose==3){
            if ($fen>=50){
                $res=18;
            }elseif ($fen>=48 and $fen<50){
                $res=17;
            }elseif ($fen>=46 and $fen<48){
                $res=16;
            }elseif ($fen>=44 and $fen<46){
                $res=15;
            }elseif ($fen>=42 and $fen<44){
                $res=14;
            }elseif ($fen>=40 and $fen<42){
                $res=13;
            }elseif ($fen>=38 and $fen<40){
                $res=12;
            }elseif ($fen>=36 and $fen<38){
                $res=11;
            }elseif ($fen>=34 and $fen<36){
                $res=10;
            }elseif ($fen>=32 and $fen<34){
                $res=9;
            }elseif ($fen>=30 and $fen<32){
                $res=8;
            }elseif ($fen>=28 and $fen<30){
                $res=7;
            }elseif ($fen>=26 and $fen<28){
                $res=6;
            }elseif ($fen>=24 and $fen<26){
                $res=5;
            }elseif ($fen<24){
                $res=4;
            }
            return $res;
        }//女子仰卧起坐
        if ($choose==4){
            if ($fen>=170){
                $res=18;
            }elseif ($fen>=160 and $fen<170){
                $res=17;
            }elseif ($fen>=150 and $fen<160){
                $res=16;
            }elseif ($fen>=140 and $fen<150){
                $res=15;
            }elseif ($fen>=130 and $fen<140){
                $res=14;
            }elseif ($fen>=120 and $fen<130){
                $res=13;
            }elseif ($fen>=110 and $fen<120){
                $res=12;
            }elseif ($fen>=100 and $fen<110){
                $res=11;
            }elseif ($fen>=90 and $fen<100){
                $res=10;
            }elseif ($fen>=80 and $fen<90){
                $res=9;
            }elseif ($fen>=70 and $fen<80){
                $res=8;
            }elseif ($fen>=60 and $fen<70){
                $res=7;
            }elseif ($fen>=50 and $fen<60){
                $res=6;
            }elseif ($fen>=40 and $fen<50){
                $res=5;
            }elseif ($fen<40){
                $res=4;
            }
            return $res;
        }//女子跳绳
    }
}







