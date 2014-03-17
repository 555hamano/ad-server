<?php
#$res = get_data(null, null);
#foreach ($res as $key => $value){
#     foreach($value as $in_key => $in_value){
#         print $in_key.'=>'.$in_value."<br />";
#     }
#}

function get_data($sex, $age){
    $ini      = parse_ini_file("ad.ini");
    $DB_USER  = $ini['DB_USER'];
    $DB_PW    = $ini['DB_PW'];
    $DB_URL   = $ini['DB_URL']; 
    $DB       = $ini['DB'];
    #print_r($ini);
    $link = mysql_connect($DB_URL, $DB_USER, $DB_PW) or die("connection fault");
    $sdb = mysql_select_db($DB, $link) or die("select fault");
    $sql = "SELECT  ca.id, ca.sex, ca.age_range_id, ca.banner, ca.lp_url, ca.cpm, ca.cpc, ca.ecpm as weight, ca.budget FROM campaigns ca";

    if(isset($sex) && ($sex == 0 || $sex == 1) && (isset($age) && $age > 0)){
        $sql .= ", age_ranges ar where ca.sex = $sex and (ar.min <= $age and ar.max >= $age) and ca.age_range_id = ar.id";
    }elseif(isset($sex) && ($sex == 0 || $sex == 1) && (is_null($age) || $age < 0)){
        $sql .= " where ca.sex = $sex";
    }elseif((is_null($sex) || $sex > 1 || $sex < 0) && (isset($age) && $age > 0)){
        $sql .= ", age_ranges ar where (ar.min <= $age and ar.max >= $age) and ca.age_range_id = ar.id"; 
    }  
    lprint($sql);
    $result = mysql_query($sql, $link) or die("Query fault<br />SQL:".$sql);
    $row = mysql_num_rows($result);
    #mysql_free_result($result);
    mysql_close($link) or die("close fault");
    $res = array();
    while ($rows = mysql_fetch_assoc($result)){
        lprint($rows['id']."<br />");
        lprint($rows['sex']."<br />");
        lprint($rows['age_range_id']."<br />");
        lprint($rows['banner']."<br />");
        lprint($rows['lp_url']."<br />");
        lprint($rows['cpm']."<br />");
        lprint($rows['cpc']."<br />");
        lprint($rows['weight']."<br />");
        lprint($rows['budget']."<br />");
        $res[] = $rows;
    }
    return $res;
}

function lprint($str){
    $flg = 0;
    if($flg == 1){
       print($str);
    }
}  
?>
