<?php

use app\models\User;
use app\mails\VerificationMail;
use app\requests\RegisterRequest;

$title = "Check Email";

include_once "layouts/header.php";
include_once "app/middlewares/guest.php";
define('CODE_EXPIRATION_IN_MINUTES', 10);
$emailVerificationRequest = new RegisterRequest;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //code validation
    $errors = [];
    $emailVerificationRequest->setEmail($_POST['email'])->emailValidation(false);

    if (empty($emailVerificationRequest->errors())) {
        $userObject = new User;
        $result = $userObject->setEmail($_POST['email'])->getUserByEmail();
        if ($result->num_rows == 1) {
            $user = $result->fetch_object();
            
            $forgetCode = rand(10000, 99999);
            // rand(10000, 99999)
           
            
            $forgetCodeExpiration = date('Y-m-d H:i:s', strtotime('+' . CODE_EXPIRATION_IN_MINUTES . 'minutes'));
            $updateCodeResult = $userObject->setForget_code($forgetCode)->setCode_expiration($forgetCodeExpiration)->updateForgetCode();
            if ($updateCodeResult) {
                //send email

                // echo $forgetCode; die;
                $subject = "forget password code";
                $body = "<div>
                            <p>Welcome {$user->first_name} {$user->last_name}</p>
                            <p>your forget password code: {$forgetCode}</p>
                            <p>code will expired at: {$forgetCodeExpiration}</p>
                            <p>thank you</p>
                        </div>";

                $verificationMail = new VerificationMail($_POST['email'], $subject, $body);
                $verificationMailResult = $verificationMail->send();

                if ($verificationMailResult) {
                    
                    $_SESSION['email'] = $_POST['email'];
                    header("location:check-code.php?page=check-email");
                    die;

                } else {
                    $errors['insert'] = 'something wrong please try again later';
                }
            } else {
                $errors['wrong'] = "something wrong";
            }
        } else {
            $errors['wrong'] = "your email is wrong";
        }
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
                                        <input type="email" name="email" placeholder="email">
                                        <?= $emailVerificationRequest->getErrorMessage('email') ?>
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