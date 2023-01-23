<style type="text/css">
.loginCont{
margin: 0 auto;
    padding: 4%;
    width: 50%;
    height: 50%;
}
.loginTitle{
    color: darkslateblue;
    font: 3rem sans-serif;
    font-family: Verdana, Geneva, Tahoma, sans-serif;
   text-align: center;
}
.formStyle{
    text-align: center;
}
input, .submitLogin{
    width: 50vw;
    height: 5vh;
    padding: 2%;
    margin: 2% auto;
    border-radius: 10px;
    background-color: #dfe6ff;
   font-family: Verdana, Geneva, Tahoma, sans-serif;
   border-style:  solid;
    border-color: #1b3d5a;
}
.submitLogin{
    font: 1.5rem sans-serif;
   justify-content: center;
   display: flex;
   align-items: center;
   border-style:  solid;
   border-color: #1b3d5a;
   color: #80a0bb;
}
input:hover, .submitLogin:hover {
    border-color: #005095;
    background-color: aliceblue;
    color:#1b3d5a;
}

</style>

<?php
include_once './insert/startPage.php';
include_once './insert/header.php';

require_once './db/database.php';
require_once './db/config.php';

use Social\Pdo\Database;


session_start();

$_SESSION['token'] = sha1('Jfn551Fd');

$message = '';

if (isset($_SESSION['userId'])) {
    unset($_SESSION['userId']);
}

if (isset($_POST['submit']) && !empty($_SESSION['token'])) {

    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_UNSAFE_RAW);

    if (!empty($email) && !empty($password)) {
        $conn = new Database();
        $result = $conn->dbQuery(
            "SELECT * FROM users WHERE email=?",
            [$email]
        );

        if (count($result) > 0) {
            $row = $result[0];

            if (!password_verify($password, $row->password)) {
                $message = "Failed to login, check password";
                return;
            }

            $_SESSION['userId'] = $row->id;
            $_SESSION['userName'] = $row->name;

            header('location: homepage.php');
        } else {
            $message = "Failed to login, check email and password";
        }
    } else {
        $message = "All fields are required";
    }
}

?>
    


<main>

<div class="loginCont">
    <form class="formStyle" method="POST" action="login.php" accept-charset="UTF-8">
        <h2 class="loginTitle">Login</h2>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>

        <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
        
        <button class="submitLogin" type="submit" name="submit">Login</button>

        <div class=""><?= $message ?></div>
    </form>
</div>


</main>




<?php
include_once './insert/footer.php';
include_once './insert/endPage.php';
?>