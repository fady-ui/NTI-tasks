<?php

if ($_POST) {
    $unit = $_POST['unit'];

    if($unit <= 0){
        $ErrorMessage = "Enter a Real Units Are Used";
    }else{
        define("surcharge" , 0.2);

        if($unit > 0 && $unit <= 50){
            $PricePerUnit = 0.50;
        }elseif($unit > 50 && $unit <= 150){
            $PricePerUnit = 0.75;
        }elseif($unit > 150 && $unit <= 250){
            $PricePerUnit = 1.20;
        }elseif($unit > 250 ){
            $PricePerUnit = 1.50;
        }


        $totalPriceUnits = $unit * $PricePerUnit;
        $totalSurcharge = $totalPriceUnits * surcharge;
        $totalAfterSurcharge = $totalPriceUnits + $totalSurcharge;

        $message = "
                        Your Units = " . $unit." <br> 
                        Price Per Unit = " . $PricePerUnit . " <br>
                        Total Price Of Your Units = " . $totalPriceUnits . "<br>
                        Surcharge Added = " . surcharge*100 . "%<br>
                        Surcharge Of Total Price = " . $totalSurcharge . "<br>
                        Total Price After Surcharge = " . $totalAfterSurcharge . "<br>
                    ";
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

    <title>ELEC</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-6 mx-auto text-center mt-5 h1 fw-bolder text-primary">
            ELEC
            </div>
        </div>
        <div class="row">

            <div class="col-4 mx-auto mt-5">
                <form method="POST">
                    <div class="mb-3">

                        <input type="number" name="unit" placeholder="Enter The Unit Used" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
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
                }  
             elseif (isset($ErrorMessage)) {
            ?>
                <div class="alert alert-danger text-center">
                    <?php
                    echo  $ErrorMessage;
                    ?>
                </div>
            <?php
            }
            ?>

            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>