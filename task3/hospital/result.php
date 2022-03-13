<?php

session_start();

$phone = $_SESSION['phone'];


$res1 = $_SESSION['results']['res1'];
$res2 = $_SESSION['results']['res2'];
$res3 = $_SESSION['results']['res3'];
$res4 = $_SESSION['results']['res4'];
$res5 = $_SESSION['results']['res5'];

$finalResult = ($res1 + $res2 + $res3 + $res4 + $res5);

define('bad', 0);
define('good', 3);
define('veryGood', 5);
define('excellent', 10);






?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
            height: 100vh;

            background: linear-gradient(to bottom right, #c8d6e5, #2e86de);
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            overflow-x: hidden;

        }

        h1 {
            color: #fff;
        }
    </style>
    <title>result</title>
</head>

<body>
    <h1 class="text-center py-5 fw-bolder">Your Reviews</h1>

    <div class="contaoner">
        <div class="row">
            <div class="col-9 mx-auto">
                <table class="w-100 table table-striped table-success">
                    <tr>
                        <th>Questions</th>
                        <th class="text-center">Answer</th>

                    </tr>

                    <tr>
                        <th>Are you satisfied with the level of cleanliness?</th>
                        <td class="text-center">
                            <?php
                            if ($res1 == bad) {
                                echo "Bad";
                            } elseif ($res1 == good) {
                                echo "Good";
                            } elseif ($res1 == veryGood) {
                                echo "Very Good";
                            } elseif ($res1 == excellent) {
                                echo "Excellent";
                            }

                            ?>
                        </td>

                    </tr>

                    <tr>
                        <th>Are you satisfied with the service prices?</th>
                        <td class="text-center">
                            <?php
                            if ($res2 == bad) {
                                echo "Bad";
                            } elseif ($res2 == good) {
                                echo "Good";
                            } elseif ($res2 == veryGood) {
                                echo "Very Good";
                            } elseif ($res2 == excellent) {
                                echo "Excellent";
                            }

                            ?>

                    </tr>

                    <tr>
                        <th>Are you satisfied with the nursing service</th>
                        <td class="text-center">
                            <?php
                            if ($res3 == bad) {
                                echo "Bad";
                            } elseif ($res3 == good) {
                                echo "Good";
                            } elseif ($res3 == veryGood) {
                                echo "Very Good";
                            } elseif ($res3 == excellent) {
                                echo "Excellent";
                            }

                            ?>

                    </tr>

                    <tr>
                        <th>Are you satisfied with the level of the doctor?</th>
                        <td class="text-center">
                            <?php
                            if ($res4 == bad) {
                                echo "Bad";
                            } elseif ($res4 == good) {
                                echo "Good";
                            } elseif ($res4 == veryGood) {
                                echo "Very Good";
                            } elseif ($res4 == excellent) {
                                echo "Excellent";
                            }

                            ?>
                    </tr>

                    <tr>
                        <th>Are you satisfied with the calmness in the hospital?</th>
                        <td class="text-center">
                            <?php
                            if ($res5 == bad) {
                                echo "Bad";
                            } elseif ($res5 == good) {
                                echo "Good";
                            } elseif ($res5 == veryGood) {
                                echo "Very Good";
                            } elseif ($res5 == excellent) {
                                echo "Excellent";
                            }

                            ?>
                    </tr>
                </table>
                <?php
                if ($finalResult >= 25) { ?>
                    <div class="alert alert-success">We wish you a speedy recovery Thank You</div>
                <?php  } else { ?>
                    <div class="alert alert-danger">OH!!! You have a problem we will cal you on this number [ <?= $phone ?> ] very soon</div>
                <?php  }
                ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>