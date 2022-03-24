<?php

use app\models\User;

$title = "Check Code Verification";

include_once "layouts/header.php";
include_once "app/middlewares/guest.php";

//validate on allwed pages
define('ALLOWED_PAGES', ['signup', 'check-email']);
if (!empty($_GET)) {
    if (isset($_GET['page'])) {
        if (!in_array($_GET['page'], ALLOWED_PAGES)) {
            header('location:layouts/errors/404.php');
            die;
        }
    } else {
        header('location:layouts/errors/404.php');
        die;
    }
} else {
    header('location:layouts/errors/404.php');
    die;
}

if (empty($_SESSION['email'])) {
    header('location:signin.php');
    die;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //code validation
    $errors = [];

    if (!empty($_POST['code'])) {
        $userObject = new User;
        $userObject->setEmail($_SESSION['email']);

        if ($_GET['page'] == 'signup') {
            //come from signup page
            $userObject->setVerification_code($_POST['code']);
            $result = $userObject->checkCode();
            if ($result->num_rows == 1) {
                $verificationResult = $userObject->verifyUser();
                if ($verificationResult) {
                    unset($_SESSION['email']);
                    $success = "<p class='text-success text-center'>your email is verified now</p>";
                    header('Refresh:2; url=signin.php');
                } else {
                    $errors['tryagain'] = 'something wrong please try again later';
                }
            } else {
                $errors['wrong'] = 'code is wrong';
            }
        } else {
            //come from check-email page
            $userObject->setForget_code($_POST['code']);
            $result = $userObject->checkForgetCode();
            if ($result->num_rows == 1) {
                $user = $result->fetch_object();
                if(date('Y-m-d H:m:s') <= $user->code_expiration){
                    header('location:set-new-password.php');
                    die;
                }else{
                $errors['code'] = 'code is expired';

                }
            } else {
                $errors['code'] = 'code is wrong';
            }
        }
    } else {
        $errors['code'] = 'code is required';
    }
}


?>
<div class="login-register-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                <div class="login-register-wrapper">
                    <div class="login-register-tab-list nav">
                        <a class="active" data-toggle="tab" href="#lg1">
                            <h4> <?= $title ?> </h4>
                        </a>

                    </div>
                    <div class="tab-content">

                        <div id="lg1" class="tab-pane active">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <form method="POST">
                                        <input type="number" name="code" placeholder="verification code">
                                        <?php
                                        if (!empty($errors)) {
                                            foreach ($errors as $error) {
                                                echo "<p class='text-danger'>{$error}</p>";
                                            }
                                        }

                                        echo $success ?? null;
                                        ?>
                                        <div class="button-box">
                                            <button type="submit"><span><?= $title ?></span></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

include_once "layouts/footerscripts.php";



?>