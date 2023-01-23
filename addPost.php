<style type="text/css">

.addPostCont{
    margin: 0 auto;
    padding: 4%;
text-align: center;
}
.addTitle{
    padding: 2%;
    color: darkslateblue;
    font: 3rem sans-serif;
    font-family: Verdana, Geneva, Tahoma, sans-serif;
   text-align: center;
}
.addText{
    color: #6f6991;
    font: 2rem sans-serif;
    font-family: Verdana, Geneva, Tahoma, sans-serif;
   text-align: center;
}
.addArticleForm{
    /* width: 80%; */
padding: 1%;

}
#addpost, #postTitle{
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
.labelInpuGroup{
    display: flex;
}
.buttonAddPost, .buttonCancel{
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
.labelAddPost{
    padding: 2%;
    margin: 1% auto;
    font-family: Verdana, Geneva, Tahoma, sans-serif;
    border-radius: 10px;
    font-size: 1.4rem;
    text-align: center;
}
.buttonsAdd{
    display: flex;
}

</style>

<?php
require_once './db/config.php';
require_once './db/database.php';

include_once './insert/startPage.php';
include_once './insert/header.php';


use Social\Pdo\Database;

session_start();

$message = '';

if (isset($_POST['submit']) && !empty($_SESSION['token'])) {
   
    $userId = $_SESSION['userId'];
    $userName = $_SESSION['userName'];
    $title = filter_input(INPUT_POST, 'postTitle', FILTER_UNSAFE_RAW);
    $post = filter_input(INPUT_POST, 'addpost', FILTER_UNSAFE_RAW);

    if (!empty($userId) && !empty($userName) && !empty($title) && !empty($post)) {
        try {
            $db = new Database();
            $db->connect();

            $result = $db->dbQuery(
                "INSERT INTO articles (userID, userName, title, post, `date`) VALUES (?,?,?,?,?)",
                [$userId, $userName, $title, $post, date('Y.m.d.H.i.s')]
            );

            header('location: blog.php');
            // $message = $result[0];

        } catch (Exception $err) {
            $message = $err->getMessage();
        }
    }
}

?>
    

    <main>

    <div class='addPostCont'>
    <h1 class="addTitle">Add new post</h1>
    <h3 class="addText">Our community ....</h3>
</div>

<form method="POST" action="addPost.php" accept-charset="UTF-8" enctype="multipart/form-data" class="addArticleForm">
   <div class="labelInpuGroup">
<label for="postTitle" class="labelAddPost">Title:</label>
<textarea placeholder="Title" class="form-control" id="postTitle" name="postTitle" rows="4" cols="40"></textarea>

<label for="addpost" class="labelAddPost">Article:</label>
<textarea placeholder="write something" class="form-control" id="addpost" name="addpost" rows="4" cols="40"></textarea>
</div>
<div class="buttonsAdd">
<button type="submit" name="submit" value="Submit" class="buttonAddPost">Save</button>
<button type="reset" value="Reset" action="blog.php" class="buttonCancel">Cancel</button>
</div>
<p><?= $message ?></p>
</form>

    </main>

<?php
include_once './insert/footer.php';
include_once './insert/endPage.php';
?>