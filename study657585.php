<?php
require('connect.php');
function getAllSubjects() {
    global $redis, $studyid, $me;
    $subjects = [];
    $keys = $redis->keys("$me:DM:$studyid:*");
    foreach ($keys as $key) {
        $usubjid = substr($key, strrpos($key, ':') + 1);
        $subjects[] = $usubjid;
    }
    return $subjects;
}
$page=isset($_GET['page'])?intval($_GET['page']):1;
$subjectsPerPage = 10;
$subjects = getAllSubjects();
$totalSubjects = count($subjects);
$totalPages = ceil($totalSubjects / $subjectsPerPage);
$page = max(1, min($totalPages, $page));
$start = ($page - 1) * $subjectsPerPage;
$displaySubjects = array_slice($subjects, $start, $subjectsPerPage);

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
        Study Subjects
    </title>
</head>
<body>
    <h2>
        Study Subjects
    </h2>
    <ul 
    class="list-group"
    >
        <?php foreach ($displaySubjects as $usubjid): ?>
            <li 
            class="list-group-item"
            >
                <a 
                href="subject897969.php?usubjid=<?php echo $usubjid; ?>">
                    Subject
                     <?php echo $usubjid; ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
    <nav 
    aria-label="Page navigation">
        <ul 
        class="pagination">
            <?php
             if($page>1){?>
                <li
                 class="page-item">
                    <a
                     class="page-link"
                      href="study657585.php?page=<?php echo $page - 1; ?>"
                       aria-label="Previous">
                        <span aria-hidden="true">&laquo; Previous</span>
                    </a>
                </li>
            <?php 
             }
         ?>
            <?php
             for($i=1;$i<=$totalPages;$i++){
             ?>
                <li
                 class="page-item <?php echo ($page === $i)?'active':'';?>">
                    <a
                    class="page-link"
                    href="study657585.php?page=<?php echo $i; ?>"><?php
                    echo $i; ?></a>
                </li>
            <?php
         }
          ?>
            <?php
             if ($page < $totalPages){
             ?>
                <li 
                class="page-item">
                    <a
                     class="page-link"
                      href="study657585.php?page=<?php echo $page + 1; ?>"
                       aria-label="Next">
                        <span
                         aria-hidden="true">
                         Next &raquo;
                        </span>
                    </a>
                </li>
            <?php
        }
        ?>
        </ul>
    </nav><br/>
    <a
     href="add112131.php"
     class="btn btn-success">
     Add Subject
    </a>
</body>
</html>
