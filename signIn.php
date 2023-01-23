<style type="text/css">
.signinContaner{
    margin: 0 auto;
    padding: 4%;
    width: 70%;
    height: 70%;
}

.signInForm{
    margin: 0 auto;
    width: 70%;
    height: 50%;
    text-align: center;
}
.signinTitle{
    color: darkslateblue;
    font: 3rem sans-serif;
    font-family: Verdana, Geneva, Tahoma, sans-serif;
   text-align: center;
}
.inputFields, .signUpField{
     width: 70%;
    height: 15%;
    padding: 1%;
    margin: 1%;
    border-radius: 10px;
    background-color: azure;
    font-family: Verdana, Geneva, Tahoma, sans-serif;
}
.signUpField{
    margin: 1%;
    background-color: cornsilk;
    font: 1.5rem sans-serif;
    text-align: center;
}
input:hover{
 border-color: navy;
 background-color:  lightgrey;
}
label{
    padding: 2%;
    margin: 1% auto;
    font-family: Verdana, Geneva, Tahoma, sans-serif;
    border-radius: 10px;
    font: 1em sans-serif;
    text-align: center;

    
}
#image{
    padding: 1%;
    font: 1rem sans-serif;
    /* visibility: hidden; */
 
}
#image:hover{
    background-color: white;
}
   </style>

<?php

require_once './db/database.php';
require_once './db/config.php';


use Social\Pdo\Database;


session_start();
$_SESSION['token'] = sha1('Aa$124$!re');

$message = '';

define('UPLOAD_MAX_SIZE', 1024 * 1024 * 2);
$ext = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
$upload_dir = __DIR__ . "/upload/";

if (isset($_POST['submit']) && !empty($_SESSION['token'])) {

    $name = filter_input(INPUT_POST, 'name', FILTER_UNSAFE_RAW);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_UNSAFE_RAW);

    try {
        if (empty($name) || empty($email) || empty($password)) {
            throw new Exception("All fields are required");
        }

        if (
            empty($_FILES['image']) ||
            $_FILES['image']['error'] !== UPLOAD_ERR_OK
        ) {
            throw new Exception("Error uploading file.<br>{$_FILES['image']['error']}");
        }

        $tmp_name = $_FILES['image']['tmp_name'];

        if (is_uploaded_file($tmp_name)) {

            if ($_FILES['image']['size'] > UPLOAD_MAX_SIZE) {
                throw new Exception("File is too large.");
            }

            $file_info = pathinfo($_FILES['image']['name']);
            $file_ext = strtolower($file_info['extension']);

            if (!in_array($file_ext, $ext)) {
                throw new Exception("Only files of type: 'jpg', 'jpeg', 'png', 'gif', 'webp' are allowed");
            }

            $upload_file = $upload_dir . date('Y.m.d.H.i.s') . '-' . basename($_FILES['image']['name']);

            if (
                move_uploaded_file(
                    $_FILES['image']['tmp_name'],
                    $upload_file
                )
            ) {
                $conn = new Database();
                $hash = password_hash($password, PASSWORD_DEFAULT);

                $result = $conn->dbQuery(
                    "INSERT INTO users (`id`, `name`, `email`, `password`) VALUES(NULL,?,?,?)",
                    [$name, $email, $hash]
                );

                if ($conn->get('affected') > 0) {
                    header('location: login.php');
                } else {
                    throw new Exception("Error. Check your input...");
                }
            } else {
                throw new Exception("Upload failed. check permission and path of upload folder");
            }
        }
    } catch (Exception $err) {
        $message = $err->getMessage();
    }
}


include_once './insert/startPage.php';
include_once './insert/header.php';
?>
    


<main >

<div class="signinContaner">
    <form class='signInForm' action="signIn.php" method="POST" enctype="multipart/form-data">
        <h2 class='signinTitle'>Sign in</h2>
        <input class="inputFields" type="text" name="name" placeholder="Name" required>
        <input class="inputFields" type="email" name="email" placeholder="Email" required>
        <input class="inputFields" type="password" name="password" placeholder="Password" required>
        
        <div class="">
            <label for="image" class="">Upload Image</label>
            <input type="file" class="" id="image" name="image">
        </div>

        <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
      
        <input class="signUpField" type="submit" name="submit" value="Sign Up" class="">

        <div>
        <p><?= $message ?></p>
        </div>
    </form>
</div>


</main>




<?php
// include_once './insert/footer.php';
include_once './insert/endPage.php';
?>