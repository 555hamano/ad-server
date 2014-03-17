<?php
require_once "db_info.php";
require_once "weighted_data.php";
$ini      = parse_ini_file("ad.ini");
$IMG_HEAD = '<img src="';
$IMG_TAIL = '">';
$URL      = $ini['URL'];
$LP_HEAD  = '<A Href="';
$LP_MID   = ' Target="_top">';
$LP_END   = '</A>';
$DB_USER  = $ini['DB_USER'];
$DB_PW    = $ini['DB_PW'];

/********Get campaign data*******/
/*** (input) 1.sex, 2.age *******/
/*** (scoring) ecpm *************/
$sex = isset($_GET['s']) ? $_GET['s'] : null;
$age = isset($_GET['a']) ? ($_GET['a'] < 4 ? 4 : $_GET['a']) : null;
$data = get_data($sex, $age);
#print_r($data);
$id   = get_weighted_data($data);
/*** (output)1.banner url, 2.lp */
$display_row = array();
foreach($data as $row){
    if($row['id'] == $id){
       #print_r($row);
       $display_row = $row;
    }
}
echo $LP_HEAD.$display_row['lp_url'].$LP_MID.$IMG_HEAD.$URL.$display_row['banner'].$IMG_TAIL.$LP_END;

?>
