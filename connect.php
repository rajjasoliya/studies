<?php
// $studyid = 12700;
// $me = 'tooeybrown';

// $redis=new Redis();
// $redisConfig=[];

// // Check if the server is localhost (development)
// if($_SERVER['SERVER_NAME']==='localhost'){
//     try {
//         if(!$redis->connect('127.0.0.1',6379)){
//             throw new Exception("Oops! Failed to connect to the Redis server on the localhost | 127.0.0.1 HOST !");
//         }
//     }catch(Exception $e){
//         die("Error: " . $e->getMessage());
//     }
// }else{ // Assume production
//     $redisConfig = [
//         'host' => 'grevera.ddns.net',
//         'port' => 6379,
//         'username' => 'tooeybrown',
//         'password' => 'BAE1B888',
//     ];

//     try {
//         $redis->connect($redisConfig['host'],$redisConfig['port']);
//         if(!empty($redisConfig['password'])){
//             $redis->auth($redisConfig['password']);
//         }
//         echo "<!-- connected. The Server is running: " . $redis->ping() . " --> \n";
//     }catch(Exception $e){
//         die("Error: " . $e->getMessage());
//     }
// }
?>
<?php
    //file: connect.php
    error_reporting( E_ALL );

    // https://phpredis.github.io/phpredis/Redis.html
    $me = 'tooeybrown';			// <-- change to your username
    $studyid = 12700;

    //connect to redis server on localhost
    $redis = new Redis();
    $redis->connect( 'localhost' );
    echo "<!-- connected. --> \n";

    $redis->auth( [$me, 'BAE1B888'] );	// <-- change to your password
    echo "<!-- logged in. --> \n";

    //check whether server is running or not
    echo "<!-- server is running: " . $redis->ping() . ". --> \n";
?>
