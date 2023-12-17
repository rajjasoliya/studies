<?php
include_once('connect.php');
$usubjid = 
isset($_GET['usubjid']) 
?
 intval($_GET['usubjid']) 
 :
  null;
if (!$usubjid) {
    header("Location: study10.php");
    exit();
}
$keyCO = "$me:CO:$studyid:$usubjid";
$keyDM = "$me:DM:$studyid:$usubjid";
if 
($_SERVER['REQUEST_METHOD']
 == 'POST') 
 {
    $coseq = $redis->hIncrBy($keyDM, 'last_coseq', 1);
    $data = [
        'codtc' => date('c'),
        'coval' => $_POST['coval'],
    ];

    $redis->hMset("$keyCO:$coseq", $data);
}
$lastCoseq = $redis->hGet($keyDM, 'last_coseq');
$comments = [];
for ($i = 1; $i <= $lastCoseq; $i++) {
    $commentData = $redis->hGetAll("$keyCO:$i");
    if (!empty($commentData)) {
        $comments[] = $commentData;
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
    <title>Comments</title>
</head>
<body>
    <h2>Comments - <?php echo $usubjid; ?></h2>
    <?php 
    foreach 
    ($comments as $comment): ?>
        <div>
            <strong>
                Date and Time:</strong> 
                <?php echo $comment['codtc']; ?>
                <br>
            <strong>
                Comment:</strong> 
                <?php echo $comment['coval']; ?>
                <br>
        </div>
        <hr>
    <?php endforeach; ?>
    <form 
    method="post"
    >
        <div 
        class="form-group"
        >
            <label 
            for="coval"
            >
                New Comment:
            </label>
            <input 
            type="text" 
            class="form-control" 
            id="coval" 
            name="coval" 
            required
            >
        </div>
        <button 
        type="submit" 
        class="btn
         btn-primary"
        >
            Add Comment
        </button>
    </form>
    <br />
    <a 
    href="subject40.php?usubjid=<?php
     echo $usubjid;
      ?>" 
    class="btn
     btn-info"
    >
        Back to Subject Information
    </a>
</body>
</html>
