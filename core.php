<?php
session_start();
include('includes/config.php');
class Init{
    function domestic($kwh,$house){
        return $house*$kwh/24;
    }

    function educational($kwh,$edu){
        return $kwh*$edu;
    }

    function hospital($kwh,$hos){
        return $kwh*$hos;
    }

    function shop($kwh,$shop){
        return $kwh*$shop;
    
    }
    function commercial($gen,$dom,$edu,$hos,$shop){
        return ($gen-($dom+$edu+$hos+$shop))*0.4;
    }

}

class Cluster{
    private $house_count;
    private $fixed_count;
    public $cluster_size;
    private $variable_count,$production,$total,$off_count,$times,$gen_work,$no_gen;

    function __construct($house,$fixed,$variable,$production,$gen_work,$no_gen)
    {
        $this->house_count=$house;
        $this->fixed_count=$fixed;
        $this->variable_count=$variable;
        $this->production=$production;
        $this->gen_work=$gen_work;
        $this->no_gen=$no_gen;
    }

    function generator(){
        return (24-$this->gen_work*$this->no_gen)*60;
    }

    function clust(){
        return $this->times;
    }

    function calc(){
        $this->total=$this->variable_count+$this->fixed_count-$this->production;
        $this->off_count=($this->total/$this->variable_count)*$this->house_count;
        // echo $this->total;
        $this->times = $this->generator()/(15*ceil(($this->variable_count/$this->total)));
        $this->cluster_size=ceil($this->house_count/$this->off_count);

        return $this->cluster_size*$this->times;
    }

}

$r=new Init();

$x_day=new Cluster(16000,750,$r->domestic(10,16000),7000,10,2);
$x_day=$x_day->calc();
$l=$r->domestic(10,16000);
// echo "<script type='text/javascript' >alert('$l')</script>";
// $x_day=$x_day->off_count;

$x_night=new Cluster(16000,750,$r->domestic(10,16000)*1.1,7000,10,2);
$x_night=$x_night->calc();
// echo $x_day;
// echo $x_night;
// echo date('H:i:s', strtotime('10:10:20 + 15 minute'));
// echo $r->domestic(10,16000);
// echo $r->commercial(20000,$r->domestic(10,16000),$r->educational(400,2),$r->hospital(750,1),10);
$hospital=[];
$houses=[];
$com=[];
$edu=[];
$shop=[];
for($i=0;$i<24;$i++){
    $hospital[$i]=750;
    if($i<=16){
        $houses[$i]=$r->domestic(10,16000);
    }else{
        $houses[$i]=$r->domestic(10,16000)*1.1;
    }
    if($i>=9&&$i<17){
        $com[$i]=$r->commercial(20000,$r->domestic(10,16000),$r->educational(400,2),$r->hospital(750,1),10);
        $edu[$i]=$r->educational(400,2);
        if($i==9){
            $shop[$i]=10;
        }else{
            $shop[$i]=$shop[$i-1]*1.3;
        }
    }else{
        $com[$i]=0;
        $edu[$i]=0;
        $shop[$i]=0;
    }
}
$total=[];
for($i=0;$i<24;$i++){
    $total[$i]=$houses[$i]+$hospital[$i]+$com[$i]+$edu[$i]+$shop[$i];
}

// for($i=0;$i<$x_day;$i++){
//     echo date('H:i:s',strtotime('05:00:00 ')+15*$i*60);
//     echo '  CLUSTER ';
//     echo $i;
//     echo "<br>";
//     // $time+='15 minute';
// }

// $x_night=floor($x_night);

// for($i=0;$i<$x_night;$i++){
//     echo date('H:i:s',strtotime('17:00:00 ')+15*$i*60);
//     echo '  CLUSTER ';
//     echo ($i)%7;
//     echo "<br>";
//     // $time+='15 minute';
// }

?>