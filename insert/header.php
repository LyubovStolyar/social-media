<style type="text/css">
 *{
  margin: 0;
  padding: 0;
  width: 100wv;
 }
 .headerNav{
    width: 100%;
    height: 5%;
    background-color: darkslateblue;
    display: flex;
    justify-content: space-between;
    padding: 1%;
    align-items: center;


  }
  .headerKLink{
    width: 50px;
    color:white;
    font: 1.3rem sans-serif;
    margin: 1%;
    margin-right: 1%;
    padding: 2%;
    text-decoration: none;
    text-align: center;
  }
.linkContainer{
  width: 25%;
  display: flex;
  justify-content: center;
  }
  .headerKLink:hover{
color: #c2c1ef;
  }
  
  
  </style>

<header>
    <nav class="headerNav">
<div class="linkContainer">
<a class="headerKLink">
<i class="fa fa-solid fa-users"></i>
</a>

 <a class="headerKLink" href="homepage.php">Home</a>
 <a class="headerKLink" href="about.php">About</a>
 <a class="headerKLink" href="blog.php">Blog</a>
</div>


<div class="linkContainer">
  <a class="headerKLink" href="login.php">Login</a>   
<a class="headerKLink" href="signIn.php">Signin</a>
<a class="headerKLink" href="logout.php">Logout</a>
  
</div>


    </nav>
</header>


