<?php
#$data[] = array("id"=>1, "weight"=>2);
#$data[] = array("id"=>2, "weight"=>1);
#$data[] = array("id"=>3, "weight"=>2);
#$data[] = array("id"=>4, "weight"=>2);
#$data[] = array("id"=>5, "weight"=>2);

$cnt            = -1;
$current_weight = 0;
$max            = 0;
#get_weighted_data($data);

function get_weighted_data($data){
    log_print("count: ".count($data));
    $data_cnt = mt_rand(1, count($data));
    for($ij = 0; $ij < $data_cnt; $ij++){ 
        $arr = select_data($data);
    }
    if(count($arr) > 0){
        return $arr["id"];
    }else{
        return null;
    }
}
function select_data($data){
    $list = array();
    $gcd  = 0;
    global $max;
    global $cnt;
   
    for($ix = 0; $ix < count($data); $ix++){
        #print_r($data[$ix]);
        $list[] = $data[$ix];
        if(count($list) == 1){
            $gcd = $list[0]["weight"];
            $max = $list[0]["weight"];
        }else{
            log_print($gcd.":".$list[count($list)-1]["weight"]."-----<br />");
            $gcd = gcd($gcd, $list[count($list)-1]["weight"]);
            log_print($gcd.":".$list[count($list)-1]["weight"]."-----<br />");
            if($max < $list[count($list)-1]["weight"]){
                $max = $list[count($list)-1]["weight"];
            }
        }
        log_print("gcd:$gcd, max:$max<br />");
    }
    global $current_weight;
    
    while (1) {
        $cnt = ($cnt + 1) % count($list);
        if ($cnt == 0){
            $current_weight = $current_weight - $gcd;
            if ($current_weight <= 0) {
                $current_weight = $max;
                if ($current_weight == 0){
                    return null;
                }
            }
        }
        if($list[$cnt]["weight"] >= $current_weight){
            return $list[$cnt];
        }
    }
}
function gcd($m, $n){
    if($n > $m) list($m, $n) = array($n, $m);
   
    while($n !== 0){
        $tmp_n = $n;
        $n = $m % $n;
        $m = $tmp_n;
        log_print("m:$m<br />");
        log_print("n:$n<br />");
        log_print("tmp_n:$tmp_n<br />");
    
    }
    log_print("m:$m<br />");
    return $m;
}

function log_print($str){
    $flg = 0;
    if($flg == 1){
        print($str);
    }
} 
?>
