<?php


use app\models\User;
use app\helpers\Hash;
use app\mails\VerificationMail;
use app\requests\RegisterRequest;

$title = "SignUp";

include_once "layouts/header.php";
include_once "app/middlewares/guest.php";

include_once "layouts/navbar.php";
include_once "layouts/breadcrumb.php";

$registerRequest = new RegisterRequest;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = [];
    $registerRequest->setEmail($_POST['email']);
    $registerRequest->emailValidation();

    $registerRequest->setPhone($_POST['phone']);
    $registerRequest->phoneValidation();


    $registerRequest->setPassword($_POST['password']);
    $registerRequest->passwordValidation();

    $registerRequest->setPassword_confirm($_POST['password_confirm']);
    $registerRequest->passwordConfirmValidation();

    if (empty($registerRequest->errors())) {
        //generate verification code    
        $verificationCode = rand(10000, 99999);
        // rand(10000, 99999);

        //hashing password
        $hashedPassword = Hash::make($_POST['password']);

        //insert user into database
        $user = new User;
        $result = $user->setFirst_name($_POST['first_name'])
            ->setLast_name($_POST['last_name'])
            ->setEmail($_POST['email'])
            ->setPhone($_POST['phone'])
            ->setPassword($hashedPassword)
            ->setVerification_code($verificationCode)
            ->setGender($_POST['gender'])
            ->create();

        //send email
        if ($result) {
            // verify email
            $subject = "verification code";
            $body = "<div>
                        <p>Welcome {$_POST['first_name']} {$_POST['last_name']}</p>
                        <p>your verification code: {$verificationCode}</p>
                        <p>thank you</p>
                    </div>";
            $verificationMail = new VerificationMail($_POST['email'], $subject, $body);
            $verificationMailResult = $verificationMail->send();
            if ($verificationMailResult) {
                $_SESSION['email'] = $_POST['email'];
                header("location:check-code.php?page=signup");
                die;
            } else {
                $errors['insert'] = 'something wrong please try again later';
            }
        } else {
            $errors['insert'] = 'something wrong please try again later';
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

                        <a class="active" data-toggle="tab" href="#lg2">
                            <h4> <?= $title ?> </h4>
                        </a>
                    </div>
                    <div class="tab-content">

                        <div id="lg2" class="tab-pane active">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <?php
                                    if (!empty($errors)) {
                                        foreach ($errors as $error) {
                                            echo "<div class='alert alert-danger'><strong>{$error}</strong></div>";
                                        }
                                    }
                                    ?>
                                    <form method="POST">
                                        <input type="text" name="first_name" placeholder="first name" value="<?= old('first_name') ?>">
                                        <input type="text" name="last_name" placeholder="last name" value="<?= old('last_name')  ?>">
                                        <input type="tel" name="phone" placeholder="phone" value="<?= old('phone')  ?>">
                                        <?= $registerRequest->getErrorMessage('phone') ?>

                                        <input type="email" name="email" placeholder="email" value="<?= old('email') ?>">
                                        <?= $registerRequest->getErrorMessage('email') ?>

                                        <input type="password" name="password" placeholder="Password">
                                        <?= $registerRequest->getErrorMessage('password') ?>

                                        <input type="password" name="password_confirm" placeholder="Password confirm">
                                        <?= $registerRequest->getErrorMessage('password_confirm') ?>

                                        <select name="gender" class="form-control">
                                            <option <?= old('gender') == 'm' ? 'selected' : ''  ?> value="m">male</option>
                                            <option <?= old('gender') == 'f' ? 'selected' : ''  ?> value="f">female</option>
                                        </select>
                                        <div class="button-box mt-4">
                                            <button type="submit"><span>Register</span></button>
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



include_once "layouts/footer.php";
include_once "layouts/footerscripts.php";



?>