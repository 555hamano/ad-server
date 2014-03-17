<?php
    $ini      = parse_ini_file("ad.ini");
    $DB_USER  = $ini['DB_USER'];
    $DB_PW    = $ini['DB_PW'];
    $DB_URL   = $ini['DB_URL']; 
    $DB       = $ini['DB'];
    #print_r($ini);
    $link = mysql_connect($DB_URL, $DB_USER, $DB_PW) or die("connection fault");
    $sdb = mysql_select_db($DB, $link) or die("select fault");
    $sql = "SELECT  id, sex, age_range_id, banner, lp_url, cpm, cpc, serve_cnt, budget FROM campaigns";
    $result = mysql_query($sql, $link) or die("Query fault<br />SQL:".$sql);
    $row = mysql_num_rows($result);
    #mysql_free_result($result);
    mysql_close($link) or die("close fault");
    $res = array();
    while ($rows = mysql_fetch_assoc($result)){
        print $rows['id']."<br />";
        print $rows['sex']."<br />";
        print $rows['age_range_id']."<br />";
        print $rows['banner']."<br />";
        print $rows['lp_url']."<br />";
        print $rows['cpm']."<br />";
        print $rows['cpc']."<br />";
        print $rows['serve_cnt']."<br />";
        print $rows['budget']."<br />";
        $res[] = $raow;
    }
  
?>

<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=SHIFT-JIS">
    <title>all data</title>
  </head>
  <body>
    connectin Id:<?= $link ?><br />
    select:<?= $sdb ?><br />
    result:<?= $result ?><br />
    line:<?= $rows ?><br />
  </body>
</html>
