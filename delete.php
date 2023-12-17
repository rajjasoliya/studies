<?php
include_once('connect.php');
$usubjid=isset($_GET['usubjid'])?intval($_GET['usubjid']):null;
if (!$usubjid) {
    header("Location: study657585.php");
    exit();
}
$redis->del("$me:DM:$studyid:$usubjid");
$redis->del("$me:CO:$studyid:$usubjid");
$redis->del("$me:SV:$studyid:$usubjid");
header("Location: study657585.php");
exit();
?>
