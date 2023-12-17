<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Insert Sample Data into Redis</title>
</head>

<body>
<h3>Loading...</h3>
<?php
require 'connect.php';

for ($subjectIndex = 1; $subjectIndex <= 12; $subjectIndex++) {
    // Insert a new subject into DM
    $dob = new DateTime('2010-12-30 23:21:46');
    $dm = [
        'brthdtc' => $dob->format(DateTime::ATOM),
        'sex' => 'f',
        'race' => 'caucasian',
        'country' => 'usa',
        'last_visitnum' => 0,
        'last_coseq' => 0
    ];
    $usubjid = $redis->incr("$me:$studyid:last_usubjid");
    $key = "$me:DM:$studyid:$usubjid";
    $redis->hMset($key, $dm);

    // Insert comments (CO) for the above subject
    for ($commentIndex = 1; $commentIndex <= 3; $commentIndex++) {
        $last_coseq = $redis->hIncrBy("$me:DM:$studyid:$usubjid", 'last_coseq', 1);
        $now=new DateTime(date("Y-m-d H:i:s"));
        $co = [
            'codtc' => $now->format(DateTime::ATOM),
            'coval' => "Comment for subject $usubjid, comment $commentIndex"
        ];
        $key = "$me:CO:$studyid:$usubjid:$last_coseq";
        $redis->hMset($key, $co);
    }

    // Insert visits (SV) for the above subject
    for($visitIndex=1;$visitIndex<=5;$visitIndex++){
        $last_visitnum = $redis->hIncrBy("$me:DM:$studyid:$usubjid", 'last_visitnum', 1);
        $start=new DateTime(date("Y-m-d H:i:s"));
        $end=new DateTime(date("Y-m-d H:i:s"));
        $sv = [
            'svstdtc' => $start->format(DateTime::ATOM),
            'svendtc' => $end->format(DateTime::ATOM),
            'visit' => "Visit for subject $usubjid, visit $visitIndex"
        ];
        $key = "$me:SV:$studyid:$usubjid:$last_visitnum";
        $redis->hMset($key, $sv);
    }
}

echo "<!-- closed: " . $redis->close() . ". -->\n";
header('Location: study10.php');
?>
</body>
</html>
