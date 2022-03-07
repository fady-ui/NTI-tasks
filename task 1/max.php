<?php

if ($_POST) {
    $num1 = $_POST['num1'];
    $num2 = $_POST['num2'];
    $num3 = $_POST['num3'];

    if ($num1 > $num2 && $num1 > $num3) {
        $maxNum = "number 1 = " . $num1;
        if ($num2 > $num3) {
            $miniNum = "number 3 = " . $num3;
        } else {
            $miniNum = "number 2 = " . $num2;
        }
    } elseif ($num2 > $num1 && $num2 > $num3) {
        $maxNum = "number 2 = " . $num2;
        if ($num1 > $num3) {
            $miniNum = "number 3 = " . $num3;
        } else {
            $miniNum = "number 1 = " . $num1;
        }
    } else {
        $maxNum = "number 3 = " . $num3;
        if ($num1 > $num2) {
            $miniNum = "number 2 = " . $num2;
        } else {
            $miniNum = "number 1 = " . $num1;
        }
    }


    $message = "max number is " . $maxNum . "<br>mini number is " . $miniNum;
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

    <title>Max & Mini Number</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-6 mx-auto text-center mt-5 h1 fw-bolder text-primary">
                Get Max & Mini Number
            </div>
        </div>
        <div class="row">

            <div class="col-4 mx-auto mt-5">
                <form method="POST">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Number 1</label>
                        <input type="number" name="num1" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Number 2</label>
                        <input type="number" name="num2" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Number 3</label>
                        <input type="number" name="num3" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>


                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

            </div>
        </div>
        <div class="row">

            <div class="col-4  mx-auto mt-5">

                <?php if (isset($message)) { ?>
                    <div class="alert alert-success text-center">
                        <?php
                        echo  $message;
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