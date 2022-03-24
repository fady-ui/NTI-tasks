<?php

use app\helpers\Hash;
use app\models\User;
use app\requests\RegisterRequest;

$title = "SignIn";

include_once "layouts/header.php";
include_once "app/middlewares/guest.php";

include_once "layouts/navbar.php";
include_once "layouts/breadcrumb.php";

$loginRequest = new RegisterRequest;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $errors = [];

    $loginRequest->setEmail($_POST['email'])->emailValidation(false);
    $loginRequest->setPassword($_POST['password'])->passwordValidation("email or password is wrong");

    if (empty($loginRequest->errors())) {
        $userObject = new User;

        $userObject->setEmail($_POST['email']);
        $result = $userObject->getUserByEmail();

        if ($result->num_rows == 1) {
            $user = $result->fetch_object();
            if (Hash::verify($_POST['password'], $user->password)) {
                if ($user->email_verified_at) {
                    if (isset($_POST['remember_me'])) {
                                   //1-name of cookie , 
                                   //2-el 7aga elu hsglha fl cookie , 
                                   //3-expired b3d ad eh ,
                                   //4-(/)3lashan tsht8l 3la l project kolo ;
                        setcookie('remember_me', $_POST['email'], time() + (10 * 86400), '/');
                    }

                    $_SESSION['user'] = $user;
                    header('location: index.php');
                } else {
                    $_SESSION['email'] = $_POST['email'];
                    header('location: check-code.php');
                    die;
                }
            } else {
                $erros['wrong-email'] = "email or password is not correct";
            }
        } else {
            $erros['wrong-email'] = "email or password is not correct";
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
                                        <input type="email" name="email" placeholder="Email" value="<?= old('email') ?>">
                                        <?= $loginRequest->getErrorMessage('email') ?>

                                        <input type="password" name="password" placeholder="Password">
                                        <?= $loginRequest->getErrorMessage('password') ?>
                                        <?php

                                        if (!empty($errors)) {
                                            foreach ($errors as $error) {
                                                echo "<p class='text-danger'>{$error}</p>";
                                            }
                                        }

                                        ?>

                                        <div class="button-box">
                                            <div class="login-toggle-btn">
                                                <input type="checkbox" name="remember_me" value="true">
                                                <label>Remember me</label>
                                                <a href="check-email.php">Forgot Password?</a>
                                            </div>
                                            <button type="submit"><span>Login</span></button>
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