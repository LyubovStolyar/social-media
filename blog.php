<style type="text/css">
.newPostButton{
    margin: 20px;
    padding: 3%;
    width: 20vw;
    height: 3vh;
    border-radius: 10px;
    background-color: #dfe6ff;
   font-family: Verdana, Geneva, Tahoma, sans-serif;
   border-style:  solid;
    border-color: #1b3d5a;
}

.addPostLink{
    width: 100%;
    height: 100%;
    text-decoration: none;
    color: #3a1d91;
    font: 1.2rem sans-serif;
    font-family: Verdana, Geneva, Tahoma, sans-serif;
  display: flex;
  justify-content: center;
  align-items: center;
}
.addPostLink:hover, .newPostButton:hover{
    color:  #dfe6ff;
    background-color: #3a1d91;
}
.blogTitle{
    color: darkslateblue;
    font: 3rem;
    font-family: Verdana, Geneva, Tahoma, sans-serif;
   text-align: center;
}
.articleCont{

    border-color: #1b3d5a;
    border-style: solid;
    padding: 1%;
    margin: 20px;
    width: 90%;
}
.articleHeader{
    background-color: #cfcbcb;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.articleUserName, .articleDate{
    font-size: 1.4rem;
    font-family: Verdana, Geneva, Tahoma, sans-serif;
    margin: 1%;
    padding: 1%;
 
}
.articleDate{
    font-size: 1.2rem;
}
.span{
    width: 150px;
}
.articleTitle{
    padding: 1%;
    color: #3a1d91;
    font-family: Verdana, Geneva, Tahoma, sans-serif;

}
.articlePost{
    font-family: Verdana, Geneva, Tahoma, sans-serif;
    padding: 1%;
    color:  darkblue;
}
.deleteLink, .editLink{
    text-decoration: none;
    font-size: 1.4rem;
}
.iconBlock{
    display: flex;
    justify-content: flex-end
}
.fa-pencil, .fa-trash{
margin-left: 20px;
color: #3a1d91;
}

</style> 

<?php
include_once './insert/startPage.php';
include_once './insert/header.php';

    
require_once './db/database.php';
require_once './db/config.php';

use Social\Pdo\Database;


session_start();
if (!isset($_SESSION['userId'])) {

    header('location: login.php');
}

$conn = new Database();
$result = $conn->dbQuery(
"SELECT * FROM articles",
[]
);

?>

<main >
<h1></h1>
<button class="newPostButton">
    <a href="addPost.php" class="addPostLink">+ Add new article</a>
</button>

<h1 class="blogTitle">Articles</h1>

<ul class="">
    <?php
     
    foreach ($result as $row) {
       
        echo <<<COL
            <div class="articleCont">
                <div class="articleHeader">
                    <div class="articleUserName">
                    <i class="fa fa-user userIcon"></i>
                    <span class=".span"/>{$row->userName} 
                    
                    </div>
                   
             
                <p class="articleDate"> {$row->date} </p>
                </div>
            
            <form action="" method="POST">
                <div>
                    <h1 name="title" class="articleTitle">{$row->title}</h1>
                    <p name="post" class="articlePost">{$row->post}</p>
                </div>
        COL;
              
        if($row->userID == $_SESSION['userId']){
                echo <<<COL
                <div class="iconBlock">
                
                    <a class="editLink" href="editPost.php?id={$row->id}">
                    <i class="fa fa-solid fa-pencil"></i>
                    </a>
                    <span class=".span"/>
                    <a class="deleteLink" href="deletePost.php?id={$row->id}">
                    <i class="fa fa-solid fa-trash"></i>
                    </a> 
                </div>
                COL;
           }
        echo <<<COL
                <form>
            </div>
          
        COL;

       // echo $col;
    }
    ?>
</ul>

</main>


<?php
include_once './insert/footer.php';
include_once './insert/endPage.php';
?>