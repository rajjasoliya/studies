<?php
include_once('connect.php');
$usubjid=isset($_GET['usubjid'])?intval($_GET['usubjid']):null;
if (!$usubjid) {
    header("Location: study10.php");
    exit();
}
$keyDM = "$me:DM:$studyid:$usubjid";
if($_SERVER['REQUEST_METHOD']=='POST'){
    $data = [
        'brthdtc' => $_POST['brthdtc'],
        'sex' => $_POST['sex'],
        'race' => $_POST['race'],
        'country' => $_POST['country'],
        'last_visitnum'=>$_POST['last_visitnum'],
        'last_coseq'=>$_POST['last_coseq'],
    ];
    $redis->hMset($keyDM, $data);
    header("Location: study10.php");
    exit();
}
$dmData = $redis->hGetAll($keyDM);
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
        Subject Information
    </title>
</head>
<body>
    <h2>
        Subject Information - <?php echo $usubjid; ?>
    </h2>
    <form method="post">
        <div
         class="form-group">
            <label
             for="brthdtc"
             >Birth Date and Time:
            </label>
            <input
             type="datetime-local"
              class="form-control"
               id="brthdtc"
                name="brthdtc"
                 value="<?php echo $dmData['brthdtc']; ?>" 
             required>
        </div>
        <div
         class="form-group">
            <label
             for="sex"
             >Sex:
            </label>
            <input
             type="text"
              class="form-control" 
              id="sex"
               name="sex"
                value="<?php echo $dmData['sex']; ?>" 
             required>
        </div>
        <div
         class="form-group">
            <label
             for="race"
             >Race:
            </label>
            <input
             type="text"
              class="form-control" 
              id="race"
               name="race"
                value="<?php echo $dmData['race']; ?>" 
             required>
        </div>
        <div
         class="form-group">
            <label
             for="country"
             >Country:
            </label>
            <input
             type="text"
              class="form-control" 
              id="country"
               name="country"
                value="<?php echo $dmData['country']; ?>" 
             required>
        </div>
        <div
         class="form-group">
            <label
             for="last_visitnum">Last Visit Number:</label>
            <input
             type="number"
              class="form-control"
               id="last_visitnum"
                name="last_visitnum"
                 value="<?php echo $dmData['last_visitnum']; ?>" required>
        </div>
        <div
         class="form-group">
            <label
             for="last_coseq"
             >Last Co-Sequence:
            </label>
            <input
             type="number"
              class="form-control"
               id="last_coseq"
                name="last_coseq"
                 value="<?php echo $dmData['last_coseq']; ?>" required>
        </div>
        <button
         type="submit"
          class="btn btn-success"
          >Save Changes</button>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         <a
         href="visit35.php?usubjid=<?php
          echo $usubjid; 
          ?>"
         class="btn btn-warning">
         View Visits
        </a>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         <a
         href="comment20.php?usubjid=<?php
          echo $usubjid; 
          ?>"
          class="btn btn-info">
          View Comments
        </a>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a
         href="delete.php?usubjid=<?php
          echo $usubjid; 
          ?>"
          class="btn btn-danger"
          >
          Delete Subject
        </a>
    </form>
    <br />
    <a
     href="study10.php"
      class="btn btn-info"
      >
      Back to Studies
    </a>
</body>
</html>
