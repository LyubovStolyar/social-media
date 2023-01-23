<?php 
include_once './insert/startPage.php';
// include_once './insert/header.php';

    
require_once './db/database.php';
require_once './db/config.php';

use Social\Pdo\Database;


session_start();
$message = '';


print_r($_GET['id'], $_SESSION['userId']);

if (!isset($_SESSION['userId']) && !empty($_SESSION['userId'])) {
    $_SESSION['userId'] = $userId;
} 
    print_r('ok');
    $conn = new Database();
    $result = $conn->dbQuery(
      
        "DELETE FROM articles WHERE id=? AND userID=?",
        [$_GET['id'], $_SESSION['userId']]
    );

    header('location: blog.php');
    $message = 'Your post have been deleted!';


?>

<p><?= $message ?></p>

<?php

include_once './insert/endPage.php';
?>