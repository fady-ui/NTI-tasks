<?php

if ($_POST) {
    $num1 = $_POST['num1'];
    $num2 = $_POST['num2'];
    $operator = $_POST['operator'];

    if ($num1 == true && $num2 == true && $operator == true) {
        if ($operator == "+") {
            $res = ($num1) + ($num2);
        } elseif ($operator == "-") {
            $res = ($num1) - ($num2);
        } elseif ($operator == "*") {
            $res = ($num1) * ($num2);
        } elseif ($operator == "/") {
            $res = ($num1) / ($num2);
        } elseif ($operator == "%") {
            $res = ($num1) % ($num2);
        }

        $equ = ($num1) . " " . $operator . " " . ($num2) . " = " . $res;
    } else {
        $errorMessage = "Enter Numbers";
    }
}

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Calculator</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-4 mx-auto text-center mt-5 h1 fw-bolder text-primary">
                Calculator
            </div>
        </div>

        <div class="row">
            <div class="col-4 mx-auto mt-5">
                <form method="POST">
                    <div class="mb-3">
                        <input type="number" name="num1" placeholder="Enter First Number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                    </div>

                    <div class="mb-3">
                        <input type="number" name="num2" placeholder="Enter Second Number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                    </div>


                    <div class="row mt-5">
                        <input type="radio" class="btn-check " name="operator" value="+" id="plus" autocomplete="off" required>
                        <label class="btn btn-outline-success  w-25 mx-5 mb-3" for="plus">+</label>

                        <input type="radio" class="btn-check" name="operator" value="-" id="min" autocomplete="off" required>
                        <label class="btn btn-outline-success  w-25 mx-5 mb-3" for="min">-</label>

                        <input type="radio" class="btn-check" name="operator" value="*" id="multi" autocomplete="off" required>
                        <label class="btn btn-outline-success  w-25 mx-5 mb-3" for="multi">*</label>

                        <input type="radio" class="btn-check" name="operator" value="/" id="sub" autocomplete="off" required>
                        <label class="btn btn-outline-success  w-25 mx-5 mb-3" for="sub">/</label>

                        <input type="radio" class="btn-check" name="operator" value="%" id="mod" autocomplete="off" required>
                        <label class="btn btn-outline-success  w-25 mx-auto mb-3" for="mod">%</label>

                    </div>




                    <button type="submit" class="btn btn-primary w-100 mt-5">Calculate</button>
                </form>
            </div>
        </div>

        <div class="row">

            <div class="col-4  mx-auto mt-5">

                <?php if (isset($equ)) { ?>
                    <div class="alert alert-success text-center">
                        <?php
                        echo  $equ;
                        ?>
                    </div>
                <?php
                } elseif (isset($errorMessage)) {
                ?>
                    <div class="alert alert-danger text-center">
                        <?php
                        echo  $errorMessage;
                        ?>
                    </div>
                <?php
                } ?>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>