<?php

use app\models\User;
use app\services\media;

$title = "My Account";

include_once "layouts/header.php";
include_once "app/middlewares/auth.php";



$errors = [];
$success = [];

$userData = new User;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_info'])) {
        if (!empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['phone']) && !empty($_POST['gender'])) {

            //upload photo lw l user raf3 sora
            if ($_FILES['image']['error'] == 0) {
                $media = new media($_FILES['image']);

                if (empty($media->validateOnSize()->validateOnExtension()->errors())) {
                    $photoName = $media->upload('profile');

                    if ($photoName) {
                        $userData->setImage($photoName);
                    }
                }
            }

            //update lw fe sora w mafesh errors
            if (empty($media->errors())) {
                $result = $userData->setFirst_name($_POST['first_name'])
                    ->setLast_name($_POST['last_name'])
                    ->setPhone($_POST['phone'])
                    ->setGender($_POST['gender'])
                    ->setEmail($_SESSION['user']->email)
                    ->update();


                if ($result) {
                    //update in session after database
                    $_SESSION['user']->first_name = $_POST['first_name'];
                    $_SESSION['user']->last_name = $_POST['last_name'];
                    $_SESSION['user']->phone = $_POST['phone'];
                    $_SESSION['user']->gender = $_POST['gender'];

                    $success['update-info']['succes'] = "profile updated successfuly";
                } else {
                    $errors['update-info']['wrong']['something'] = "something wrong try again";
                }
            }
        } else {
            $errors['update-info']['wrong']['all-date'] = "All Information Are Required";
        }
    } elseif (isset($_POST['update_password'])) {
    } elseif (isset($_POST['update_email'])) {
    }
}


$userData->setEmail($_SESSION['user']->email);
$user = $userData->getUserByEmail()->fetch_object();
include_once "layouts/navbar.php";
include_once "layouts/breadcrumb.php";

?>
<!-- my account start -->
<div class="checkout-area pb-80 pt-100">
    <div class="container">
        <div class="row">
            <div class="ml-auto mr-auto col-lg-9">
                <div class="checkout-wrapper">
                    <div id="faq" class="panel-group">
                        <!-- ------------------------------------------------------information---------------------------------------------- -->
                        <div class="panel panel-default">

                            <div class="panel-heading">
                                <h5 class="panel-title"><span>1</span> <a data-toggle="collapse" data-parent="#faq" href="#my-account-1">Edit your account information </a></h5>
                            </div>

                            <div id="my-account-1" class="panel-collapse collapse <?= isset($_POST['update_info']) ? 'show' : '' ?>">
                                <div class="panel-body">
                                    <div class="billing-information-wrapper">

                                        <div class="account-info-wrapper">
                                            <h4>My Account Information</h4>
                                        </div>

                                        <form method="POST" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-12">
                                                    <?php
                                                    if (!empty($errors['update-info']['wrong'])) {
                                                        foreach ($errors['update-info']['wrong'] as $error) {
                                                            echo "<p class='alert alert-danger text-center'>{$error}</p>";
                                                        }
                                                    }
                                                    if (!empty($success['update-info'])) {
                                                        foreach ($success['update-info'] as $succes) {
                                                            echo "<p class='alert alert-success text-center'>{$succes}</p>";
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                                <div class="col-4 offset-4 ">
                                                    <label for="image">
                                                        <img src="assets/img/profile/<?= $user->image ?>" alt="<?= $user->first_name ?>" class="w-100 rounded-circle" style="cursor: pointer;">
                                                    </label>
                                                    <input type="file" name="image" id="image" class="d-none">
                                                    <?= isset($media) ? $media->getErrorMessage('size') : '' ?>
                                                    <?= isset($media) ? $media->getErrorMessage('extension') : '' ?>
                                                </div>

                                                <div class="col-lg-6 col-md-6">
                                                    <div class="billing-info">
                                                        <label>First Name</label>
                                                        <input type="text" name="first_name" value="<?= $user->first_name ?>">

                                                    </div>
                                                </div>

                                                <div class="col-lg-6 col-md-6">
                                                    <div class="billing-info">
                                                        <label>Last Name</label>
                                                        <input type="text" name="last_name" value="<?= $user->last_name ?>">
                                                    </div>
                                                </div>



                                                <div class="col-lg-6 col-md-6">
                                                    <div class="billing-info">
                                                        <label>Phone</label>
                                                        <input type="tel" name="phone" value="<?= $user->phone ?>">
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 col-md-6">
                                                    <div class="billing-info">
                                                        <label>Gender</label>
                                                        <select name="gender" class="form-control">
                                                            <option <?= $user->gender == 'm' ? 'selected' : '' ?> value="m">male</option>
                                                            <option <?= $user->gender == 'f' ? 'selected' : '' ?> value="f">female</option>
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="billing-back-btn">
                                                <div class="billing-btn">
                                                    <button type="submit" name="update_info">Update Information</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ------------------------------------------------------password---------------------------------------------- -->

                        <div class="panel panel-default">

                            <div class="panel-heading">
                                <h5 class="panel-title"><span>2</span> <a data-toggle="collapse" data-parent="#faq" href="#my-account-2">Change your password </a></h5>
                            </div>

                            <div id="my-account-2" class="panel-collapse collapse  <?= isset($_POST['update_password']) ? 'show' : '' ?>">
                                <div class="panel-body">
                                    <div class="billing-information-wrapper">

                                        <div class="account-info-wrapper">
                                            <h4>Change Password</h4>
                                        </div>
                                        <form method="POST">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label>Old Password</label>
                                                        <input type="password" name="old_password">
                                                    </div>
                                                </div>

                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label>New Password</label>
                                                        <input type="password" name="new_password">
                                                    </div>
                                                </div>

                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label>Password Confirm</label>
                                                        <input type="password" name="password_confirm">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="billing-back-btn">


                                                <div class="billing-btn">
                                                    <button type="submit" name="update_password">Update Password</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ------------------------------------------------------email---------------------------------------------- -->

                        <div class="panel panel-default">

                            <div class="panel-heading">
                                <h5 class="panel-title"><span>3</span> <a data-toggle="collapse" data-parent="#faq" href="#my-account-3">Modify your Email</a></h5>
                            </div>

                            <div id="my-account-3" class="panel-collapse collapse  <?= isset($_POST['update_email']) ? 'show' : '' ?>">
                                <div class="panel-body">
                                    <div class="billing-information-wrapper">

                                        <div class="account-info-wrapper">
                                            <h4>Email</h4>
                                        </div>
                                        <form method="POST">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label>Your Email</label>
                                                        <input type="email" name="email" value="<?= $user->email ?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="billing-back-btn">
                                                <div class="billing-btn">
                                                    <button type="submit" name="update_email">Update Email</button>
                                                </div>
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
</div>
<!-- my account end -->


<?php
include_once "layouts/footer.php";
include_once "layouts/footerscripts.php";
?>