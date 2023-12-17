<?php
include_once('connect.php');

if($_SERVER['REQUEST_METHOD']=='POST'){
    $usubjid = $redis->incr("$me:$studyid:last_usubjid");
    $key = "$me:DM:$studyid:$usubjid";

    $data = [
        'brthdtc' => $_POST['brthdtc'],
        'sex' => $_POST['sex'],
        'race' => $_POST['race'],
        'country' => $_POST['country'],
        'last_visitnum'=>$_POST['last_visitnum'],
        'last_coseq'=>$_POST['last_coseq'],
    ];

    $redis->hMset($key, $data);
    header("Location: study10.php");
    exit();
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
        Add Subject
    </title>
</head>
<body>
    <h2>
        Add Subject
    </h2>
    <form 
    method="post">
        <div 
        class="form-group">
            <label
                for="brthdtc"
            >
                Birth Date and Time:
            </label>
            <input
                type="datetime-local"
                class="form-control"
                id="brthdtc"
                name="brthdtc"
                required
            >
        </div>
        <div 
        class="form-group">
            <label
                for="sex"
            >
                Sex:
            </label>
            <input
                type="text"
                class="form-control"
                id="sex"
                name="sex"
                required
            >
        </div>
        <div 
        class="form-group">
            <label
                for="race"
            >
                Race:
            </label>
            <input
                type="text"
                class="form-control"
                id="race"
                name="race"
                required
            >
        </div>
        <div 
        class="form-group">
            <label
                for="country"
            >
                Country:
            </label>
            <input
                type="text"
                class="form-control"
                id="country"
                name="country"
                required
            >
        </div>
        <div 
        class="form-group">
            <label
                for="last_visitnum"
            >
                Last Visit Number:
            </label>
            <input
                type="number"
                class="form-control"
                id="last_visitnum"
                name="last_visitnum"
                required
            >
        </div>
        <div 
        class="form-group">
            <label
                for="last_coseq"
            >
                Last Co-Sequence:
            </label>
            <input
            id="last_coseq"
            type="number"
            name="last_coseq"
            class="form-control"
                required
            >
        </div>
        <button
        type="submit"
        class="btn-success btn">
            Save
        </button>
    </form>
</body>
</html>
