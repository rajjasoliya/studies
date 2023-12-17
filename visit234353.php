<?php
include_once('connect.php');
$usubjid=isset($_GET['usubjid'])?intval($_GET['usubjid']):null;
if (!$usubjid) {
    header("Location: study657585.php");
    exit();
}
$keySV = "$me:SV:$studyid:$usubjid";
$keyDM = "$me:DM:$studyid:$usubjid";
if($_SERVER['REQUEST_METHOD']=='POST'){
    $visitnum = $redis->hIncrBy($keyDM, 'last_visitnum', 1);
    $data = [
        'svstdtc' => $_POST['svstdtc'],
        'svendtc' => $_POST['svendtc'],
        'visit' => $_POST['visit'],
    ];

    $redis->hMset("$keySV:$visitnum", $data);
}
$lastVisitnum = $redis->hGet($keyDM, 'last_visitnum');
$visits = [];
for ($i = 1; $i <= $lastVisitnum; $i++) {
    $visitData = $redis->hGetAll("$keySV:$i");
    if (!empty($visitData)) {
        $visits[] = $visitData;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            /* whole page spacing */ padding: 20px;
        }
    </style>
    <title>
        Subject Visits
    </title>
</head>
<body>
    <h2>
        Total Visits: <?php
         echo count($visits);
         ?>
    </h2>
    <?php foreach($visits as $visit){?>
        <div>
            <strong>
                Start Date and Time:</strong> 
                <?php echo $visit['svstdtc']; ?>
                <br>
            <strong>
                End Date and Time:</strong> 
                <?php echo $visit['svendtc']; ?>
                <br>
            <strong>
                Visit:</strong> 
                <?php 
                echo $visit['visit']; 
                ?>
                <br>
        </div>
        <hr>
    <?php } ?>
    <form 
    method="post"
    >
        <div 
        class="form-group"
        >
            <label 
            for="svstdtc"
            >
                Visit Start Date and Time:
            </label>
            <input 
            type="datetime-local" 
            class="form-control" 
            id="svstdtc" 
            name="svstdtc" 
            required
            >
        </div>
        <div 
        class="form-group"
        >
            <label 
            for="svendtc"
            >
                Visit End Date and Time:
            </label>
            <input 
            type="datetime-local" 
            class="form-control" 
            id="svendtc" 
            name="svendtc" 
            required
            >
        </div>
        <div 
        class="form-group"
        >
            <label 
            for="visit"
            >
                Visit:
            </label>
            <input 
            type="text" 
            class="form-control" 
            id="visit" 
            name="visit" 
            required
            >
        </div>
        <button 
        type="submit" 
        class="btn
         btn-primary"
        >
            Add Visit
        </button>
    </form>
    <br />
    <a 
    href="subject897969.php?usubjid=<?php echo $usubjid; ?>" 
    class="btn
    btn-info"
    >
        Back to Subject Information
    </a>
</body>
</html>