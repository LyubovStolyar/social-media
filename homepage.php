<style type="text/css">
 
.title{
    padding: 2%;
    color: darkslateblue;
    font: 3rem sans-serif;
    font-family: Verdana, Geneva, Tahoma, sans-serif;
   text-align: center;
}
.welcomeText{
    color: #6f6991;
    font: 2rem sans-serif;
    font-family: Verdana, Geneva, Tahoma, sans-serif;
   text-align: center;
  
}
.homepageButton{
    
    justify-content: center;
    display: flex;
    text-align: center;
    background-color: #d7d4e3;
    padding: 1%;
    margin: 5% auto;
    width: 30vw;
    font-size: 1.5rem;
    color: aliceblue;
    font-family: Verdana, Geneva, Tahoma, sans-serif;
    border-style:  solid;
    border-radius: 10px;
    border-color:#663f68;
  
}
.homepageButton:hover{
    background-color: #663f68;
}
.joinUsLink{
    width: 100%;
    height: 100%;
    text-decoration: none;
    color: #3a1d91;
}
.joinUsLink:hover{
    color:wheat;
}
</style>
<?php
include_once './insert/startPage.php';
include_once './insert/header.php';
?>


   
<main>

<div class="homeCont">
    <h1 class="title">Home page</h1>
    <h3 class="welcomeText">Welcome to community</h3>
</div>

<button class="homepageButton">
    <a class="joinUsLink" href="login.php">Join us!</a>
</button>


</main>


<?php
include_once './insert/footer.php';
include_once './insert/endPage.php';
?>