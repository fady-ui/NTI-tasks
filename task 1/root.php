<?php
// $x = 100;


// $x1 = $x**(1/5);

// echo "Square root of $x is $x1 \n";

?>



<?php

if ($_POST) {
    $num = $_POST['num'];
    $root = $_POST['root'];

    if($root == 0){
        http_response_code(406);
        echo "Enetr a valid root number [NOT ZEROO]";
        die;
    }

    $calRoot= $num**(1/$root);

    $message = $calRoot;
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

    <title>Root</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-6 mx-auto text-center mt-5 h1 fw-bolder text-primary">
                Get Root
            </div>
        </div>
        <div class="row">

            <div class="col-4 mx-auto mt-5">
                <form method="POST">
                    <div class="mb-3">
                        <input type="number" name="num" placeholder="Enter Any Number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <input type="number" name="root" placeholder="Enter Root" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
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