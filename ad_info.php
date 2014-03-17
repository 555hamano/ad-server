<?php
function get_ad_info($sex, $age){
    $fp = fopen("sample.txt", "r");
    while ($line = fgets($fp)) {
        echo "$line<br />";
    }
    fclose($fp);
}
?>
