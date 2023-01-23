<style type="text/css">
.editTitle{
    padding: 2%;
    color: darkslateblue;
    font: 3rem sans-serif;
    font-family: Verdana, Geneva, Tahoma, sans-serif;
   text-align: center;
}
.editPostCont{
    margin: 0 auto;
    padding: 4%;
text-align: center;
}
.editArticleForm{
    padding: 1%;
}
.editLabel{
    padding: 2%;
    margin: 1% auto;
    font-family: Verdana, Geneva, Tahoma, sans-serif;
    border-radius: 10px;
    font-size: 1.4rem;
    text-align: center;
}
#editPost, #editTitle{
    border-color: #004bbb;
    /* border-color:  blueviolet; */
    border-style: solid;
    font-size: 1.5rem;
    width: 30vw;
    height: 15vh;
    padding: 1%;
    margin: 2%;
    text-align: center;
}
.editButtonCont{
    display: flex;
}
.editSubmitButton, .editResetButton{
    width: 10vw;
    height: 5vh;
    padding: 2%;
    margin: 2% auto;
    border-radius: 10px;
    background-color: #dfe6ff;
   font-family: Verdana, Geneva, Tahoma, sans-serif;
   border-style:  solid;
    border-color: #1b3d5a;
    font: 1.5rem sans-serif;
   justify-content: center;
   display: flex;
   align-items: center;
   color: #80a0bb;
}
.editLabelInput{
display: flex;
}
.editSubmitButton:hover{
background-color: #1b3d5a;
color: aliceblue;
}
.editResetButton:hover{
background-color: #1b3d5a;
color: aliceblue;   
}
</style>
<?php

include_once './insert/startPage.php';
include_once './insert/header.php';

    
require_once './db/database.php';
require_once './db/config.php';

use Social\Pdo\Database;

session_start();
$message = '';

if (!isset($_SESSION['userId']) && !empty($_SESSION['userId'])) {

    $_SESSION['userId'] = $userId;
} 

$conn = new Database();
$result = $conn->dbQuery(
"SELECT * FROM articles WHERE id=? AND userID=?",
[$_GET['id'], $_SESSION['userId']]

);

foreach ($result as $row) {
      $title = $row->title;
      $post = $row->post;
}

?>

<?php

if (isset($_POST['submit']) && !empty($_SESSION['token'])) {

    $editTitle = filter_input(INPUT_POST, 'editTitle', FILTER_UNSAFE_RAW);
    $editPost = filter_input(INPUT_POST, 'editPost', FILTER_UNSAFE_RAW);

    
    if (!empty($editTitle) && !empty($editPost)) {
        try {
            $db = new Database();
            $db->connect();
            
            $result = $db->dbQuery(
                "UPDATE articles SET title=?, post=?, `date`=? WHERE id=?",
                [$editTitle, $editPost, date('Y.m.d.H.i.s'), $result[0]->id]
            );
       
            header('location: blog.php');
          
        } catch (Exception $err) {
            $message = $err->getMessage();
        }
    }
}
?>

<main>
<div class="editPostCont">
    <h1 class="editTitle">Edit your article</h1>
</div>
<form method="POST" action="" accept-charset="UTF-8" enctype="multipart/form-data" class="editArticleForm">
   <div class="editLabelInput">
<label for="editTitle" class="editLabel">Edit title:</label>
<textarea placeholder="Edit title" class="form-control" id="editTitle" name="editTitle" rows="3">
<?= $title ?>
</textarea>

<label for="editPost" class="editLabel">Edit article:</label>
<textarea placeholder="edit post" class="form-control" id="editPost" name="editPost" rows="3">
<?= $post ?>
</textarea>
</div>
<div class="editButtonCont">
<button type="submit" name="submit" value="Submit" class="editSubmitButton">Edit</button>
<button type="reset" value="Reset" class="editResetButton">Cancel</button>
<p id="p"><?= $message ?></p>
</div>
</form>

</main>

<?php
include_once './insert/footer.php';
include_once './insert/endPage.php';
?>